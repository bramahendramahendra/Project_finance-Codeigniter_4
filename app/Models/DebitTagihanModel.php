<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KategoriTagihanModel;
use App\Models\NamaTagihanModel;
// use App\Models\DebitTagihanModel;
use App\Models\PlanTagihanModel;
use App\Models\SummaryTagihanModel;

class DebitTagihanModel extends Model
{
    protected $table            = 'debit_tagihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_plan_tagihan', 'debit', 'debit_tanpa_bunga', 'debit_month', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllData() {
        $namaTagihanModel = new NamaTagihanModel();
        $planTagihanModel = new PlanTagihanModel();
        // $debitTagihanModel = new DebitTagihanModel();
        $summaryTagihanModel = new SummaryTagihanModel();

        $dataNamaTagihan = $namaTagihanModel
            ->select('
                nama_tagihan.id as id_nama_tagihan, nama_tagihan.code, nama_tagihan.nama_tagihan, nama_tagihan.deskripsi, nama_tagihan.jumlah_tagihan, 
                kategori_tagihan.kategori as kategori,
                status.status as nama_status,
            ')
            ->join('kategori_tagihan', 'kategori_tagihan.id = nama_tagihan.id_kategori')
            ->join('status', 'status.id = nama_tagihan.status')
            ->findAll();

            foreach ($dataNamaTagihan as &$tagihan) {
                $dataPlanTagihan = $planTagihanModel
                    ->select('
                        plan_tagihan.id as id_plan, plan_tagihan.plan, plan_tagihan.jangka_waktu, plan_tagihan.cicilan, plan_tagihan.cicilan_dengan_bunga, plan_tagihan.pembulatan_cicilan, plan_tagihan.total_tagihan, plan_tagihan.total_kelebihan_tagihan, plan_tagihan.status_plan,
                        status.status as nama_status_plan
                    ')
                    ->where('id_nama_tagihan', $tagihan['id_nama_tagihan'])
                    ->where('status_plan', 7)
                    ->join('status', 'status.id = plan_tagihan.status_plan')
                    ->findAll();
              

                if (!empty($dataPlanTagihan)) {
                    $tagihan['status_plan'] = 1;
                    // $tagihan = array_merge($tagihan, $dataPlanTagihan[0]);
    
                    foreach ($dataPlanTagihan as &$planTagihan) {
                        # code...
                        $dataDebitTagihan = $this
                            ->select('debit_tagihan.debit, debit_tagihan.debit_tanpa_bunga, debit_tagihan.debit_month')
                            ->where('id_plan_tagihan', $planTagihan['id_plan'])
                            ->findAll();

                        if (!empty($dataDebitTagihan)) {
                           $planTagihan['status_debit'] = 1;
                           $planTagihan['data_debit'] = $dataDebitTagihan;
                        } else {
                            $planTagihan['status_debit'] = 0;
                            $planTagihan['data_debit'] = [];
                        }
                    }
                    $tagihan['data_plan'] = $dataPlanTagihan;
    
                    $dataSummaryTagihan = $summaryTagihanModel
                        ->select('summary_tagihan.jumlah_debit, summary_tagihan.jumlah_debit_tanpa_bunga, summary_tagihan.jumlah_kredit, summary_tagihan.sisa_tagihan')
                        // ->where('id_plan_tagihan', $dataPlanTagihan[0]['id_plan'])
                        ->where('id_nama_tagihan', $tagihan['id_nama_tagihan'])
                        ->first();
                    if ($dataSummaryTagihan) {
                        $tagihan = array_merge($tagihan, $dataSummaryTagihan);
                    }
                } else {
                    $tagihan['status_plan'] = 0;
                    // $tagihan['status_debit'] = 0;
                    $tagihan['data_plan'] = [];
                    // $tagihan['data_debit'] = [];
                }
            }

        $filteredData = array_filter($dataNamaTagihan, function($tagihan) {
            return $tagihan['status_plan'] === 1;
        });

        return array_values($filteredData);
    }
}
