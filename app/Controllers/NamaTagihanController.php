<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NamaTagihanModel;

class NamaTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->NamaTagihanModel = new NamaTagihanModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Nama Tagihan',
            'menu' => 'namaTagihan',
            'page' => 'namaTagihan/v_namaTagihan',
            'data' => $this->NamaTagihanModel->getAll(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $dataInsert = ['nama_kategori' => $this->request->getPost('nama_kategori')];
        $dataInsert = ['deskripsi_kategori' => $this->request->getPost('deskripsi_kategori')];
        $this->ModelKategori->InsertData($dataInsert);
        session()->setFlashdata('pesan', 'Data Kategori Berhasil Ditambahkan !!');
        return redirect()->to('Kategori');
    }

    public function UpdateData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];
        $this->ModelKategori->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate !!');
        return redirect()->to('Kategori');
    }

    public function DeleteData($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori,
        ];
        $this->ModelKategori->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to('Kategori');
    }
}
