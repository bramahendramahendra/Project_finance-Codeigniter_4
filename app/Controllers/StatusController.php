<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StatusModel;
use App\Models\JenisStatusModel;
use App\Traits\ErrorHandlerTrait;

class StatusController extends BaseController
{
    use ErrorHandlerTrait;

    public function __construct() 
    {
        $this->StatusModel = new StatusModel();
        $this->JenisStatusModel = new JenisStatusModel();
    }

    public function index()
    {
        $optionsJenisStatus = $this->JenisStatusModel->getAllJenisStatus();
        if (empty($optionsJenisStatus)) {
            return $this->showErrorPage(500, 'status', 'Terjadi Kesalahan pada Status !', 'Harap isi jenis status terlebih dahulu sebelum melanjutkan.');
        }

        $data = [
            'judul' => 'Status',
            'menu' => 'status',
            'page' => 'status/v_status',
            'data' => $this->StatusModel->getAllStatus(),
            'optionsJenisStatus' => $optionsJenisStatus,
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
                'code_status' => 'required|integer',
                'status' => 'required',
                'deskripsi' => 'permit_empty|string'
            ];

            $messages = [
                'jenis_status' => [
                    'required' => 'Jenis Status harus diisi.',
                    'integer' => 'Jenis Status harus berupa angka.'
                ],
                'code_status' => [
                    'required' => 'Code Status harus diisi.',
                    'integer' => 'Code Status harus berupa angka.'
                ],
                'status' => [
                    'required' => 'Status harus diisi.',
                ],
                'deskripsi' => [
                    'string' => 'Deskripsi harus berupa string.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                // echo "failed";die;
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Pengecekan duplikasi code status 
            $idJenisStatus  = $this->request->getPost('jenis_status');
            $codeStatus     = $this->request->getPost('code_status');

            if ($this->StatusModel->isCodeStatusExists($codeStatus, $idJenisStatus)) {
                return redirect()->back()->withInput()->with('error', 'Code status sudah digunakan.');
            }

            $dataInsert = [
                'id_jenis_status'   => $idJenisStatus,
                'code_status'       => $codeStatus,
                'status'            => $this->request->getPost('status'),
                'deskripsi'         => $this->request->getPost('deskripsi')
            ];

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
                'status' => 'required',
                'deskripsi' => 'permit_empty|string'
            ];

            $messages = [
                'status' => [
                    'required' => 'Status harus diisi.',
                ],
                'deskripsi' => [
                    'string' => 'Deskripsi harus berupa string.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

             if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataUpdate = [
                'status'            => $this->request->getPost('status'),
                'deskripsi'         => $this->request->getPost('deskripsi')
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
