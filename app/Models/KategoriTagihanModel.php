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
    protected $allowedFields    = ['kategori', 'deskripsi', 'created_at', 'updated_at'];


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
        return $this->findAll();
    }

    public function getKategoriById($id) {
        return $this->find($id);
    }

    public function createKategori($data) 
    {
        echo "<pre>tes";
        var_dump($data);
        echo "<pre>";
        $this->save($data);
        echo 'tes';die;
        return ;
    }

    public function updateKategori($id, $data) 
    {
        return $this->update($id, $data);
    }

     public function deleteKategori($id) 
    {
        return $this->delete($id);
    }
}
