<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class TenantsEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'uuid' => null,
        'name' => null,
        'email' => null,
        'phone' => null,
        'domain' => null,
        'status' => null,
        'created_at' => null,
        'updated_at' => null
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'integer',
        'uuid' => '?string',
        'name' => '?string',
    ];
}
