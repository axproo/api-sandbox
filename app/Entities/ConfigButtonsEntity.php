<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ConfigButtonsEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'type' => null,
        'name' => null,
        'class' => null,
        'icon' => null,
        'action' => null,
        'lang' => null,
        'value' => null,
        'is_active' => null,
        'is_auth' => null
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'id' => 'integer',
        'is_active' => 'boolean',
        'is_auth' => 'boolean',
    ];
}
