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
            'optionsStatus' => $this->StatusModel->getStatusByIdJenisStatus($this->statusNamaTagihan),
        ];
        // echo "<pre>";
        // var_dump($data['data']);
        // echo "</pre>";
        // die;
        return view('v_template', $data);
    }

    public function store()
    {
        // echo 'asda';die;
        if ($this->request->getMethod() === 'POST') {
            helper(['form', 'url']);
            $validation =  \Config\Services::validation();

            $rules = [
                'kategori' => 'required|integer',
                'nama_tagihan' => 'required',
                'deskripsi' => 'permit_empty|string',
                'jumlah_tagihan' => 'required|validate_rupiah',
                'status' => 'required|integer',
            ];

            $messages = [
                'jumlah_tagihan' => [
                    'validate_rupiah' => 'Format Jumlah Tagihan tidak valid.'
                ]
            ];

            // echo"<pre>";
            // var_dump($this->request->getPost());
            // echo"</pre>";
            // die;

            if (!$this->validate($rules)) {
                // echo "gagal";die;
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            // echo "benar";

           

            $dataInsert = [
                'id_kategori' => $this->request->getPost('kategori'),
                'nama_tagihan' => $this->request->getPost('nama_tagihan'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'jumlah_tagihan' => $this->parse_rupiah($this->request->getPost('jumlah_tagihan')),
                'status' => $this->request->getPost('status')
            ];
            // echo"<pre>";
            // var_dump($dataInsert);
            // echo"</pre>";
            // die;

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

    // public function validate_rupiah($str)
    // {
    //     if (preg_match('/^Rp\s*[0-9]+(.[0-9]{3})*(,[0-9]{0,2})?$/', $str)) {
    //         return TRUE;
    //     } else {
    //         $this->validator->setError('jumlah_tagihan', 'Format Jumlah Tagihan tidak valid.');
    //         return FALSE;
    //     }
    // }

    private function parse_rupiah($rupiah)
    {
        $number = preg_replace('/[^0-9]/', '', $rupiah);
        return (int)$number;
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
                'id_kategori'       => $this->request->getPost('kategori'),
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
