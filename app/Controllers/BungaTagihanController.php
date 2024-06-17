<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BungaTagihanModel;

class BungaTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->BungaTagihanModel = new BungaTagihanModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Bunga Tagihan',
            'menu' => 'bungaTagihan',
            'page' => 'bungaTagihan/v_bungaTagihan',
            'data' => $this->BungaTagihanModel->getAllData(),
        ];
        
        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'bunga'  => 'required|integer'
            ];

            $messages = [
                'bunga' => [
                    'required' => 'Bunga harus diisi.',
                    'integer'   => 'Bunga harus berupa angka.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataInsert = [
                'bunga'  => $this->request->getPost('bunga')
            ];
        
            if ($this->BungaTagihanModel->createData($dataInsert)) {
                session()->setFlashdata('success', 'Data Bunga Tagihan Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Bunga Tagihan.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Bunga Tagihan.');
        }

        return redirect()->to('bunga_tagihan');
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'bunga'  => 'required|integer'
            ];

            $messages = [
                'bunga' => [
                    'required' => 'Bunga harus diisi.',
                    'integer'   => 'Bunga harus berupa angka.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataUpdate = [
                'bunga'  => $this->request->getPost('bunga')
            ];

            if ($this->BungaTagihanModel->updateData($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Bunga Tagihan Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Bunga Tagihan.');
            }
        } else {
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Bunga Tagihan.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }

        return redirect()->to('bunga_tagihan');
    }
}
