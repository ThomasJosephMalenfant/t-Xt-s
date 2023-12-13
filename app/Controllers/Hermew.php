<?php

namespace App\Controllers ;

/**
 * Class Hermew "interpréter"
 *
 * Classe temporaire pour implémenter rapidement 
 * et tester progressivement la mécanique de sélection 
 * pour un retour simple html. 
 * 
 * Une fois fonctionnelle, 
 *  1) la mécanique de sélection devra être 
 *      transférée complètement à la classe parent
 *      BaseController
 *  2) traduire le output en json sur App\Controllers\Api
 *  3) Détruire $this + modif Route.php et Views 
 * 
 */
class Hermew extends BaseController
{
    
    public function index() :string
    {
        //NEXT function bidon pour cascade $param URI, $GET , $user('settings')

        //TODO Structurer + Populer DB ?
        
        //TODO Rqst Model

        $data['title'] = "Test hermew" ;
        return view('templates/header', $data)
            . view('hermew', $data)
            . view('templates/footer', $data) ;
    }

}