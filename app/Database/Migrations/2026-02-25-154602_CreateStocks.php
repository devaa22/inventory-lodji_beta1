<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStocks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'item_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'location_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'qty' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['item_id', 'location_id']);

        $this->forge->addForeignKey('item_id', 'items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('location_id', 'locations', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('stocks');
    }

    public function down()
    {
        $this->forge->dropTable('stocks');
    }
}