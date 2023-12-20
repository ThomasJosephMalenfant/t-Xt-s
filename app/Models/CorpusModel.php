<?php

namespace App\Models;

use CodeIgniter\Model;

class CorpusModel extends Model
{
    protected $table = 'corpus';

    public function getCorpus($abbr = false)
    {
        if ($abbr === false) {
            return $this->findAll();
        }

        return $this->where(['abbr' => $abbr])->first();
    }

}