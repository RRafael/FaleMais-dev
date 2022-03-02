<?php

namespace App\Models;

use CodeIgniter\Model;

class TarifasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tarifas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = \App\Entities\Tarifas::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'origem',
        'destino',
        'tarifa'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
        
    public function getTarifasPorOrigemDestino($data)
    {      
        $tarifas = new \App\Entities\Tarifas();
        $id = $this->where('origem', $data['origem'])
            ->where('destino', $data['destino'])
            ->findAll();
        $tarifas = $this->find($id[0]->id ? $id[0]->id : 0);        
        return $tarifas;
    }

}
