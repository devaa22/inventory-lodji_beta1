<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockTransfers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATETIME',
            ],
            'from_location_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'to_location_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('stock_transfers');
    }

    public function down()
    {
        $this->forge->dropTable('stock_transfers');
    }
}