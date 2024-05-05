<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriTagihanModel;

class KategoriTagihan extends BaseController
{
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
      
        $this->KategoriTagihanModel->createKategori($dataInsert);
        session()->setFlashdata('pesan', 'Data Kategori Berhasil Ditambahkan !!');
        return redirect()->to('KategoriTagihan');
    }

    public function update($id)
    {
        $dataUpdate = [
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];
        $this->KategoriTagihanModel->updateKategori($id, $dataUpdate);
        session()->setFlashdata('pesan', 'Data Kategori Berhasil Diupdate !!');
        return redirect()->to('KategoriTagihan');
    }

    public function delete($id)
    {
        $this->KategoriTagihanModel->deleteKategori($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to('KategoriTagihan');
    }
}
