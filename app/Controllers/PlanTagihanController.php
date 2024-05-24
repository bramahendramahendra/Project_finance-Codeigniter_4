<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PlanTagihanModel;
use App\Models\NamaTagihanModel;
use App\Models\KategoriTagihanModel;
use App\Models\StatusModel;

class PlanTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->PlanTagihanModel = new PlanTagihanModel();
        // $this->KategoriTagihanModel = new KategoriTagihanModel();
        // $this->StatusModel = new StatusModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Plan Tagihan',
            'menu' => 'planTagihan',
            'page' => 'planTagihan/v_planTagihan',
            'data' => $this->PlanTagihanModel->getAllData(),
            // 'optionsKategori' => $this->KategoriTagihanModel->getAllKategori(),
            // 'optionsStatus' => $this->StatusModel->getStatusByIdJenisStatus($this->statusNamaTagihan),
        ];
        echo '<pre>';
        var_dump($data['data']);
        echo '</pre>';
        die;
        return view('v_template', $data);
    }
}
