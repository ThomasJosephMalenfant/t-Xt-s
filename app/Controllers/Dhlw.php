<?php

namespace App\Controllers ;
/**
 * Class Dhlw "montrer"
 * 
 * Mécanique de préparation et mise en page
 * du texte. 
 */
class Dhlw extends BaseController
{

    public function index() :string
    {
        $data['title'] = "Test dhlw" ;
        return view('templates/header', $data)
            . view('dhlw', $data)
            . view('templates/footer', $data) ;
    }

}