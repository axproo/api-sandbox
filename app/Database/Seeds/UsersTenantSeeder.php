<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersTenantSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1, // superadmin
                'tenant_id' => null,
                'role' => 'superadmin',
            ],
            [
                'user_id' => 2,
                'tenant_id' => 2,
                'role' => 'msp'
            ]
        ];
        $builder = $this->db->table('users_tenants');

        foreach ($data as $row) {
            $exists = $builder
                ->where('user_id', $row['user_id'])
                ->where('tenant_id', $row['tenant_id'])
                ->get()->getRow();
            if (!$exists) {
                $builder->insert($row);
            }
        }
    }
}
