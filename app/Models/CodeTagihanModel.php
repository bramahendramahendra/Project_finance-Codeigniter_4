<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeTagihanModel extends Model
{
    protected $table            = 'code_tagihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['code_awal', 'code_akhir', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getAllCodeTagihan() {
        return $this->findAll();
    }

    public function createCodeTagihan($data) 
    {
        $this->db->transStart();
        if (!$this->insert($data)) {
            $this->db->transRollback();
            return false;
        }
        $this->db->transComplete();
        return true;
    }

    public function updateCodeTagihan($id, $data) 
    {
        $this->db->transStart();
        if (!$this->update($id, $data)) {
            $this->db->transRollback();
            return false;
        }
        $this->db->transComplete();
        return true;
    }

    public function resetCodeTagihan($id, $data) 
    {
        $this->db->transStart();
        if (!$this->update($id, $data)) {
            $this->db->transRollback();
            return false;
        }
        $this->db->transComplete();
        return true;
    }
}
