<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfigAlertSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Danger',
                'alert' => 'danger',
                'class' => 'alert alert-danger',
                'icon'  => 'dripicons-wrong me-2'
            ],
            [
                'title' => 'Success',
                'alert' => 'success',
                'class' => 'alert alert-success',
                'icon'  => 'dripicons-checkmark me-2'
            ],
            [
                'title' => 'Info',
                'alert' => 'info',
                'class' => 'alert alert-info',
                'icon'  => 'dripicons-information me-2'
            ],
            [
                'title' => 'Warning',
                'alert' => 'warning',
                'class' => 'alert alert-warning',
                'icon'  => 'dripicons-warning me-2'
            ]
        ];
        $builder = $this->db->table('config_alerts');

        foreach ($data as $row) {
            $exists = $builder
                ->where('alert', $row['alert'])
                ->get()->getRow();
            if (!$exists) {
                $builder->insert($row);
            }
        }
    }
}
