<?php
namespace App\Controllers;

use App\Models\TarifasModel;
use CodeIgniter\RESTful\ResourceController;

class Tarifas extends ResourceController
{

    private $tarifasModel;

    public function __construct()
    {
        $this->tarifasModel = new TarifasModel();
    }

    public function getTarifas()
    {
        $request = \Config\Services::request();
        $tarifas = new \App\Entities\Tarifas();

        if ($this->request->isAJAX()) {
            $origem = $request->getVar('origem');
            $destino = $request->getVar('destino');
            $tarifas = $this->tarifasModel->getTarifasPorOrigemDestino([
                'origem' => $origem,
                'destino' => $destino
            ]);
        }
        return $this->response->setJSON($tarifas);
    }
}
