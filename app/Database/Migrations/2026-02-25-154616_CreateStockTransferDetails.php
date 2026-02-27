<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockTransferDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'transfer_id' => [
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

        $this->forge->addForeignKey('transfer_id', 'stock_transfers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('item_id', 'items', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('stock_transfer_details');
    }

    public function down()
    {
        $this->forge->dropTable('stock_transfer_details');
    }
}