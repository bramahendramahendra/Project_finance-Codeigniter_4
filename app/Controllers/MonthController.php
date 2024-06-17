<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MonthModel;

class MonthController extends BaseController
{
    public function __construct() 
    {
        $this->MonthModel = new MonthModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Month',
            'menu' => 'month',
            'page' => 'month/v_month',
            'data' => $this->MonthModel->getAllData(),
        ];
        
        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'month' => 'required',
            ];

            $messages = [
                'month' => [
                    'required' => 'Month harus diisi.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataInsert = [
                'month'  => $this->request->getPost('month')
            ];
        
            if ($this->MonthModel->createData($dataInsert)) {
                session()->setFlashdata('success', 'Data Month Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Month.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Month.');
        }

        return redirect()->to('month');
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'month'=> 'required',
            ];

            $messages = [
                'month' => [
                    'required'          => 'Month harus diisi.'
                ],
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataUpdate = [
                'month'  => $this->request->getPost('month')
            ];

            if ($this->MonthModel->updateData($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Month Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Month.');
            }
        } else {
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Month.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }

        return redirect()->to('month');
    }
}
