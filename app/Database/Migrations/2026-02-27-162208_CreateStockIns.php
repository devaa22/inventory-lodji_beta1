<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockIns extends Migration
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
            'supplier' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'location_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'location_id',
            'locations',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('stock_ins');
    }

    public function down()
    {
        $this->forge->dropTable('stock_ins');
    }
}