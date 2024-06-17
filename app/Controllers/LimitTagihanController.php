<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LimitTagihanModel;

class LimitTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->LimitTagihanModel = new LimitTagihanModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Limit Tagihan',
            'menu' => 'limitTagihan',
            'page' => 'limitTagihan/v_limitTagihan',
            'data' => $this->LimitTagihanModel->getAllData(),
        ];
        
        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'limit_bayar_tagihan'=> 'required|validate_rupiah',
            ];

            $messages = [
                'limit_bayar_tagihan' => [
                    'required'          => 'Limit Bayar Tagihan harus diisi.',
                    'validate_rupiah'   => 'Format Rupiah Limit Bayar Tagihan tidak valid.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataInsert = [
                'limit_bayar_tagihan'  => parse_rupiah($this->request->getPost('limit_bayar_tagihan')),
                'sisa_limit_tagihan'  => parse_rupiah($this->request->getPost('limit_bayar_tagihan')),
                'limit_digunakan'  => parse_rupiah(0)
            ];
            // echo "<pre>";
            // var_dump($dataInsert);
            // echo "</pre>";
            // die;
        
            if ($this->LimitTagihanModel->createData($dataInsert)) {
                session()->setFlashdata('success', 'Data Limit Bayar Tagihan Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Limit Bayar Tagihan.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Limit Bayar Tagihan.');
        }

        return redirect()->to('limit_tagihan');
    }

    public function update($id)
    {
        // echo "<pre>";
        // var_dump($this->request->getPost());
        // echo "</pre>";
        // die;
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'limit_bayar_tagihan'=> 'required|validate_rupiah',
            ];

            $messages = [
                'limit_bayar_tagihan' => [
                    'required'          => 'Limit Bayar Tagihan harus diisi.',
                    'validate_rupiah'   => 'Format Rupiah Limit Bayar Tagihan tidak valid.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }


            $limit_digunakan = $this->request->getPost('limit_digunakan');
            $limit_bayar_taguhan = parse_rupiah($this->request->getPost('limit_bayar_tagihan'));
            // echo "<pre>";
            // var_dump($limit_digunakan);
            // var_dump($limit_bayar_taguhan);
            // echo "</pre>";
            // die;

            if(!($limit_bayar_taguhan > $limit_digunakan)) {
                return redirect()->back()->withInput()->with('error', 'Pastikan Limit Bayar Tagihan melebihi Limit yang digunakan.');
            }

            $dataUpdate = [
                'sisa_limit_tagihan'  => $limit_bayar_taguhan - $limit_digunakan,
                'limit_bayar_tagihan'  => parse_rupiah($this->request->getPost('limit_bayar_tagihan'))
            ];

            if ($this->LimitTagihanModel->updateData($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Limit Bayar Tagihan Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Limit Bayar Tagihan.');
            }
        } else {
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Limit Bayar Tagihan.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }

        return redirect()->to('limit_tagihan');
    }
}
