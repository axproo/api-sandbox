<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UsersTenantsEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'user_id' => null,
        'tenant_id' => null,
        'role' => null,
        'status' => null,
        'created_at' => null,
        'updated_at' => null
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'integer',
        'user_id' => 'integer',
        'tenant_id' => 'integer'
    ];
}
