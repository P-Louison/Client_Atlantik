<?php
namespace App\Controllers;
use App\Models\ModeleAdministrateur;
use App\Models\ModeleClient; 
use App\Models\ModeleCategorie; 
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
        helper(['form']);
        $tab = array();
        $data['notraversee'] = $notraversee;

        $modCategorie = new ModeleCategorie();
        $categorie = $modCategorie->findAll();

        $modTarif = new ModeleTarif();
        $date = $modTarif->getNoPeriode($session->get('date'));
        foreach($date as $uneDate)
        {
            $periode = $uneDate->PERIODE;
        }
        $data['tarif'] = $modTarif->getTypeTarif($periode, $session->get('noliaison'));
        
        $session->set('tarif',$data['tarif']);

        $data['valeurSuperieur'] = False;

        if (isset($_POST['btnValider']))
        {
        $tab = array();
        $montanttotal = 0;
        
            if (isset($_POST['type']))
            {
                $dateheureIns = date('Y-m-d H:i:s');
                $compte = 0;
                foreach ($_POST['type'] as $unType)
                {
                    if ($unType['quantite'] != "")
                    {
                        $tabType = array();
                        $montanttotal += ((float)($unType['tarif'])) * ((float)($unType['quantite']));
                        $tabType['libelle'] = $unType['libelle'];
                        $tabType['notype'] = $unType['notype'];
                        $tabType['quantite'] = $unType['quantite'];
                        $tabType['lettrecategorie'] = $unType['lettrecategorie'];
                        $tab[$compte] = $tabType;
                        $compte++;          
                    }        
                }
                $nbdemande = array();
                foreach($categorie as $uneCategorie)
                {
                    $nbdemande[$uneCategorie->LETTRECATEGORIE] = 0 ;
                }
                
                
                foreach($nbdemande as $cle => $valeur)
                {
                    foreach($_POST['type'] as $unType)
                    {
                        if($unType['quantite'] != "")
                        {
                            if($cle == $unType['lettrecategorie'])
                            {
                                $nbdemande[$cle] += (int)($unType['quantite']);
                            }
                        }
                        
                    }  

                }   
                

                
                
                if ($tab != array())
                {

                    foreach($nbdemande as $cle => $valeur)
                    {
                        
                        foreach($session->get('caparestante')[$notraversee] as $element => $partie)
                        {
                            if($cle == $element)
                            {
                                if($valeur > (int)($partie))
                                {                                    
                                    $data['valeurSuperieur'] = True;
                                    return view('Templates/Header') 
                                    . view('Client/vue_ReserveTraverser', $data)
                                    . view('Templates/Footer'); 
                                }
                            }
                        }
                    }

                    $donneesAInserer = array(
                    'notraversee' => (int)($notraversee),
                    'noclient' => (int)$session->get('noclient'),
                    'dateheure' => $dateheureIns,
                    'montanttotal' => (double)($montanttotal),
                    'paye' => 1,
                    'modereglement' => null,            
                    ); 
                    
                    $modReservation = new ModeleReservation(); 
                    $noreservation = $modReservation->insert($donneesAInserer, true);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                    
                    foreach($tab as $unType)
                    {
                         $donneesAInserer = array(
                        'NORESERVATION' => (int)$noreservation,
                        'LETTRECATEGORIE' => $unType['lettrecategorie'],
                        'NOTYPE' => (int)($unType['notype']),
                        'QUANTITERESERVEE' => (int)$unType['quantite'],
                        'QUANTITEEMBARQUEE' => 0,
                            ); 
                        
                        $modEnregistrer = new ModeleEnregistrer(); 
                        $modEnregistrer->insert($donneesAInserer, false);
                    }
                       
                    
                }
                else
                {
                    $data['tab'] = $tab;
                    return view('Templates/Header') 
                    . view('Client/vue_ReserveTraverser', $data)
                    . view('Templates/Footer'); 
                }
                
            } 
            $data['tab'] = $tab;
            return view('Templates/Header') 
            . view('Client/vue_pageConfirmation', $data)
            . view('Templates/Footer'); 
        
        } 
        else
        {
            $data['tab'] = 0;
            return view('Templates/Header') 
            . view('Client/vue_ReserveTraverser', $data)
            . view('Templates/Footer'); 
        }         

        
                
    }

    public function pageconfirmation()
    {

        $session = session();

        $type = ($session->get('type'));




        var_dump($session->get('type'));
        die();
        
    
        $session->set('heureresa', $dateheureIns);

        

        

        
        foreach($type as $unType)
        {
        
            
        }
        
        
        
        
        
                
    }

}   