<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UsersServicesEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'user_id' => null,
        'service_id' => null
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'integer',
        'user_id' => 'integer',
        'service_id' => 'integer'
    ];
}
