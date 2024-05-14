<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NamaTagihanModel;
use App\Models\KategoriTagihanModel;
use App\Models\StatusModel;

class NamaTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->NamaTagihanModel = new NamaTagihanModel();
        $this->KategoriTagihanModel = new KategoriTagihanModel();
        $this->StatusModel = new StatusModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Nama Tagihan',
            'menu' => 'namaTagihan',
            'page' => 'namaTagihan/v_namaTagihan',
            'data' => $this->NamaTagihanModel->getAllData(),
            'optionsKategori' => $this->KategoriTagihanModel->getAllKategori(),
            'optionsStatus' => $this->StatusModel->getAllStatus(),

        ];
        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'kategori' => 'required|integer',
                'nama_tagihan' => 'required',
                'deskripsi' => 'permit_empty|string',
                'jumlah_tagihan' => 'required|integer',
                'status' => 'required|integer',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataInsert = [
                'id_kategori' => $this->request->getPost('kategori'),
                'nama_tagihan' => $this->request->getPost('nama_tagihan'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'jumlah_tagihan' => $this->request->getPost('jumlah_tagihan'),
                'status' => $this->request->getPost('status')
            ];

            if ($this->NamaTagihanModel->createData($dataInsert)) {
                session()->setFlashdata('success', 'Data Nama Tagihan Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Nama Tagihan.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Nama Tagihan.');
        }

        return redirect()->to('nama_tagihan');
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'kategori' => 'required|integer',
                'nama_tagihan' => 'required',
                'deskripsi' => 'permit_empty|string',
                'jumlah_tagihan' => 'required|integer',
                'status' => 'required|integer',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $data = [
                'id_kategori'       => $this->request->getPost('id_kategori'),
                'nama_tagihan'      => $this->request->getPost('nama_tagihan'),
                'deskripsi'         => $this->request->getPost('deskripsi'),
                'jumlah_tagihan'    => $this->request->getPost('jumlah_tagihan'),
                'status'            => $this->request->getPost('status')
            ];
            
            if ($this->NamaTagihanModel->updateData($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Nama Tagihan Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Nama Tagihan.');
            }
        } else { 
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Nama Tagihan.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }
        
        return redirect()->to('nama_tagihan');
    }

    public function delete($id)
    {
        if ($id !== '' && !empty($id)) {
            if ($this->NamaTagihanModel->deleteData($id)) {
                session()->setFlashdata('success', 'Data Nama Tagihan Berhasil Dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal Nama Tagihan Menghapus Data.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
        }


        return redirect()->to('nama_tagihan');
    }
}
