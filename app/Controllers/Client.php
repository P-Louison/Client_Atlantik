<?php
namespace App\Controllers;
use App\Models\ModeleAdministrateur;
use App\Models\ModeleClient; 
use App\Models\ModeleLiaison;
use App\Models\ModeleTarif;
use App\Models\ModelePeriode;
use App\Models\ModeleSecteur;
use App\Models\ModeleTraverse;
use App\Models\ModeleReservation;
use App\Models\ModeleEnregistrer;


helper(['assets']); 
 
class Client extends BaseController
{
    public function reservetraverse($notraversee)
    {
        $session = session();

        $session->set('notraversee',$notraversee);

        $modCategorie = new ModeleTarif();
        $date = $modCategorie->getNoPeriode($session->get('date'));
        foreach($date as $uneDate)
        {
            $periode = $uneDate->PERIODE;
        }
        $data['tarif'] = $modCategorie->getTypeTarif($periode, $session->get('noliaison'));
        
        $session->set('tarif',$data['tarif']);

        return view('Templates/Header') 
        . view('Client/vue_ReserveTraverser', $data)
        . view('Templates/Footer'); 
                
    }

    public function pageconfirmation()
    {

        $session = session();

        $type = ($session->get('type'));

        var_dump($session->get('type'));
        die();
        $dateheureIns = date('Y-m-d H:i:s');
    
        $session->set('heureresa', $dateheureIns);

        $donneesAInserer = array(
            'notraversee' => (int)($session->get('notraversee')),
            'noclient' => (int)$session->get('noclient'),
            'dateheure' => $dateheureIns,
            'montanttotal' => (double)$session->get('montanttotal'),
            'paye' => 1,
            'modereglement' => null,            
        ); 
        
        $modReservation = new ModeleReservation(); 
        $modReservation->insert($donneesAInserer, false);
        $noreservation = $modReservation->getnoreservation();

        

        
        foreach($type as $unType)
        {
        
            $donneesAInserer = array(
                'noreservation' => (int)$noreservation,
                'lettrecategorie' => $unType['lettrecategorie'],
                'notype' => (int)$unType['notype'],
                'quantitereservee' => (int)$unType['quantite'],
                'quantitembarquee' => null,
            ); 
        
        $modEnregistrer = new ModeleEnregistrer(); 
        $modEnregistrer->insert($donneesAInserer, false);
        }
        
        return view('Templates/Header') 
        . view('Client/vue_pageConfirmation')
        . view('Templates/Footer'); 
        
        
        
                
    }

}   