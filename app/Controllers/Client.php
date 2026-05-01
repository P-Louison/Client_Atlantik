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
        . view('Client/vue_ReserveTraverser', $data)
        . view('Templates/Footer'); 
                
    }

    public function pageconfirmation()
    {
        $dateheureIns = ''.$session->get('date').' '.$session->get('heuredepart').'';

        $donneesAInserer = array(
            'notraversee' => (int)$session->get('notraversee'),
            'noclient' => (int)$session->get('noclient'),
            'dateheure' => $dateheureIns,
            'montanttotal' => (double)$session->get('montanttotal'),
            'paye' => 1,
            'modereglement' => null,            
        ); 
        
        $modReservation = new ModeleReservation(); 
        $modReservation->insert($donneesAInserer, true);
        $noreservation = $modReservation->getnoreservation();

        foreach($session->get('type') as $unType)
        {
            $reglesValidation = [
            
            $unType['lettrecategorie'] => 'required|string|max_length[30]',
            $unType['notype'] => 'required|integer|max_length[30]',
            'txtAdresse' => 'required|string|max_length[30]',
            'txtCodePostal' => 'required|is_natural|max_length[10]',
            'txtVille' => 'required|string|max_length[30]',
            'txtTelephoneFixe' => 'required|is_natural',
            'txtTelephoneMobile' => 'required|is_natural',
            'txtMel' => 'required|max_length[254]|valid_email',
            'txtMotDePasse' => 'required|string|max_length[30]',            
            ];
            
            if (!$this->validate($reglesValidation)) 
            {
                $data['TitreDeLaPage'] = 'Saisie compte incorrecte';
                /* formulaire non validé, on renvoie le formulaire */
                return view('Templates/Header')
                . view('Visiteur/vue_CreerUnCompte', $data)
                . view('Templates/Footer');
            }

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
        

        $session = session();
        
        return view('Templates/Header') 
        . view('Client/vue_pageConfirmation')
        . view('Templates/Footer'); 
                
    }

}   