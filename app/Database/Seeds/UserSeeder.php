<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'first_name' => 'Christian',
                'last_name'  => 'DJOMOU',
                'email'      => 'christian@axproo.com',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role_id'    => 1,
                'updated_at' => Time::now()
            ],
            [
                'first_name' => 'Franck',
                'last_name'  => 'DJOMOU',
                'email'      => 'd.marius@auxicall.cm',
                'password'   => password_hash('password123', PASSWORD_BCRYPT),
                'role_id'    => 5,
                'updated_at' => Time::now()
            ]
        ];
        $builder = $this->db->table('users');

        foreach ($data as $row) {
            $exists = $builder
                ->where('email', $row['email'])
                ->get()->getRow();
            if (!$exists) {
                $builder->insert($row);
            }
        }
    }
}
