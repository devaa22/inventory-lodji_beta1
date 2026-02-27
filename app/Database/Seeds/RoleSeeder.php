<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'owner'],
            ['name' => 'gudang'],
            ['name' => 'kitchen'],
            ['name' => 'bar'],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}