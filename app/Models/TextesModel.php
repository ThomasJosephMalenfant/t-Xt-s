<?php

namespace App\Models;

use CodeIgniter\Model;

class TextesModel extends Model
{
    protected $table = 'textes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'chapitre',
        'verset',
        'texte',
        'ordinal',
        'livres_id',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getVerset (int $livre_id, int $chapitre, int $verset)
    {
        return $this->where([
                            'livres_id' => $livre_id,
                            'chapitre' => $chapitre,
                            'verset' => $verset,
                            ])->first() ;
    }

    public function getVersetById (int $id)
    {
        return $this->where(['id' => $id])->first() ;
    }

    public function getMaxVersetByChapitre (int $livre_id, int $chapitre)
    {
        return $this->selectMax('verset')
                    ->where(['livres_id' => $livre_id, 'chapitre' => $chapitre])
                    ->first()['verset'];
    }

    public function getVersetsByRange (int $livre_id, string $range)
    {
        $versets = array();
        $array_sans_livre = explode(".", $range);
        $depart_chapitre = "" ;
        $depart_verset = "" ;
        $fin_chapitre = "" ; 
        $fin_verset = "" ;

        foreach ($array_sans_livre as $chunk) {
            $pre_extremites = explode("-",$chunk);
            $extremites = array();

            // Virgule ou chapitre déjà mentionné, donc interpréter départ 
            if (strpos($pre_extremites[0], ",") OR $depart_chapitre) {
                // Virgule, donc chapitre avant et verset après
                if (strpos($pre_extremites[0], ",")) {
                    $depart_chapitre = trim(explode(",", $pre_extremites[0])[0]);
                    $depart_verset = trim(explode(",", $pre_extremites[0])[1]);
                // Sinon, chapitre implicite, verset seul de départ
                } else {
                    $depart_verset = trim($pre_extremites[0]) ;
                }
                // Plus d'une extremité, donc interpréter fin
                if (isset($pre_extremites[1])) {
                    // Virgule, donc chapitre fin différent du départ
                    if ( strpos( $pre_extremites[1], ",")) {
                        $fin_chapitre = trim(explode(",", $pre_extremites[1])[0]) ;
                        $fin_verset = trim(explode(",", $pre_extremites[1])[1]);
                    // Sinon chapitre implicite	
                    } else {
                        $fin_chapitre = $depart_chapitre ;
                        $fin_verset = trim($pre_extremites[1]) ;
                    }
                // Pas de tiret donc mono-verset donc $fin = $depart 
                } else { 
                    $fin_chapitre = $depart_chapitre ;
                    $fin_verset = $depart_verset ;
                }
            // Pas de virgule, donc chapitres entiers
            } else {
                $depart_chapitre = $pre_extremites[0] ;
                $depart_verset = "1" ;
                // Plus d'un chapitre
                if (isset($pre_extremites[1])) {
                    if ( strpos( $pre_extremites[1], ",")) {
                        $fin_chapitre = trim(explode(",", $pre_extremites[1])[0]) ;
                        $fin_verset = trim(explode(",", $pre_extremites[1])[1]);	
                    } else {
                        $fin_chapitre = trim($pre_extremites[1]) ;
                        $fin_verset = "MAX" ;
                    }
                // Chapitre seul			
                } else {
                    $fin_chapitre = $depart_chapitre ;
                    $fin_verset = "MAX" ;
                }
                if ($fin_verset == "MAX") {
                    $fin_verset = $this->getMaxVersetByChapitre($livre_id, $fin_chapitre) ;
                }
            }

            $extremites[0] = array("chapitre"=>$depart_chapitre, "verset"=>$depart_verset);
            $extremites[1] = array("chapitre"=>$fin_chapitre, "verset"=>$fin_verset);

            // Tester l'existence des 2 extremités
            for ($i=0; $i < 2 ; $i++) {
                $un_boutte = $this->getVerset($livre_id, $extremites[$i]['chapitre'], $extremites[$i]['verset']) ; 
                if ( $un_boutte === null ) {
                    return null ;
                }
                $extremites[$i]['id'] = $un_boutte['id'] ;
            }
            
            // Teste si la fin est après le début

            if( $extremites[0]["id"] <= $extremites[1]["id"] ) {
                $nouveaux = $this->where('id >=',$extremites[0]["id"])
                                ->where('id <=',$extremites[1]["id"])
                                ->findAll() ;
                $versets = array_merge($versets, $nouveaux ) ;
            } else { 
                return null ;
            }
        }

        return $versets ;
    }

}