<?php

namespace App\Controllers ;

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
        $data['title'] = "Test grafw" ;
        return view('templates/header', $data)
            . view('grafw', $data)
            . view('templates/footer', $data) ;
    }

}