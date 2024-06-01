<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NamaTagihanModel;
use App\Models\KategoriTagihanModel;
use App\Models\StatusModel;
use App\Traits\ErrorHandlerTrait;

class NamaTagihanController extends BaseController
{
    use ErrorHandlerTrait;

    public function __construct() 
    {
        $this->NamaTagihanModel = new NamaTagihanModel();
        $this->KategoriTagihanModel = new KategoriTagihanModel();
        $this->StatusModel = new StatusModel();
    }

    public function index()
    {
        $optionsStatus = $this->StatusModel->getStatusByIdJenisStatus($this->statusNamaTagihan);
        if (empty($optionsStatus)) {
            return $this->showErrorPage(500, 'namaTagihan', 'Terjadi Kesalahan pada Nama Tagihan !', 'Harap isi status terlebih dahulu sebelum melanjutkan.');
        }

        $optionsKategori = $this->KategoriTagihanModel->getAllKategori();
        if (empty($optionsKategori)) {
            return $this->showErrorPage(500, 'namaTagihan', 'Terjadi Kesalahan pada Nama Tagihan !', 'Harap isi kategori terlebih dahulu sebelum melanjutkan.');
        }

        $data = [
            'judul' => 'Nama Tagihan',
            'menu' => 'namaTagihan',
            'page' => 'namaTagihan/v_namaTagihan',
            'data' => $this->NamaTagihanModel->getAllData(),
            'optionsStatus' => $optionsStatus,
            'optionsKategori' => $optionsKategori,
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
            // $validation =  \Config\Services::validation();

            $rules = [
                'kategori'      => 'required|integer',
                'nama_tagihan'  => 'required',
                'deskripsi'     => 'permit_empty|string',
                'jumlah_tagihan'=> 'required|validate_rupiah',
                'status'        => 'required|integer',
            ];

            $messages = [
                'kategori' => [
                    'required'  => 'Kategori harus diisi.',
                    'integer'   => 'Kategori harus berupa angka.'
                ],
                'nama_tagihan' => [
                    'required' => 'Nama Tagihan harus diisi.',
                ],
                'deskripsi' => [
                    'string' => 'Deskripsi harus berupa string.'
                ],
                'jumlah_tagihan' => [
                    'required'          => 'Jumlah Tagihan harus diisi.',
                    'validate_rupiah'   => 'Format Rupiah Jumlah Tagihan dengan Bunga tidak valid.'
                ],
                'status' => [
                    'required'  => 'Status harus diisi.',
                    'integer'   => 'Status harus berupa angka.'
                ]
            ];

            $this->validation->setRules($rules, $messages);
            // $validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataInsert = [
                'id_kategori'       => $this->request->getPost('kategori'),
                'nama_tagihan'      => $this->request->getPost('nama_tagihan'),
                'deskripsi'         => $this->request->getPost('deskripsi'),
                'jumlah_tagihan'    => parse_rupiah($this->request->getPost('jumlah_tagihan')),
                'status'            => $this->request->getPost('status')
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


    public function update($id)
    {
        
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'kategori'          => 'required|integer',
                'nama_tagihan'      => 'required',
                'deskripsi'         => 'permit_empty|string',
                'jumlah_tagihan'    => 'required|validate_rupiah',
                'status'            => 'required|integer',
            ];

            $messages = [
                'kategori' => [
                    'required'  => 'Kategori harus diisi.',
                    'integer'   => 'Kategori harus berupa angka.'
                ],
                'nama_tagihan' => [
                    'required' => 'Nama Tagihan harus diisi.',
                ],
                'deskripsi' => [
                    'string' => 'Deskripsi harus berupa string.'
                ],
                'jumlah_tagihan' => [
                    'required'          => 'Jumlah Tagihan harus diisi.',
                    'validate_rupiah'   => 'Format Rupiah Jumlah Tagihan dengan Bunga tidak valid.'
                ],
                'status' => [
                    'required'  => 'Status harus diisi.',
                    'integer'   => 'Status harus berupa angka.'
                ]
            ];

         
            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                // var_dump($rules);
                // var_dump($messages);
                // echo 'failed';die;
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // echo $id;
            // die;
            $dataUpdate = [
                'id_kategori'       => $this->request->getPost('kategori'),
                'nama_tagihan'      => $this->request->getPost('nama_tagihan'),
                'deskripsi'         => $this->request->getPost('deskripsi'),
                'jumlah_tagihan'    => parse_rupiah($this->request->getPost('jumlah_tagihan')),
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
