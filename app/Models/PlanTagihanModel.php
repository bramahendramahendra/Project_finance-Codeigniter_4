<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KategoriTagihanModel;
use App\Models\NamaTagihanModel;
use App\Models\DebitTagihanModel;
use App\Models\PlanTagihanModel;
use App\Models\SummaryTagihanModel;

class PlanTagihanModel extends Model
{
    protected $table            = 'plan_tagihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_nama_tagihan', 'plan', 'jangka_waktu', 'cicilan', 'cicilan_dengan_bunga', 'pembulatan_cicilan', 'total_tagihan', 'total_kelebihan_tagihan', 'created_at', 'updated_at', 'deleted_at'];

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
        $debitTagihanModel = new DebitTagihanModel();
        $summaryTagihanModel = new SummaryTagihanModel();

        $dataNamaTagihan = $namaTagihanModel
            ->select('
                nama_tagihan.code, nama_tagihan.nama_tagihan, nama_tagihan.deskripsi, nama_tagihan.jumlah_tagihan, 
                kategori_tagihan.kategori as kategori,
                status.status as nama_status,
            ')
            ->join('kategori_tagihan', 'kategori_tagihan.id = nama_tagihan.id_kategori')
            ->join('status', 'status.id = nama_tagihan.status')
            ->findAll();

            foreach ($dataNamaTagihan as &$tagihan) {
                $dataPlanTagihan = $this
                    ->select('plan_tagihan.plan, plan_tagihan.jangka_waktu, plan_tagihan.cicilan, plan_tagihan.cicilan_dengan_bunga, plan_tagihan.pembulatan_cicilan, plan_tagihan.total_tagihan, plan_tagihan.total_kelebihan_tagihan')
                    ->where('id_nama_tagihan', $tagihan['id'])
                    ->findAll();
              

                if (!empty($dataPlanTagihan)) {
                    $tagihan['status_plan'] = 1;
                    $tagihan = array_merge($tagihan, $dataPlanTagihan[0]);
    
                    $dataDebitTagihan = $debitTagihanModel
                        ->select('debit_tagihan.debit, debit_tagihan.debit_tanpa_bunga, debit_tagihan.debit_month')
                        ->where('id_plan_tagihan', $dataPlanTagihan[0]['id'])
                        ->findAll();
                    $tagihan['debit'] = $dataDebitTagihan;
    
                    $dataSummaryTagihan = $summaryTagihanModel
                        ->select('summary_tagihan.jumlah_debit, summary_tagihan.jumlah_debit_tanpa_bunga, summary_tagihan.jumlah_kredit, summary_tagihan.sisa_tagihan')
                        ->where('id_plan_tagihan', $dataPlanTagihan[0]['id'])
                        ->first();
                    if ($dataSummaryTagihan) {
                        $tagihan = array_merge($tagihan, $dataSummaryTagihan);
                    }
                } else {
                    $tagihan['status_plan'] = 0;
                    // $tagihan['debit'] = [];
                }
            }

        return $dataNamaTagihan;

        // return $this->findAll();
    }

}
