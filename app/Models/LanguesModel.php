<?php

namespace App\Models;

use CodeIgniter\Model;

class VersionsModel extends Model
{
    protected $table = 'Versions';

    public function getLangues($abbr = false)
    {
        if ($abbr === false) {
            return $this->findAll();
        }

        return $this->where(['abbr' => $abbr])->first();
    }

}