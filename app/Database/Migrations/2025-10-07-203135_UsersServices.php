<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersServices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'service_id' => ['type' => 'INT', 'unsigned' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('service_id', 'services', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users_services');
    }

    public function down()
    {
        $this->forge->dropTable('users_services');
    }
}
