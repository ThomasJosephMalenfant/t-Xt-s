<?php

namespace App\Models;

use CodeIgniter\Model;

class LivresModel extends Model
{
    protected $table = 'livres';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'abbr',
        'nom',
        'description',
        'titre',
        'versions_id',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getLivres($version, $abbr = false)
    {
        if ($abbr === false) {
            return $this->findAll();
        }

        return $this->where(['versions_id' => $version, 'abbr' => $abbr])->first();
    }

}