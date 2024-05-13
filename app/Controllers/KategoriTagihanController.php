<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriTagihanModel; 

class KategoriTagihanController extends BaseController
{
    protected $KategoriTagihanModel;

    public function __construct() 
    {
        $this->KategoriTagihanModel = new KategoriTagihanModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Kategori Tagihan',
            'menu' => 'kategoriTagihan',
            'page' => 'kategoriTagihan/v_kategoriTagihan',
            'data' => $this->KategoriTagihanModel->getAllKategori(),
        ];
        return view('v_template', $data);
    }

    public function store()
    {
        $dataInsert = [
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];
      
        if ($this->KategoriTagihanModel->createKategori($dataInsert)) {
            session()->setFlashdata('success', 'Data Kategori Berhasil Ditambahkan.');
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Data Kategori.');
        }

        return redirect()->to('kategori_tagihan');
    }

    public function update($id)
    {
        $dataUpdate = [
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        if ($this->KategoriTagihanModel->updateKategori($id, $dataUpdate)) {
            session()->setFlashdata('success', 'Data Kategori Berhasil Diupdate.');
        } else {
            session()->setFlashdata('error', 'Gagal Mengupdate Data Kategori.');
        }

        return redirect()->to('kategori_tagihan');
    }

    public function delete($id)
    {
        if ($this->KategoriTagihanModel->deleteKategori($id)) {
            session()->setFlashdata('success', 'Data Kategori Berhasil Dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal Kategori Menghapus Data.');
        }

        return redirect()->to('kategori_tagihan');
    }
}
