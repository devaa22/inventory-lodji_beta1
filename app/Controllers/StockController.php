<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\LocationModel;

class StockController extends BaseController
{
    protected $stockModel;
    protected $locationModel;

    public function __construct()
    {
        $this->checkLogin();
        $this->stockModel = new StockModel();
        $this->locationModel = new LocationModel();
    }

    public function index()
    {
        $locationId = $this->request->getGet('location');

        $locations = $this->locationModel->findAll();

        $stocks = [];

        if ($locationId) {
            $stocks = $this->stockModel
            ->select('stocks.qty, items.kode_barang, items.nama_barang, items.satuan')
            ->join('items', 'items.id = stocks.item_id')
            ->where('stocks.location_id', $locationId)
            ->findAll();
        }

        return view('stockindex', [
            'locations' => $locations,
            'stocks'    => $stocks,
            'selected'  => $locationId
        ]);
    }
    public function transfer()
    {
        // Ambil Gudang saja
        $gudang = $this->locationModel
            ->where('type', 'warehouse')
            ->first();

        $sublocations = $this->locationModel
            ->where('type', 'production')
            ->findAll();

        $items = (new \App\Models\ItemModel())->findAll();

        return view('stocktransfer', [
            'gudang'       => $gudang,
            'sublocations' => $sublocations,
            'items'        => $items
        ]);
    }
    public function processTransfer()
    {
        $from = $this->request->getPost('from_location');
        $to   = $this->request->getPost('to_location');
        $item = $this->request->getPost('item_id');
        $qty  = (float) $this->request->getPost('qty');

        if ($from == $to || $qty <= 0) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Ambil stok asal
        $sourceStock = $this->stockModel
            ->where('item_id', $item)
            ->where('location_id', $from)
            ->first();

        if (!$sourceStock || $sourceStock['qty'] < $qty) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        /*
        =====================
        1️⃣ Insert Header Transfer
        =====================
        */

        $db->table('stock_transfers')->insert([
            'tanggal'           => date('Y-m-d H:i:s'),
            'from_location_id'  => $from,
            'to_location_id'    => $to,
            'status'            => 'approved',
            'created_at'        => date('Y-m-d H:i:s')
        ]);

        $transferId = $db->insertID();

        /*
        =====================
        2️⃣ Insert Detail
        =====================
        */

        $db->table('stock_transfer_details')->insert([
            'transfer_id' => $transferId,
            'item_id'     => $item,
            'qty'         => $qty
        ]);

        /*
        =====================
        3️⃣ Update Stok
        =====================
        */

        // Kurangi gudang
        $this->stockModel
            ->where('item_id', $item)
            ->where('location_id', $from)
            ->set('qty', 'qty - ' . $qty, false)
            ->update();

        // Tambah tujuan
        $this->stockModel
            ->where('item_id', $item)
            ->where('location_id', $to)
            ->set('qty', 'qty + ' . $qty, false)
            ->update();

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Transfer gagal.');
        }

        return redirect()->to('/stocks?location=' . $to)
            ->with('success', 'Transfer berhasil dan tercatat.');
    }
    public function receive()
    {
        $items = (new \App\Models\ItemModel())->findAll();

        $gudang = $this->locationModel
            ->where('type', 'warehouse')
            ->first();

        return view('stockreceive', [
            'items'  => $items,
            'gudang' => $gudang
        ]);
    }
    public function processReceive()
    {
        $item = $this->request->getPost('item_id');
        $qty  = (float) $this->request->getPost('qty');
        $location = $this->request->getPost('location_id');

        if ($qty <= 0) {
            return redirect()->back()->with('error', 'Qty tidak valid');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Insert header
        $db->table('stock_ins')->insert([
            'tanggal'     => date('Y-m-d H:i:s'),
            'location_id' => $location,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $stockInId = $db->insertID();

        // Insert detail
        $db->table('stock_in_details')->insert([
            'stock_in_id' => $stockInId,
            'item_id'     => $item,
            'qty'         => $qty
        ]);

        // Update stok gudang
        $this->stockModel
            ->where('item_id', $item)
            ->where('location_id', $location)
            ->set('qty', 'qty + ' . $qty, false)
            ->update();

        $db->transComplete();

        return redirect()->to('/stocks?location=' . $location)
            ->with('success', 'Penerimaan berhasil');
    }
}