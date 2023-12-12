<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = "Home"; 

        return view('templates/header', $data)
            . view('home')
            . view('templates/footer');

    }
}
