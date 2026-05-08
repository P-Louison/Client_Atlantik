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
    public function reservetraverse($notraversee,$heure)
    {
        $session = session();
        helper(['form']);
        $tab = array();
        $data['notraversee'] = $notraversee;
        $data['heure'] = $heure;

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
                    
                    $session->set('montanttotal', $montanttotal);
                    $session->set('noreservation', $noreservation);
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

    public function modificationcompte($noclient = null)
    {
        helper(['form']);
        $session = session();

        $data['TitreDeLaPage'] = 'modifier le compte';
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        
        if (!$this->request->is('post')) 
        {
            /* le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
            . view('Client/vue_ModificationProfil', $data)
            . view('Templates/Footer');
        }
        
        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* VALIDATION DU FORMULAIRE */
        
        $reglesValidation = [
            
            'txtNom' => 'required|string|max_length[30]',
            'txtPrenom' => 'required|string|max_length[30]',
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
            . view('Client/vue_ModificationProfil', $data)
            . view('Templates/Footer');
        }

        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* INSERTION PRODUIT SAISI DANS BDD */
        
        $donneesAInserer = array(
            'NOM' => $this->request->getPost('txtNom'),
            'PRENOM' => $this->request->getPost('txtPrenom'),
            'ADRESSE' => $this->request->getPost('txtAdresse'),
            'CODEPOSTAL' => $this->request->getPost('txtCodePostal'),
            'VILLE' => $this->request->getPost('txtVille'),
            'TELEPHONEFIXE' => $this->request->getPost('txtTelephoneFixe'),
            'TELEPHONEMOBILE' => $this->request->getPost('txtTelephoneMobile'),
            'MEL' => $this->request->getPost('txtMel'),
            'MOTDEPASSE' => $this->request->getPost('txtMotDePasse'),
            
        ); 
        
        $modelClient = new ModeleClient(); 
        $donnees['comptemodif'] = $modelClient->update($noclient, $donneesAInserer);

        $session->set('nomClient', $this->request->getPost('txtNom'));
        $session->set('prenomClient', $this->request->getPost('txtPrenom'));
        $session->set('adresseClient', $this->request->getPost('txtAdresse'));
        $session->set('cpClient', $this->request->getPost('txtCodePostal'));
        $session->set('villeClient', $this->request->getPost('txtVille'));
        $session->set('telFixeClient', $this->request->getPost('txtTelephoneFixe'));
        $session->set('telPortClient', $this->request->getPost('txtTelephoneMobile'));
        $session->set('melClient', $this->request->getPost('txtMel'));
        $session->set('mdpClient', $this->request->getPost('txtMotDePasse'));


        return view('Templates/Header') 
        . view('Client/vue_RapportCompteModifier', $donnees)
        . view('Templates/Footer'); 
    }

    

}   