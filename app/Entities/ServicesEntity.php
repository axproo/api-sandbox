<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ServicesEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
        'description' => null,
        'class' => null,
        'image' => null,
        'label' => null,
        'url' => null,
        'created_at' => null,
        'updated_at' => null
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'integer',
        'name' => '?string'
    ];
}
