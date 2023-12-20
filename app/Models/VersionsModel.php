<?php

namespace App\Models;

use CodeIgniter\Model;

class VersionsModel extends Model
{
    protected $table = 'langues';

    public function getVersions($abbr = false)
    {
        if ($abbr === false) {
            return $this->findAll();
        }

        return $this->where(['abbr' => $abbr])->first();
    }

}