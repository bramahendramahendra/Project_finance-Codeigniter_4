<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriTagihanModel;
use App\Models\StatusModel;

class KategoriTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->KategoriTagihanModel = new KategoriTagihanModel();
        $this->StatusModel = new StatusModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Kategori Tagihan',
            'menu' => 'kategoriTagihan',
            'page' => 'kategoriTagihan/v_kategoriTagihan',
            'data' => $this->KategoriTagihanModel->getAllKategori(),
            'optionsStatus' => $this->StatusModel->getStatusByIdJenisStatus($this->statusKategoriTagihan),
        ];

        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'kategori'  => 'required',
                'deskripsi' => 'permit_empty|string',
                'status'    => 'required|integer',
            ];

            $messages = [
                'kategori' => [
                    'required' => 'Kategori harus diisi.'
                ],
                'deskripsi' => [
                    'string' => 'Deskripsi harus berupa string.'
                ],
                'status' => [
                    'required' => 'Status harus diisi.',
                    'integer' => 'Status harus berupa angka.'
                ]
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            
            $dataInsert = [
                'kategori'  => $this->request->getPost('kategori'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status'    => $this->request->getPost('status'),
            ];

            if ($this->KategoriTagihanModel->createKategori($dataInsert)) {
                session()->setFlashdata('success', 'Data Kategori Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Kategori.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Kategori.');
        }

        return redirect()->to('kategori_tagihan');
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'kategori'  => 'required',
                'deskripsi' => 'permit_empty|string',
                'status'    => 'required|integer',
            ];

            $messages = [
                'kategori' => [
                    'required' => 'Kategori harus diisi.'
                ],
                'deskripsi' => [
                    'string' => 'Deskripsi harus berupa string.'
                ],
                'status' => [
                    'required' => 'Status harus diisi.',
                    'integer' => 'Status harus berupa angka.'
                ]
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataUpdate = [
                'kategori'  => $this->request->getPost('kategori'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status'    => $this->request->getPost('status'),
            ];

            if ($this->KategoriTagihanModel->updateKategori($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Kategori Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Kategori.');
            } 
        } else {
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Kategori.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }

        return redirect()->to('kategori_tagihan');
    }

    public function delete($id)
    {
        if ($id !== '' && !empty($id)) {
            if ($this->KategoriTagihanModel->deleteKategori($id)) {
                session()->setFlashdata('success', 'Data Kategori Berhasil Dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal Kategori Menghapus Data.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
        }

        return redirect()->to('kategori_tagihan');
    }
}
