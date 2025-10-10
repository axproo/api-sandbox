<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'class' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'image' => ['type' => 'VARCHAR', 'constraint' => 240, 'null' => true],
            'label' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'url'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at timestamp default current_timestamp',
            'updated_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('services');
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}
