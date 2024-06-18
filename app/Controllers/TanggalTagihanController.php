<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TanggalTagihanModel;

class TanggalTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->TanggalTagihanModel = new TanggalTagihanModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Tanggal Tagihan',
            'menu' => 'tanggalTagihan',
            'page' => 'tanggalTagihan/v_tanggalTagihan',
            'data' => $this->TanggalTagihanModel->getAllData(),
        ];
        
        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'tanggal'  => 'required|integer'
            ];

            $messages = [
                'tanggal' => [
                    'required' => 'Tanggal harus diisi.',
                    'integer'   => 'Tanggal harus berupa angka.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $tanggal = $this->request->getPost('tanggal');
            if ($tanggal < 1 || $tanggal > 27) {
                return redirect()->back()->withInput()->with('error', 'Tanggal harus di antara 1 dan 27.');
            }

            $dataInsert = [
                'tanggal'  => $tanggal
            ];
        
            if ($this->TanggalTagihanModel->createData($dataInsert)) {
                session()->setFlashdata('success', 'Data Tanggal Tagihan Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Tanggal Tagihan.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Tanggal Tagihan.');
        }

        return redirect()->to('tanggal_tagihan');
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'tanggal'  => 'required|integer'
            ];

            $messages = [
                'tanggal' => [
                    'required' => 'Tanggal harus diisi.',
                    'integer'   => 'Tanggal harus berupa angka.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $tanggal = $this->request->getPost('tanggal');
            if ($tanggal < 1 || $tanggal > 27) {
                return redirect()->back()->withInput()->with('error', 'Tanggal harus di antara 1 dan 27.');
            }

            $dataUpdate = [
                'tanggal'  => $tanggal
            ];

            if ($this->TanggalTagihanModel->updateData($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Tanggal Tagihan Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Tanggal Tagihan.');
            }
        } else {
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Tanggal Tagihan.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }

        return redirect()->to('tanggal_tagihan');
    }
}
