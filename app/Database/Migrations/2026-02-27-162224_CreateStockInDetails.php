<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockInDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'stock_in_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'item_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'qty' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey(
            'stock_in_id',
            'stock_ins',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'item_id',
            'items',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('stock_in_details');
    }

    public function down()
    {
        $this->forge->dropTable('stock_in_details');
    }
}