<?php
namespace App\Controllers;

use App\Models\PlanosModel;
use App\Models\TarifasModel;

class Home extends BaseController
{

    private $planosModel;

    private $tarifasModel;

    public function __construct()
    {
        $this->planosModel = new PlanosModel();
        $this->tarifasModel = new TarifasModel();
    }

    public function index()
    {
        return view('home', [
            'planos' => $this->planosModel->findAll(),
            'tarifas' => $this->tarifasModel->findAll()
        ]);
    }
}
