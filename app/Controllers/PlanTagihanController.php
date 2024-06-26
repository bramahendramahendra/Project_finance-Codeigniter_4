<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PlanTagihanModel;
use App\Models\NamaTagihanModel;
use App\Models\KategoriTagihanModel;
use App\Models\StatusModel;
use App\Models\BungaTagihanModel;
use App\Models\LimitTagihanModel;
use App\Traits\ErrorHandlerTrait;

class PlanTagihanController extends BaseController
{
    use ErrorHandlerTrait;

    public function __construct() 
    {
        $this->PlanTagihanModel = new PlanTagihanModel();
        $this->BungaTagihanModel = new BungaTagihanModel();
        $this->LimitTagihanModel = new LimitTagihanModel();
        $this->StatusModel = new StatusModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Plan Tagihan',
            'menu' => 'planTagihan',
            'page' => 'planTagihan/v_planTagihan',
            'data' => $this->PlanTagihanModel->getAllData(),
            'dataBungaTagihan' => $this->BungaTagihanModel->getAllData()[0],
        ];

        return view('v_template', $data);
    }

    public function detail()
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            $id = session()->getFlashdata('id');
        }
    
        if (!$id) {
            return redirect()->to('plan_tagihan');
        }    

        $data = $this->PlanTagihanModel->getDataByIdNamaTagihan($id);

        if (!$data) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        $optionsStatus = $this->StatusModel->getStatusByIdJenisStatus($this->statusPlanTagihan);
        if (empty($optionsStatus)) {
            return $this->showErrorPage(500, 'planTagihan','Terjadi Kesalahan pada Plan Tagihan !', 'Harap isi status terlebih dahulu sebelum melanjutkan.');
        }

        $data = [
            'judul' => 'Plan Tagihan',
            'menu' => 'planTagihan',
            'page' => 'planTagihan/v_detail_planTagihan',
            'data' => $data,
            'dataBungaTagihan' => $this->BungaTagihanModel->getAllData(),
            'dataLimitTagihan' => $this->LimitTagihanModel->getAllData()[0],
            'optionsStatus' => $optionsStatus,
        ];

        // echo "<pre>";
        // var_dump($data['data']['data_plan']);
        // echo "</pre>";
        // die;

        return view('v_template', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'POST') {

            // echo "<pre>"; 
            // var_dump($this->request->getPost());
            // echo "</pre>";
            // die;

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
                ],
                'sisa_jumlah_tagihan_tanpa_bunga' => [
                    'required' => 'Sisa Jumlah Tagihan tanpa Bunga harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Sisa Jumlah Tagihan tanpa Bunga tidak valid.'
                ]
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataInsertPlan = [
                'id_nama_tagihan'         => $this->request->getPost('id_nama_tagihan'),
                'plan'                    => $this->request->getPost('plan'),
                'jangka_waktu'            => $this->request->getPost('jangka_waktu'),
                'cicilan'                 => parse_rupiah($this->request->getPost('cicilan')),
                'cicilan_dengan_bunga'    => parse_rupiah($this->request->getPost('cicilan_dengan_bunga')),
                'pembulatan_cicilan'      => parse_rupiah($this->request->getPost('pembulatan_cicilan')),
                'total_tagihan'           => parse_rupiah($this->request->getPost('total_tagihan')),
                'total_kelebihan_tagihan' => parse_rupiah($this->request->getPost('total_kelebihan_tagihan')),
                'status_plan'             => 6
            ];

            $dataInsertSummary = [
                'id_nama_tagihan'         => $this->request->getPost('id_nama_tagihan'),
                'jumlah_debit'            => 0,
                'jumlah_debit_tanpa_bunga'=> 0,
                'jumlah_kredit'           => 0,
                'sisa_tagihan'            => parse_rupiah($this->request->getPost('total_tagihan')),
                'sisa_tagihan_tanpa_bunga'=> parse_rupiah($this->request->getPost('sisa_jumlah_tagihan_tanpa_bunga')),
            ];
            // echo"<pre>";
            // var_dump($dataInsert);
            // echo"</pre>";
            // die;

            if ($this->PlanTagihanModel->createData($dataInsertPlan, $dataInsertSummary)) {
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
                'plan' => 'required|integer',
                'jangka_waktu' => 'required|integer',
                'cicilan' => 'required|validate_rupiah',
                'cicilan_dengan_bunga' => 'required|validate_rupiah',
                'pembulatan_cicilan' => 'required|validate_rupiah',
                'total_tagihan' => 'required|validate_rupiah',
                'total_kelebihan_tagihan' => 'required|validate_rupiah',
            ];

            // echo "<pre>";
            // var_dump($rules);
            // echo "</pre>";
            // die;

            $messages = [
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
                'id_nama_tagihan'         => $id,
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

    public function change_status($id)
    {
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            // echo "<pre>";
            // var_dump($this->request->getPost());
            // echo "</pre>";
            // die;


            $rules = [
                'status'    => 'required|integer',
            ];

            $messages = [
                'status' => [
                    'required' => 'Status harus diisi.',
                    'integer' => 'Status harus berupa angka.'
                ]
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataUpdate = [
                'status_plan'    => $this->request->getPost('status')
            ];
            
            // echo "<pre>";
            // var_dump($id);
            // var_dump($dataUpdate);
            // echo "</pre>";
            // die;
            if ($this->PlanTagihanModel->updateData($id, $dataUpdate)) {
                session()->setFlashdata('success', 'Status Data Plan Tagihan Berhasil Diupdate.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Status Data Plan Tagihan.');
            }
        } else { 
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Status Data Plan Tagihan.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }
        
        session()->setFlashdata('id', $id);
        return redirect()->to('plan_tagihan/detail');
        // return redirect()->to('plan_tagihan');
    }

    public function run_plan($id)
    {
        $id_nama_tagihan = "";
        if ($this->request->getMethod() === 'POST' && ($id !== '' && !empty($id))) {
            $rules = [
                'id_nama_tagihan' => 'required|integer',
                'sisa_limit_tagihan' => 'required|validate_rupiah',
                'pembulatan_cicilan' => 'required|validate_rupiah',
                'sisa_limit' => 'required|validate_rupiah',
                'limit_digunakan' => 'required|validate_rupiah',
            ];

            $messages = [
                'id_nama_tagihan' => [
                    'required' => 'ID Nama Tagihan harus diisi.',
                    'integer' => 'ID Nama Tagihan harus berupa angka.'
                ],
                'sisa_limit_tagihan' => [
                    'required' => 'Sisa Limit Tagihan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Sisa Limit Tagihan tidak valid.'
                ],
                'pembulatan_cicilan' => [
                    'required' => 'Pembulatan Cicilan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Pembulatan Cicilan tidak valid.'
                ],
                'sisa_limit' => [
                    'required' => 'Sisa Limit harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Sisa Limit tidak valid.'
                ],
                'limit_digunakan' => [
                    'required' => 'Limit digunakan harus diisi.',
                    'validate_rupiah' => 'Format Rupiah Limit digunakan tidak valid.'
                ]
            ];

            $this->validation->setRules($rules, $messages);

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $id_nama_tagihan = $this->request->getPost('id_nama_tagihan');

            $sisa_limit_tagihan = parse_rupiah($this->request->getPost('sisa_limit_tagihan'));
            $pembulatan_cicilan = parse_rupiah($this->request->getPost('pembulatan_cicilan'));
            $sisa_limit = parse_rupiah($this->request->getPost('sisa_limit'));
            $limit_digunakan = parse_rupiah($this->request->getPost('limit_digunakan'));

            if(!($sisa_limit_tagihan > $pembulatan_cicilan)) {
                return redirect()->back()->withInput()->with('error', 'Pastikan Tagihan yang anda bayarkan tidak melebihi Limit yang tersedia saat ini.');
            }

            $result_sisa_limit_tagihan = $sisa_limit_tagihan - $pembulatan_cicilan;
            $result_limit_digunakan = $pembulatan_cicilan + $limit_digunakan;
        
            if(!($result_sisa_limit_tagihan === $sisa_limit)){
                if(!($limit_bayar_taguhan > $limit_digunakan)) {
                    return redirect()->back()->withInput()->with('error', 'Cek kembali inputan pembulatan Tagihan anda.');
                }
            }

            $dataUpdatePlan = [
                'status_plan'    => 7
            ];
            
            $dataUpdateLimit = [
                'sisa_limit_tagihan'    => $result_sisa_limit_tagihan,
                'limit_digunakan'    => $result_limit_digunakan
            ];

            // echo "<pre>";
            // var_dump($id);
            // var_dump($dataUpdatePlan);
            // echo "</pre>";
            // die;

            
           if ($this->PlanTagihanModel->runData($id, $dataUpdatePlan, $dataUpdateLimit)) {
                session()->setFlashdata('success', 'Data Plan Tagihan anda Berhasil Dijalankan.');
            } else {
                session()->setFlashdata('error', 'Gagal Mengupdate Data Plan Tagihan, Plan tagihan saat ini gagal dijalankan.');
            }
        } else { 
            if($this->request->getMethod() === 'POST') {
                session()->setFlashdata('error', 'Gagal Menambahkan Input Status Data Plan Tagihan dijalankan.');
            } else {
                session()->setFlashdata('error', 'Gagal! ID tidak ditemukan.');
            }
        }
        
        session()->setFlashdata('id', $id_nama_tagihan);
        return redirect()->to('plan_tagihan/detail');
    }
}
