<?php
namespace App\Controllers;
use App\Models\ModeleAdministrateur;
use App\Models\ModeleClient; 
use App\Models\ModeleLiaison;
use App\Models\ModeleTarif;
use App\Models\ModelePeriode;
use App\Models\ModeleSecteur;
use App\Models\ModeleTraverse;


helper(['assets']); 
 
class Client extends BaseController
{
    public function reservetraverse($noreservation = null)
    {
        $session = session();
        $modCategorie = new ModeleTarif();
        $date = $modCategorie->getNoPeriode($session->get('date'));
        foreach($date as $uneDate)
        {
            $periode = $uneDate->PERIODE;
        }
        $data['tarif'] = $modCategorie->getTypeTarif($periode, $session->get('noliaison'));
        
        $session->set('tarif',$data['tarif']);

        return view('Templates/Header') 
        . view('Client/ReserveTraverser', $data)
        . view('Templates/Footer'); 
                
    }
}   