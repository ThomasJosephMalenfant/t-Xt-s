<?php

namespace App\Controllers ;
use App\Models\CorpusModel;

/**
 * Classe Grafw "écrire"
 * 
 * Contrôle la mécanique d'édition de la DB
 * 
 * Prévoir deux fonctions selon :
 *  ->get() : page de sélection et édition
 *  ->post() : méthode de validation et updt DB
 * 
 */
class Grafw extends BaseController
{

    public function index() :string
    {
        $model = model(CorpusModel::class);
        $data['title'] = "Grafw" ;

        $data['corpus'] = $model->getCorpus() ;
        
        return view('templates/header', $data)
            . view('grafw/center')
            . view('templates/footer') ;
    }

}