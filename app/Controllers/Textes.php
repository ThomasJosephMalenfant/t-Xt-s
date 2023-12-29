<?php

namespace App\Controllers ;

use App\Models\VersionsModel;
use App\Models\LivresModel;

use CodeIgniter\Exceptions\PageNotFoundException;

class Textes extends BaseApiController
{
    protected $modelName = 'App\Models\TextesModel';
    protected $format    = 'json';

    public function index()
    {
        // Pour éviter un dump trop gros de la table "textes"...
        return $this->show('1');
    }
    
    public function show($seg1 = null, $seg2 = null)
    {
        if ($seg1 === null) {
            return null ;
        }

        // Tester si $segment = id
        if ($segment_int = intval($seg1)) {    
            return $this->respond($this->model->getVersetById($segment_int)) ;
        }

        $default_version = "aelf" ;
        $model = model(VersionsModel::class);
        
        $version = $model->getVersions($seg1);            
        if ($version === null) {
            $seg2 = $seg1 ;
            $version = $model->getVersions($default_version);
        }

        $ref_livre = trim(explode(" ",$seg2)[0]);
        $model = model(LivresModel::class);
        $livre = $model->getLivres($version["id"], $ref_livre);

        if ($livre === null) {
            throw new PageNotFoundException('Pas trouvé livre : ' . $ref_livre);
        }

        $ref_sans_livre = substr(strstr($seg2," "),1);

        $textes = $this->model->getVersetsByRange($livre['id'], $ref_sans_livre);

        if ($textes === null) {
            throw new PageNotFoundException('Référence erronée.' );
        }

        return $this->respond($textes);
    }
}