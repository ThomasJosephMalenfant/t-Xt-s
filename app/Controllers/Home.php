<?php

namespace App\Controllers;
/**
 * Class Home
 * 
 * Générique 
 */
class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = "Home"; 

        return view('templates/header', $data)
            . view('home')
            . view('templates/footer');

    }

    // TODO : ajouter settings()
    
    // TODO : ajouter about()
}
