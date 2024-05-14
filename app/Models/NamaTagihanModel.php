<?php

namespace App\Models;

use CodeIgniter\Model;

class NamaTagihanModel extends Model
{
    protected $table            = 'nama_tagihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori', 'nama_tagihan', 'deskripsi', 'jumlah_tagihan', 'status', 'created_at', 'updated_at', 'deleted_at'];

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
        $this->select('
            nama_tagihan.*, 
            kategori_tagihan.kategori as kategori,
            status.status as status,
        ');
        $this->join('kategori_tagihan', 'kategori_tagihan.id = nama_tagihan.id_kategori');
        $this->join('status', 'status.code_status = nama_tagihan.status');
        return $this->findAll();
    }

    public function getDataById($id) {
        $this->select('
            nama_tagihan.*, 
            kategori_tagihan.kategori as kategori,
            status.status as status,
        ');
        $this->join('kategori_tagihan', 'kategori_tagihan.id = nama_tagihan.id_kategori');
        $this->join('status', 'status.code_status = nama_tagihan.status');
        return $this->find($id);
    }

    public function createData($data) 
    {
        $this->db->transStart();
        if (!$this->insert($data)) {
            $this->db->transRollback();
            return false;
        }
        $this->db->transComplete();
        return true;
    }

    public function updateData($id, $data) 
    {
        $this->db->transStart();
        if (!$this->update($id, $data)) {
            $this->db->transRollback();
            return false;
        }
        $this->db->transComplete();
        return true;
    }

    public function deleteData($id) 
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
