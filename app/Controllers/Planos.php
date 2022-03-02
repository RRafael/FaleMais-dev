<?php
namespace App\Controllers;

use App\Models\PlanosModel;
use CodeIgniter\RESTful\ResourceController;

class Planos extends ResourceController
{

    private $planosModel;

    public function __construct()
    {
        $this->planosModel = new PlanosModel();
    }

    public function getPlanos()
    {
        $request = \Config\Services::request();        
        $planos = new \App\Entities\Planos();
                
        if ($this->request->isAJAX()) {
            $id = $request->getVar('id');
            $planos = $this->planosModel->find($id);
        }
        return $this->response->setJSON($planos);
    }
}
