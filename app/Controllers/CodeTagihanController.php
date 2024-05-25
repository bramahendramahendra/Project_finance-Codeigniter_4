<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CodeTagihanModel;

class CodeTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->CodeTagihanModel = new CodeTagihanModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Code Tagihan',
            'menu' => 'codeTagihan',
            'page' => 'codeTagihan/v_codeTagihan',
            'data' => $this->CodeTagihanModel->getAllCodeTagihan(),
        ];
        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'code_awal' => 'required|string',
                'code_akhir' => 'required|integer'
            ];

            $messages = [
                'code_awal' => [
                    'required' => 'Code Awal harus diisi.',
                    'string' => 'Code Awal harus berupa string.'
                ],
                'code_akhir' => [
                    'required' => 'Code Akhir harus diisi.',
                    'integer' => 'Code Akhir harus berupa angka.'
                ],
            ];
            
            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataInsert = [
                'code_awal' => $this->request->getPost('code_awal'),
                'code_akhir' => $this->request->getPost('code_akhir')
            ];
        
            if ($this->CodeTagihanModel->createCodeTagihan($dataInsert)) {
                session()->setFlashdata('success', 'Data Code Tagihan Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Code Tagihan.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Code Tagihan.');
        }

        return redirect()->to('code_tagihan');
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'code_awal' => 'required|string',
                'code_akhir' => 'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataUpdate = [
                'code_awal' => $this->request->getPost('code_awal'),
                'code_akhir' => $this->request->getPost('code_akhir')
            ];

            if ($this->CodeTagihanModel->updateCodeTagihan($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Code Tagihan Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Code Tagihan.');
            }
        } else {
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Code Tagihan.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }

        return redirect()->to('code_tagihan');
    }

    public function reset($id)
    {
        if ($id !== '' && !empty($id)) {
            $dataReset = [
                'code_awal' => 'A',
                'code_akhir' => 0
            ];

            if ($this->CodeTagihanModel->resetCodeTagihan($id, $dataReset)) {
                session()->setFlashdata('success', 'Data Code Tagihan Berhasil Direset.');
            } else {
                session()->setFlashdata('error', 'Gagal Reset Data Code Tagihan.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
        }

        return redirect()->to('code_tagihan');
    }
}
