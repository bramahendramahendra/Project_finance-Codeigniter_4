<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriTagihanModel extends Model
{
    protected $table            = 'kategori_tagihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kategori', 'deskripsi', 'status', 'created_at', 'updated_at', 'deleted_at'];


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

    public function getAllKategori() {
        $this->select('kategori_tagihan.*, status.status as nama_status');
        $this->join('status', 'status.id = kategori_tagihan.status');
        return $this->findAll();
    }

    public function getKategoriById($id) {
        return $this->find($id);
    }

    public function createKategori($data) 
    {
        $this->db->transStart();
        if (!$this->insert($data)) {
            $this->db->transRollback();
            return false;
        }
        // echo $this->db-last_query();
        // echo $this->db->getLastQuery();
        // die;
        $this->db->transComplete();
        return true;
    }

    public function updateKategori($id, $data) 
    {
        $this->db->transStart();
        if (!$this->update($id, $data)) {
            $this->db->transRollback();
            return false;
        }
        $this->db->transComplete();
        return true;
    }

    public function deleteKategori($id) 
    {
        $this->db->transStart();
        if (!$this->delete($id)) {
            $this->db->transRollback();
            return false;
        }
        $this->db->transComplete();
        return true;
    }
}
