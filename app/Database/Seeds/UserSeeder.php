<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'name'     => 'Owner Lodji',
            'username' => 'owner',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'role_id'  => 1
        ]);
    }
}