<?php

namespace App\Controllers ;

use App\Models\VersionsModel;
use App\Models\LivresModel;
use App\Models\TextesModel;

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
        $data['title'] = "Formulaire" ;

        return view('templates/header', $data)
        . view('templates/footer') ;
    }
    public function search($seg1 = null, $seg2 = null) :string
    {

        //NEXT function bidon pour cascade $param URI, $GET , $user('settings')
        //TODO Paramètrer langue
        $langue = 'fr' ;
        //TODO Paramètrer corpus
        $corpus = 'Xt' ;
        //TODO Paramètrer version
        $model = model(VersionsModel::class);
        $version = $model->getVersions($seg1);
        if ($version === null) {
            $seg2 = $seg1 ;
            $version = $model->getVersions("aelf");
        }

        $ref_livre = trim(explode(" ",$seg2)[0]);
        $model = model(LivresModel::class);
        $livre = $model->getLivres($version["id"], $ref_livre);

        if ($livre === null) {
            dd("Aucun livre abbrévié : ".$ref_livre . " dans cette version");
        }

        $ref_sans_livre = substr(strstr($seg2," "),1);

        $model = model(TextesModel::class);
        $textes = $model->getVersetsByRange($livre["id"], $ref_sans_livre);

        $data = [
            'title' => "Test hermew",
            'langue' => $langue,
            'corpus' => $corpus,
            'version' => $version['nom'],
            'reference' => $ref_sans_livre,
        ] ;

        $table = new \CodeIgniter\View\Table();
        
        return view('templates/header', $data)
            . view('hermew')
            . $table->generate($textes)
            . view('templates/footer') ;
    }

}