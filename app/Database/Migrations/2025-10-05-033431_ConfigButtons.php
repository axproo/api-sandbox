<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ConfigButtons extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'type'  => ['type' => 'ENUM', 'constraint' => ['button','submit'], 'default' => 'button'],
            'name'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'class' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'icon'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'action' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'lang'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'value' => ['type' => 'TEXT', 'null' => true],
            'is_active' => ['type' => 'BOOLEAN', 'default' => true],
            'is_auth' => ['type' => 'BOOLEAN', 'default' => true],
            'created_at timestamp default current_timestamp',
            'updated_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('config_buttons');
    }

    public function down()
    {
        $this->forge->dropTable('config_buttons');
    }
}
