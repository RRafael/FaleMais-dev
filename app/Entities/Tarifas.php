<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Tarifas extends Entity
{

    protected $attributes = [
        'id' => null,
        'origem' => null,
        'destino' => null,
        'tarifa' => null
    ];
}