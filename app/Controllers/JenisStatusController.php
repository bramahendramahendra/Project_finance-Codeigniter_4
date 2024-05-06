<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JenisStatusController extends BaseController
{
    public function __construct() 
    {
        $this->JenisStatusModel = new JenisStatusModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Jenis Status',
            'menu' => 'jenisStatus',
            'page' => 'jenisStatus/v_jenisStatus',
            'data' => $this->JenisStatusModel->getAllJenisStatus(),
        ];
        return view('v_template', $data);
    }

    public function store()
    {
        $dataInsert = [
            'jenis_status' => $this->request->getPost('jenis_status'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];
      
        if ($this->JenisStatusModel->createJenisStatus($dataInsert)) {
            session()->setFlashdata('success', 'Data Jenis Status Berhasil Ditambahkan.');
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Data Jenis Status.');
        }

        return redirect()->to('jenis_status');
    }

    public function update($id)
    {
        $dataUpdate = [
            'jenis_status' => $this->request->getPost('jenis_status'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        if ($this->JenisStatusModel->updateJenisStatus($id, $dataUpdate)) {
            session()->setFlashdata('success', 'Data Jenis Status Berhasil Diupdate.');
        } else {
            session()->setFlashdata('error', 'Gagal Mengupdate Data Jenis Status.');
        }

        return redirect()->to('jenis_status');
    }

    public function delete($id)
    {
        if ($this->JenisStatusModel->deleteJenisStatus($id)) {
            session()->setFlashdata('success', 'Data Jenis Status Berhasil Dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal Menghapus Data Jenis Status.');
        }

        return redirect()->to('jenis_status');
    }
}