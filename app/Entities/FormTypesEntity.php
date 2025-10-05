<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class FormTypesEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
        'description' => null,
        'created_at' => null,
        'updated_at' => null
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'integer',
        'name' => '?string',
        'description' => '?string'
    ];
}
