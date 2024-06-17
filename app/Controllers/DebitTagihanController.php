<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DebitTagihanModel;
use App\Traits\ErrorHandlerTrait;

class DebitTagihanController extends BaseController
{
    use ErrorHandlerTrait;

    public function __construct() 
    {
        $this->DebitTagihanModel = new DebitTagihanModel();
        // $this->BungaTagihanModel = new BungaTagihanModel();
        // $this->StatusModel = new StatusModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Debit Tagihan',
            'menu' => 'debitTagihan',
            'page' => 'debitTagihan/v_debitTagihan',
            'data' => $this->DebitTagihanModel->getAllData(),
        ];

        // echo "<pre>";
        // var_dump($data['data']);
        // echo "</pre>";
        // die;
        
        return view('v_template', $data);
    }

    public function pay_all()
    {
        if ($this->request->getMethod() === 'POST') {
            echo "<pre>"; 
            var_dump($this->request->getPost());
            echo "</pre>";
            die;
        }
    }

    public function pay_first()
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            echo "<pre>"; 
            var_dump($this->request->getPost());
            echo "</pre>";
            die;
        }
    }

    public function pay()
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            echo "<pre>"; 
            var_dump($this->request->getPost());
            echo "</pre>";
            die;
        }
    }
}
