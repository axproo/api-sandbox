<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ConfigAlertsEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'title' => null,
        'alert' => null,
        'class' => null,
        'text' => null,
        'icon' => null
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
