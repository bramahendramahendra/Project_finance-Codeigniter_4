<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PlanTagihanModel;
use App\Models\NamaTagihanModel;
use App\Models\KategoriTagihanModel;
use App\Models\StatusModel;
use App\Models\BungaTagihanModel;

class PlanTagihanController extends BaseController
{
    public function __construct() 
    {
        $this->PlanTagihanModel = new PlanTagihanModel();
        $this->BungaTagihanModel = new BungaTagihanModel();
        // $this->StatusModel = new StatusModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Plan Tagihan',
            'menu' => 'planTagihan',
            'page' => 'planTagihan/v_planTagihan',
            'data' => $this->PlanTagihanModel->getAllData(),
            'dataBungaTagihan' => $this->BungaTagihanModel->getAllData(),
        ];
        // echo "<pre>";
        // var_dump($data['data'][3]);
        // echo "</pre>";
        // die;

        return view('v_template', $data);
    }

    public function detail()
    {
        $id = $this->request->getPost('id');

        $data = $this->PlanTagihanModel->getDataByIdNamaTagihan($id);

        if (!$data) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        $data = [
            'judul' => 'Plan Tagihan',
            'menu' => 'planTagihan',
            'page' => 'planTagihan/v_detail_planTagihan',
            'data' => $data,
            'dataBungaTagihan' => $this->BungaTagihanModel->getAllData(),
        ];

        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'id_nama_tagihan' => 'required|integer',
                'plan' => 'required|integer',
                'jangka_waktu' => 'required|integer',
                'cicilan' => 'required|validate_rupiah',
                'cicilan_dengan_bunga' => 'required|validate_rupiah',
                'pembulatan_cicilan' => 'required|validate_rupiah',
                'total_tagihan' => 'required|validate_rupiah',
                'total_kelebihan_tagihan' => 'required|validate_rupiah',
            ];

            $messages = [
                'id_nama_tagihan' => [
                    'required' => 'ID Nama Tagihan harus diisi.',
                    'integer' => 'ID Nama Tagihan harus berupa angka.'
                ],
                'plan' => [
                    'required' => 'Plan harus diisi.',
                    'integer' => 'Plan harus berupa angka.'
                ],
                'jangka_waktu' => [
                    'required' => 'Jangka Waktu harus diisi.',
                    'integer' => 'Jangka Waktu harus berupa angka.'
                ],
                'cicilan' => [
                    'required' => 'Cicilan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Cicilan tidak valid.'
                ],
                'cicilan_dengan_bunga' => [
                    'required' => 'Cicilan dengan Bunga harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Cicilan dengan Bunga tidak valid.'
                ],
                'pembulatan_cicilan' => [
                    'required' => 'Pembulatan Cicilan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Pembulatan Cicilan tidak valid.'
                ],
                'total_tagihan' => [
                    'required' => 'Total Tagihan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Total Tagihan tidak valid.'
                ],
                'total_kelebihan_tagihan' => [
                    'required' => 'Total Kelebihan Tagihan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Total Kelebihan Tagihan tidak valid.'
                ]
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataInsert = [
                'id_nama_tagihan'         => $this->request->getPost('id_nama_tagihan'),
                'plan'                    => $this->request->getPost('plan'),
                'jangka_waktu'            => $this->request->getPost('jangka_waktu'),
                'cicilan'                 => parse_rupiah($this->request->getPost('cicilan')),
                'cicilan_dengan_bunga'    => parse_rupiah($this->request->getPost('cicilan_dengan_bunga')),
                'pembulatan_cicilan'      => parse_rupiah($this->request->getPost('pembulatan_cicilan')),
                'total_tagihan'           => parse_rupiah($this->request->getPost('total_tagihan')),
                'total_kelebihan_tagihan' => parse_rupiah($this->request->getPost('total_kelebihan_tagihan'))
            ];
            // echo"<pre>";
            // var_dump($dataInsert);
            // echo"</pre>";
            // die;

            if ($this->PlanTagihanModel->createData($dataInsert)) {
                session()->setFlashdata('success', 'Data Nama Tagihan Berhasil Ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal Menambahkan Data Nama Tagihan.');
            }
        } else {
            session()->setFlashdata('error', 'Gagal Menambahkan Input Data Nama Tagihan.');
        }

        return redirect()->to('plan_tagihan');
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'id_nama_tagihan' => 'required|integer',
                'plan' => 'required|integer',
                'jangka_waktu' => 'required|integer',
                'cicilan' => 'required|validate_rupiah',
                'cicilan_dengan_bunga' => 'required|validate_rupiah',
                'pembulatan_cicilan' => 'required|validate_rupiah',
                'total_tagihan' => 'required|validate_rupiah',
                'total_kelebihan_tagihan' => 'required|validate_rupiah',
            ];

            $messages = [
                'id_nama_tagihan' => [
                    'required' => 'ID Nama Tagihan harus diisi.',
                    'integer' => 'ID Nama Tagihan harus berupa angka.'
                ],
                'plan' => [
                    'required' => 'Plan harus diisi.',
                    'integer' => 'Plan harus berupa angka.'
                ],
                'jangka_waktu' => [
                    'required' => 'Jangka Waktu harus diisi.',
                    'integer' => 'Jangka Waktu harus berupa angka.'
                ],
                'cicilan' => [
                    'required' => 'Cicilan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Cicilan tidak valid.'
                ],
                'cicilan_dengan_bunga' => [
                    'required' => 'Cicilan dengan Bunga harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Cicilan dengan Bunga tidak valid.'
                ],
                'pembulatan_cicilan' => [
                    'required' => 'Pembulatan Cicilan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Pembulatan Cicilan tidak valid.'
                ],
                'total_tagihan' => [
                    'required' => 'Total Tagihan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Total Tagihan tidak valid.'
                ],
                'total_kelebihan_tagihan' => [
                    'required' => 'Total Kelebihan Tagihan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Total Kelebihan Tagihan tidak valid.'
                ]
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataUpdate = [
                'id_nama_tagihan'         => $this->request->getPost('id_nama_tagihan'),
                'plan'                    => $this->request->getPost('plan'),
                'jangka_waktu'            => $this->request->getPost('jangka_waktu'),
                'cicilan'                 => parse_rupiah($this->request->getPost('cicilan')),
                'cicilan_dengan_bunga'    => parse_rupiah($this->request->getPost('cicilan_dengan_bunga')),
                'pembulatan_cicilan'      => parse_rupiah($this->request->getPost('pembulatan_cicilan')),
                'total_tagihan'           => parse_rupiah($this->request->getPost('total_tagihan')),
                'total_kelebihan_tagihan' => parse_rupiah($this->request->getPost('total_kelebihan_tagihan'))
            ];
            
            if ($this->PlanTagihanModel->updateData($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Data Plan Tagihan Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Plan Tagihan.');
            }
        } else { 
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Data Plan Tagihan.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }
        
        return redirect()->to('plan_tagihan');
    }
}
