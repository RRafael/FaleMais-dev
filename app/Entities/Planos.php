<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Planos extends Entity
{

    protected $attributes = [
        'id' => null,
        'name' => null,
        'tempo' => null
    ];
}