<?php

namespace App\Controllers;

use App\Models\LivresModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Livres extends BaseController
{
    public function index()
    {
        $model = model(LivresModel::class);

        $data = [
            'livres' => $model->getLivres(),
            'title' => 'Liste des livres',
        ];

        return view('templates/header', $data)
            . view('livres/index')
            . view('templates/footer');
    }

    public function show($abbr = null)
    {
        $model = model(LivresModel::class);

        $data['livres'] = $model->getLivres($abbr);

        if (empty($data['livres'])) {
            throw new PageNotFoundException('Pas trouvé livre : ' . $abbr);
        }

        $data['title'] = $data['livres']['nom'];

        return view('templates/header', $data)
            . view('livres/view')
            . view('templates/footer');
    }
}