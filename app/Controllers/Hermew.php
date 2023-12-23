<?php

namespace App\Controllers ;

use App\Models\VersionsModel;
use App\Models\LivresModel;
use App\Models\TextesModel;

use CodeIgniter\Exceptions\PageNotFoundException;


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
    protected $helpers = ['form'];
    public function search() :string
    {
        $data['title'] = "Votre référence" ;

        return view('templates/header', $data)
            . view('hermew/search')
            . view('templates/footer') ;
    }
    public function find($seg1 = null, $seg2 = null) :string
    {
        $default_version = "aelf" ;
        $model = model(VersionsModel::class);

        if ($this->request->is('post')) {
            $rules = [
                'ref' => 'required'
            ];

            if (! $this->validate($rules)) return $this->search();
            
            $segments = $this->validator->getValidated()['ref'];
            $post_version = trim(explode(" ",$segments)[0]) ;
            $version = $model->getVersions($post_version);
            if ($version === null) {
                $version = $model->getVersions($default_version);
                $seg2 = $segments ;
            } else {
                $seg1 = $post_version;
                $seg2 = substr($segments, strpos($segments, " ") + 1) ;
            }
        } else {
            $version = $model->getVersions($seg1);            
            if ($version === null) {
                $seg2 = $seg1 ;
                $version = $model->getVersions($default_version);
            }
        }

        $ref_livre = trim(explode(" ",$seg2)[0]);
        $model = model(LivresModel::class);
        $livre = $model->getLivres($version["id"], $ref_livre);

        if ($livre === null) {
            throw new PageNotFoundException('Pas trouvé livre : ' . $ref_livre);
        }


        $ref_sans_livre = substr(strstr($seg2," "),1);

        $model = model(TextesModel::class);
        $textes = $model->getVersetsByRange($livre['id'], $ref_sans_livre);

        if ($textes === null) {
            throw new PageNotFoundException('Référence erronée.' );
        }

        $data = [
            'title' => $livre['titre'],
            'reference' => $seg2,
            'textes' => $textes,
        ] ;
        return view('templates/header', $data)
            . view('hermew/find')
            . view('templates/footer') ;
    }

}