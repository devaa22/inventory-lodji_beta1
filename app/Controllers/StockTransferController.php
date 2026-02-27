<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StockTransferController extends BaseController
{
    public function __construct()
    {
        $this->checkLogin();
    }

    public function index()
    {
        //
    }
    public function complete($transferId)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $transferModel = new \App\Models\StockTransferModel();
        $detailModel   = new \App\Models\StockTransferDetailModel();
        $stockModel    = new \App\Models\StockModel();

        $transfer = $transferModel->find($transferId);

        if ($transfer['status'] === 'completed') {
            return redirect()->back()->with('error', 'Sudah selesai');
        }

        $details = $detailModel
            ->where('stocktransfer_id', $transferId)
            ->findAll();

        foreach ($details as $detail) {

            // Kurangi stok asal
            $stockModel->where([
                'item_id'     => $detail['item_id'],
                'location_id' => $transfer['from_location_id']
            ])->decrement('qty', $detail['qty']);

            // Tambah stok tujuan
            $stockModel->where([
                'item_id'     => $detail['item_id'],
                'location_id' => $transfer['to_location_id']
            ])->increment('qty', $detail['qty']);
        }

        $transferModel->update($transferId, ['status' => 'completed']);

        $db->transComplete();

        return redirect()->back()->with('success', 'Transfer selesai');
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $transferModel = new \App\Models\StockTransferModel();
        $detailModel   = new \App\Models\StockTransferDetailModel();
        $stockModel    = new \App\Models\StockModel();

        $from = $this->request->getPost('from_location_id');
        $to   = $this->request->getPost('to_location_id');
        $items = $this->request->getPost('items'); 
        // format: items[item_id] = qty

        // Insert header
        $transferId = $transferModel->insert([
            'tanggal' => date('Y-m-d H:i:s'),
            'from_location_id' => $from,
            'to_location_id'   => $to,
            'status' => 'completed'
        ]);

        foreach ($items as $itemId => $qty) {

            if ($qty <= 0) continue;

            // Ambil stok asal
            $stockFrom = $stockModel
                ->where(['item_id' => $itemId, 'location_id' => $from])
                ->first();

            if (!$stockFrom || $stockFrom['qty'] < $qty) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Stok tidak cukup');
            }

            // Kurangi stok asal
            $stockModel->where([
                'item_id' => $itemId,
                'location_id' => $from
            ])->decrement('qty', $qty);

            // Tambah stok tujuan
            $stockModel->where([
                'item_id' => $itemId,
                'location_id' => $to
            ])->increment('qty', $qty);

            // Insert detail
            $detailModel->insert([
                'stocktransfer_id' => $transferId,
                'item_id' => $itemId,
                'qty' => $qty
            ]);
        }

        $db->transComplete();

        return redirect()->to('/stock-transfers')
            ->with('success', 'Transfer berhasil');
    }
}
