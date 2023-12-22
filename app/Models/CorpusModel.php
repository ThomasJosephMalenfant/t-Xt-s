<?php

namespace App\Models;

use CodeIgniter\Model;

class CorpusModel extends Model
{
    protected $table = 'corpus';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['abbr', 'nom', 'description',];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getCorpus($abbr = false)
    {
        if ($abbr === false) {
            return $this->findAll();
        }

        return $this->where(['abbr' => $abbr])->first();
    }

}