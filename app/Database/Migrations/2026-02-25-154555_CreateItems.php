<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'minimum_stock' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('items');
    }

    public function down()
    {
        $this->forge->dropTable('items');
    }
}