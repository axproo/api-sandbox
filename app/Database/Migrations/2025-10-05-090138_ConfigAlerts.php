<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ConfigAlerts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'alert' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'class' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'text'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'icon'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at timestamp default current_timestamp',
            'updated_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('config_alerts');
    }

    public function down()
    {
        $this->forge->dropTable('config_alerts');
    }
}
