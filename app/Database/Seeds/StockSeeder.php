<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run()
    {
        $items     = $this->db->table('items')->get()->getResultArray();
        $locations = $this->db->table('locations')->get()->getResultArray();

        $data = [];

        foreach ($items as $item) {
            foreach ($locations as $location) {

                // Kalau Gudang Utama, kasih stok awal
                if ($location['name'] === 'Gudang Utama') {
                    $qty = rand(20, 100);
                } else {
                    $qty = 0;
                }

                $data[] = [
                    'item_id'     => $item['id'],
                    'location_id' => $location['id'],
                    'qty'         => $qty,
                ];
            }
        }

        $this->db->table('stocks')->insertBatch($data);
    }
}