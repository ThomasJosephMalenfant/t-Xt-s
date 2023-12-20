<?php

namespace App\Models;

use CodeIgniter\Model;

class LivresModel extends Model
{
    protected $table = 'livres';

    public function getLivres($abbr = false)
    {
        if ($abbr === false) {
            return $this->findAll();
        }

        return $this->where(['abbr' => $abbr])->first();
    }

}