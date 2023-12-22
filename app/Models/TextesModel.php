<?php

namespace App\Models;

use CodeIgniter\Model;

class TextesModel extends Model
{
    protected $table = 'textes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'chapitre',
        'verset',
        'texte',
        'ordinal',
        'livres_id',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}