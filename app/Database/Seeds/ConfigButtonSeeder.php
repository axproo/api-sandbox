<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfigButtonSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'type'   => 'submit',
                'name'   => 'signin',
                'class'  => 'btn btn-primary',
                'icon'   => 'mdi mdi-login',
                'action' => 'signin',
                'lang'   => 'loggedin',
                'is_auth' => false
            ],
            [
                'type'   => 'submit',
                'name'   => 'email-verify',
                'class'  => 'btn btn-primary',
                'icon'   => 'mdi mdi-email',
                'action' => 'email-verify',
                'lang'   => 'verify.default',
                'is_auth' => false
            ],
            [
                'type'   => 'submit',
                'name'   => 'new-password',
                'class'  => 'btn btn-primary',
                'icon'   => 'mdi mdi-onepassword',
                'action' => 'new-password',
                'lang'   => 'change.password',
                'is_auth' => false
            ],
            [
                'type'   => 'submit',
                'name'   => 'send',
                'class'  => 'btn btn-primary',
                'icon'   => 'mdi mdi-email-check',
                'action' => 'send',
                'lang'   => 'verify.email',
                'is_auth' => false
            ],
            [
                'type'   => 'button',
                'name'   => 'create',
                'class'  => 'btn btn-primary mb-2',
                'icon'   => 'mdi mdi-plus-circle me-2',
                'action' => 'create',
                'lang'   => 'add',
            ],
            [
                'type'   => 'button',
                'name'   => 'add',
                'class'  => 'btn btn-primary btn-sm mb-2',
                'icon'   => 'mdi mdi-plus-circle me-2',
                'action' => 'add',
                'lang'   => 'add',
            ],
            [
                'type'   => 'button',
                'name'   => 'import',
                'class'  => 'btn btn-light mb-2 me-1',
                'icon'   => 'mdi mdi-import',
                'action' => 'import',
                'lang'   => 'import',
            ],
            [
                'type'   => 'button',
                'name'   => 'export',
                'class'  => 'btn btn-light mb-2 me-1',
                'icon'   => 'mdi mdi-export',
                'action' => 'export',
                'lang'   => 'export',
            ],
            [
                'type'   => 'button',
                'name'   => 'delete',
                'class'  => 'btn btn-danger mb-2 me-1',
                'icon'   => 'mdi mdi-trash-can-outline',
                'action' => 'delete',
                'lang'   => 'delete',
            ],
            [
                'type'   => 'button',
                'name'   => 'publish',
                'class'  => 'btn btn-outline-info mb-2 me-1',
                'icon'   => 'mdi mdi-publish',
                'action' => 'publish',
                'lang'   => 'active.on',
                'value'  => 1
            ],
            [
                'type'   => 'button',
                'name'   => 'unpublish',
                'class'  => 'btn btn-outline-info mb-2 me-1',
                'icon'   => 'mdi mdi-publish-off',
                'action' => 'publish',
                'lang'   => 'active.off',
                'value'  => 0
            ],
            [
                'type'   => 'button',
                'name'   => 'goback',
                'class'  => 'btn btn-light mb-2 me-1',
                'icon'   => 'mdi mdi-keyboard-backspace',
                'action' => 'backToPage',
                'lang'   => 'backToList',
            ],
            [
                'type'   => 'button',
                'name'   => 'back',
                'class'  => 'btn btn-light me-2',
                'icon'   => 'mdi mdi-keyboard-backspace',
                'action' => 'back',
                'lang'   => 'back',
            ],
            [
                'type'   => 'button',
                'name'   => 'params',
                'class'  => 'btn btn-outline-secondary',
                'icon'   => 'mdi mdi-table-refresh',
                'action' => 'params',
                'lang'   => 'refresh',
            ],
            [
                'type'   => 'button',
                'name'   => 'close',
                'class'  => 'btn btn-sm btn-light',
                'icon'   => 'mdi mdi-close',
                'action' => 'close',
                'lang'   => 'close',
            ],
            [
                'type'   => 'submit',
                'name'   => 'save',
                'class'  => 'btn btn-sm btn-primary',
                'icon'   => 'mdi mdi-content-save',
                'action' => 'save',
                'lang'   => 'save',
            ],
            [
                'type'   => 'button',
                'name'   => 'clear',
                'class'  => 'btn btn-light',
                'icon'   => 'mdi mdi-refresh',
                'action' => 'clear',
                'lang'   => 'reset',
                'is_auth' => false
            ],
            [
                'type'   => 'button',
                'name'   => 'theme',
                'class'  => 'btn btn-sm btn-outline-light me-1',
                'icon'   => '',
                'action' => 'theme',
                'lang'   => 'btnTheme',
                'is_auth' => false,
                'value'  => 'dark,light'
            ],
            [
                'type'   => 'button',
                'name'   => 'lang',
                'class'  => 'btn btn-sm btn-outline-light me-1',
                'icon'   => '',
                'action' => 'lang',
                'lang'   => 'btnLang',
                'is_auth' => false,
                'value'  => 'en,fr'
            ],
        ];
        $builder = $this->db->table('config_buttons');

        foreach ($data as $row) {
            $exists = $builder
                ->where('name', $row['name'])
                ->get()->getRow();
            if (!$exists) {
                $builder->insert($row);
            }
        }
    }
}
