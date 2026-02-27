<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run()
    {
        echo "Seeding Roles...\n";
        $this->call('RoleSeeder');

        echo "Seeding Locations...\n";
        $this->call('LocationSeeder');

        echo "Seeding Users...\n";
        $this->call('UserSeeder');

        echo "Seeding Items...\n";
        $this->call('ItemSeeder');

        echo "Seeding Stocks...\n";
        $this->call('StockSeeder');

        echo "Master Seeder Completed.\n";
    }
}