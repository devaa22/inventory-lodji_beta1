<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Gudang',
                'type' => 'warehouse',
            ],
            [
                'name' => 'Kitchen',
                'type' => 'production',
            ],
            [
                'name' => 'Bar',
                'type' => 'production',
            ],
        ];

        $this->db->table('locations')->insertBatch($data);
    }
}