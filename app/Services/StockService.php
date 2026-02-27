<?php

namespace App\Services;

use App\Models\StockModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class StockService
{
    protected $stockModel;
    protected $db;

    public function __construct()
    {
        $this->stockModel = new StockModel();
        $this->db = \Config\Database::connect();
    }

    public function transfer($fromLocation, $toLocation, $items)
    {
        $this->db->transStart();

        foreach ($items as $item) {

            $stockFrom = $this->stockModel
                ->where('item_id', $item['item_id'])
                ->where('location_id', $fromLocation)
                ->first();

            if (!$stockFrom || $stockFrom['qty'] < $item['qty']) {
                throw new DatabaseException('Stok tidak mencukupi.');
            }

            // Kurangi stok asal
            $this->stockModel->set('qty', 'qty - '.$item['qty'], false)
                ->where('item_id', $item['item_id'])
                ->where('location_id', $fromLocation)
                ->update();

            // Tambah stok tujuan
            $stockTo = $this->stockModel
                ->where('item_id', $item['item_id'])
                ->where('location_id', $toLocation)
                ->first();

            if ($stockTo) {
                $this->stockModel->set('qty', 'qty + '.$item['qty'], false)
                    ->where('item_id', $item['item_id'])
                    ->where('location_id', $toLocation)
                    ->update();
            } else {
                $this->stockModel->insert([
                    'item_id'     => $item['item_id'],
                    'location_id' => $toLocation,
                    'qty'         => $item['qty']
                ]);
            }
        }

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            throw new DatabaseException('Transfer gagal.');
        }

        return true;
    }
}