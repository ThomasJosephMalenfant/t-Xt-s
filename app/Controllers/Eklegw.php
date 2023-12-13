<?php

namespace App\Controllers ;

/**
 * Class Eklegw "choisir"
 * 
 * À attaquer quand les autres controllers 
 * seront prêts et testés ! L'idée est de proposer
 * des "formats" de rites pour construction 
 * rapide, simple et visuelle de cahier de célébration.
 */
class Eklegw extends BaseController
{

    public function index() :string
    {
        $data['title'] = "Test eklegw" ;
        return view('templates/header', $data)
            . view('eklegw', $data)
            . view('templates/footer', $data) ;
    }

}