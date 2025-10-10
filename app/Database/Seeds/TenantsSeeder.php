<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class TenantsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'MHM Technology',
                'domain' => 'mhm-technology.com',
                'email' => 'contact@mhm-technology.com',
                'phone' => '+33 9 70 15 01 63',
                'status' => 'active'
            ],
            [
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'Auxicall CM',
                'domain' => 'auxicall.com',
                'email' => 'contact@auxicall.com',
                'phone' => '+33 9 70 15 01 69',
                'status' => 'suspended'
            ],
        ];
        $builder = $this->db->table('tenants');

        foreach ($data as $row) {
            $exists = $builder
                ->where('uuid', $row['uuid'])
                ->get()->getRow();
            if (!$exists) {
                $builder->insert($row);
            }
        }
    }
}
