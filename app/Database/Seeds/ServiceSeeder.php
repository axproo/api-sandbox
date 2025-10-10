<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Cyber Protect',
                'description' => 'Cyber sécurité tout-en-un',
                'class' => 'dropdown-icon-item',
                'image' => 'cyber.png',
                'label' => 'cyber',
                'url'   => '/cyber-protect'
            ],
            [
                'name' => 'Web Hosting',
                'description' => 'Hébergement web + domain',
                'class' => 'dropdown-icon-item',
                'image' => 'hosting.png',
                'label' => 'hosting',
                'url'   => '/web-manager'
            ],
            [
                'name' => 'Voip Telecom',
                'description' => 'Cyber sécurité tout-en-un',
                'class' => 'dropdown-icon-item',
                'image' => 'hosting.png',
                'label' => 'voip',
                'url'   => '/voip-telecom'
            ],
        ];
        $builder = $this->db->table('services');

        foreach ($data as $row) {
            $exists = $builder
                ->where('url', $row['url'])
                ->get()->getRow();
            if (!$exists) {
                $builder->insert($row);
            }
        }
    }
}
