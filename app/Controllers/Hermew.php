<?php

namespace App\Controllers ;

class Hermew extends BaseController {

    public function index() :string
    {
        $data['title'] = "Test hermew" ;
        return view('templates/header', $data)
            . view('hermew', $data)
            . view('templates/footer', $data) ;
    }

}