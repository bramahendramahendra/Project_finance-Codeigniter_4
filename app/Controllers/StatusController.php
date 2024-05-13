<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StatusModel;
use App\Models\JenisStatusModel;

class StatusController extends BaseController
{
    public function __construct() 
    {
        $this->StatusModel = new StatusModel();
        $this->JenisStatusModel = new JenisStatusModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Status',
            'menu' => 'status',
            'page' => 'status/v_status',
            'data' => $this->StatusModel->getAllStatus(),
            'optionsJenisStatus' => $this->JenisStatusModel->getAllJenisStatus(),
        ];
        return view('v_template', $data);
    }

    public function store()
    {   
        if ($this->request->getMethod() === 'POST') {
            echo "<pre>";
            var_dump($this->request->getPost());
            echo "</pre>";
            // die;

            $rules = [
                'jenis_status' => 'required|integer',
                'code_status' => [
                    'rules' => 'required|integer|is_unique[status.code_status,id_jenis_status,{id_jenis_status}]',
                    'errors' => [
                        'is_unique' => 'Code status sudah digunakan untuk jenis status ini.'
                    ]
                ],
                'status' => 'required',
                'deskripsi' => 'permit_empty|string'
            ];

            if (!$this->validate($rules)) {
                echo "failed";die;
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            // echo "success";die;


            $idJenisStatus = $this->request->getPost('jenis_status');
            $codeStatus = $this->request->getPost('code_status');

            if ($this->StatusModel->isCodeStatusExists($codeStatus, $idJenisStatus)) {
                echo "failed_code_status";die;
                return redirect()->back()->withInput()->with('error', 'Code status sudah digunakan.');
            }

            $dataInsert = [
                'id_jenis_status' => $idJenisStatus,
                'code_status' => $codeStatus,
                'status' => $this->request->getPost('status'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ];
            // echo "success";die;
            

            if ($this->StatusModel->createStatus($dataInsert)) {
                session()->setFlashdata('success', 'Data Status Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Status.');
            }
            // return redirect()->to('/status')->with('message', 'Status berhasil ditambahkan.');
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Status.');
        }

        return redirect()->to('status');
    }

    public function check_code_status($idJenisStatus, $codeStatus)
    {
        $exists = $this->StatusModel->isCodeStatusExists($codeStatus, $idJenisStatus);
        
        return $this->response->setJSON(['exists' => $exists]);
    }
}
