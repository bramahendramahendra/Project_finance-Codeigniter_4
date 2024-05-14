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
        // echo "<pre>";
        // var_dump($data['data']);
        // echo "</pre>";
        // die;
        return view('v_template', $data);
    }

    public function store()
    {   
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'jenis_status' => 'required|integer',
                // 'code_status' => [
                //     'rules' => 'required|integer|is_unique[status.code_status,id_jenis_status,{id_jenis_status}]',
                //     'errors' => [
                //         'is_unique' => 'Code status sudah digunakan untuk jenis status ini.'
                //     ]
                // ],
                'code_status' => 'required|integer',
                'status' => 'required',
                'deskripsi' => 'permit_empty|string'
            ];

            if (!$this->validate($rules)) {
                // echo "failed";die;
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Pengecekan duplikasi code status 
            $idJenisStatus = $this->request->getPost('jenis_status');
            $codeStatus = $this->request->getPost('code_status');

            if ($this->StatusModel->isCodeStatusExists($codeStatus, $idJenisStatus)) {
                // echo "failed111";die;
                return redirect()->back()->withInput()->with('error', 'Code status sudah digunakan.');
            }

            $dataInsert = [
                'id_jenis_status' => $idJenisStatus,
                'code_status' => $codeStatus,
                'status' => $this->request->getPost('status'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ];

            // echo "<pre>";
            // var_dump($dataInsert);
            // echo "</pre>";
            // die;
            

            if ($this->StatusModel->createStatus($dataInsert)) {
                session()->setFlashdata('success', 'Data Status Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Status.');
            }
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

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
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
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataUpdate = [
                'status' => $this->request->getPost('status'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ];

            if ($this->StatusModel->updateStatus($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Status Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Status.');
            }
        } else {
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Status.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }

        return redirect()->to('status');
    }

    public function delete($id)
    {
        if ($id !== '' && !empty($id)) {
            if ($this->StatusModel->deleteStatus($id)) {
                session()->setFlashdata('success', 'Data Status Berhasil Dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal Menghapus Data Status.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
        }

        return redirect()->to('status');
    }
}
