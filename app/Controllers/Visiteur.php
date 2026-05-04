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
 
class Visiteur extends BaseController
{

    public function seConnecter()

    {
        helper(['form']);
        $session = session();
 
        $data['TitreDeLaPage'] = 'Se connecter';
 
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        if (!$this->request->is('post')) {
            return view('Templates/Header', $data) // Renvoi formulaire de connexion
            . view('Visiteur/vue_SeConnecter')
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON POSTE, LE CODE QUI SUIT N'EST PAS EXECUTE */
 
        /* VALIDATION DU FORMULAIRE */
        $reglesValidation = [ // Régles de validation
            'txtIdentifiant' => 'required',
            'txtMotDePasse' => 'required',
        ];
        if (!$this->validate($reglesValidation)) {
            /* formulaire non validé */
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $data)
            . view('Visiteur/vue_SeConnecter') // Renvoi formulaire de connexion
            . view('Templates/Footer');
        }
        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* RECHERCHE UTILISATEUR DANS BDD */
        $Identifiant = $this->request->getPost('txtIdentifiant');
        $MdP = $this->request->getPost('txtMotDePasse');
 
        /* on va chercher dans la BDD l'utilisateur correspondant aux id et mot de passe saisis */
        $modAdministrateur = new ModeleAdministrateur(); // instanciation modèle
        $condition = ['identifiant'=>$Identifiant,'motdepasse'=>$MdP];
        $administrateurRetourne = $modAdministrateur->where($condition)->first();
      
 
        if ($administrateurRetourne != null) {
            /* identifiant et mot de passe OK : identifiant et profil sont stockés en session */
            $session->set('identifiant', $administrateurRetourne->IDENTIFIANT);
            $session->set('profil', "administrateur");
            
            $data['Identifiant'] = $Identifiant;
            echo view('Templates/Header', $data);
            echo view('Visiteur/vue_Accueil');
        } 
        else{
            /* on va chercher dans la BDD l'utilisateur correspondant aux id et mot de passe saisis */
            $modClient = new ModeleClient(); // instanciation modèle
            $condition = ['mel'=>$Identifiant,'motdepasse'=>$MdP];
            $ClientRetourne = $modClient->where($condition)->first();
            
            if ($ClientRetourne != null) {
                /* identifiant et mot de passe OK : identifiant et profil sont stockés en session */
                $session->set('identifiant', $ClientRetourne->MEL);
                $session->set('profil', "client");
                $session->set('noclient', $ClientRetourne->NOCLIENT);
                $session->set('nomClient', $ClientRetourne->NOM);
                $session->set('prenomClient', $ClientRetourne->PRENOM);
                $session->set('adresseClient', $ClientRetourne->ADRESSE);
                $session->set('cpClient', $ClientRetourne->CODEPOSTAL);
                $session->set('villeClient', $ClientRetourne->VILLE);
                
                $data['Identifiant'] = $Identifiant;
                echo view('Templates/Header', $data);
                echo view('Visiteur/vue_Accueil');
            } 
            else {
                /* identifiant et/ou mot de passe OK : on renvoie le formulaire  */
                $data['TitreDeLaPage'] = "Identifiant ou/et Mot de passe inconnu(s)";
                return view('Templates/Header', $data)
                . view('Visiteur/vue_SeConnecter')
                . view('Templates/Footer');
            }      
        }        
    }

    public function seDeconnecter()
    {
        session()->destroy();
        return redirect()->to('accueil');
    }

    public function accueil()
    {     
        return view('Templates/Header') 
        . view('Visiteur/vue_Accueil')
        . view('Templates/Footer');    
    }

    public function creercompte()
    {     
        helper(['form']);

        $data['TitreDeLaPage'] = 'Creer un compte';
        /* TEST SI FORMULAIRE POSTE OU SI APPEL DIRECT (EN GET) */
        
        if (!$this->request->is('post')) 
        {
            /* le formulaire n'a pas été posté, on retourne le formulaire */
            return view('Templates/Header')
            . view('Visiteur/vue_CreerUnCompte', $data)
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
            . view('Visiteur/vue_CreerUnCompte', $data)
            . view('Templates/Footer');
        }

        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* INSERTION PRODUIT SAISI DANS BDD */
        
        $donneesAInserer = array(
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'codepostal' => $this->request->getPost('txtCodePostal'),
            'ville' => $this->request->getPost('txtVille'),
            'telephonefixe' => $this->request->getPost('txtTelephoneFixe'),
            'telephonemobile' => $this->request->getPost('txtTelephoneMobile'),
            'mel' => $this->request->getPost('txtMel'),
            'motdepasse' => $this->request->getPost('txtMotDePasse'),
            
        ); 
        
        $modelClient = new ModeleClient(); 
        $donnees['compteajoutee'] = $modelClient->insert($donneesAInserer, false);
 
        return view('Templates/Header')
            .view('Visiteur/vue_RapportCompteCreer', $donnees)
            .view('Templates/Footer');
    } 

    public function afficheliaison($noliaison = null)
    {   
        if ($noliaison === null )  
        {
            $session = session();
            $modLiaison = new ModeleLiaison();
            $data['retour'] = $modLiaison->getLiaison();

            return view('Templates/Header') 
            . view('Visiteur/vue_AfficherLiaisonSecteur', $data)
            . view('Templates/Footer');  
        }
        else
        {
            $session = session();

            $modLiaison = new ModeleLiaison();
            $data['liaison'] = $modLiaison->getLiaisonPort($noliaison);
            

            $modTarif = new ModeleTarif();
            $data['tarif'] = $modTarif->findAll();

            $modType = new ModeleTarif();
            $data['type'] = $modType->getAllType();

            $modNOmbre = new ModeleTarif();
            $data['nombre'] = $modNOmbre->getNombreType($noliaison);

            $modCategorie = new ModeleTarif();
            $data['categorie'] = $modCategorie->getAllCategorie();

            $modPeriode = new ModelePeriode();
            $data['periode'] = $modPeriode->getAllPeriode($noliaison);

            return view('Templates/Header') 
            . view('Visiteur/vue_Tarif',$data)
            . view('Templates/Footer');   
        }
          
    }

    public function reservation($nosecteur = null)
    { 
        

        if ($nosecteur === null )  
        {
            $session = session();

            $modSecteur = new ModeleSecteur();
            $data['secteur'] = $modSecteur->findAll();

            return view('Templates/Header') 
            . view('Visiteur/vue_Reservation', $data)
            . view('Templates/Footer');  
        }
        else
        {   
            helper(['form']);
            $session = session();
            $data['nosecteur'] = $nosecteur;

            $modLiaison = new ModeleLiaison();
            $data['port'] = $modLiaison->getLiaisonPort($this->request->getPost('liaison'));
            
            $modSecteurLiaison = new ModeleSecteur();
            $data['secteurLiaison'] = $modSecteurLiaison->getSecteurLiaison($nosecteur); 

            $modSecteur = new ModeleSecteur();
            $data['secteur'] = $modSecteur->findAll(); 

            $modTraverse = new ModeleTraverse();
            $traversee = $modTraverse->getInfo($this->request->getPost('liaison'),$this->request->getPost('date'));
            
            
            $session->set('noliaison',$this->request->getPost('liaison'));
            $session->set('date',$this->request->getPost('date'));

            $modCategorie = new ModeleTarif();
            $categorie = $modCategorie->getAllCategorie();
            $data['categorie'] = $categorie;

            $tab = array();
            $caparest = array();
            foreach ($traversee as $uneTraversee)
            {
                $dispo = array();
                $caparestante = array();

                $dispo['NOTRAVERSEE'] = ''.$uneTraversee->NOTRAVERSEE.'';
                $dispo['HEURE'] = $uneTraversee->HEUREDEPART;
                $dispo['BATEAU'] = $uneTraversee->NOM;

                foreach ($categorie as $uneCategorie)
                {
                    $capa = $modTraverse->getCapaciteMax($uneCategorie->LETTRECATEGORIE, $uneTraversee->NOTRAVERSEE);
                    $quantitereserv = $modTraverse->getQuantite($uneCategorie->LETTRECATEGORIE, $uneTraversee->NOTRAVERSEE);
                    
                    foreach ($capa as $uneCapa)
                    {
                        $capacitemax = $uneCapa->capamax;
                    }

                    foreach ($quantitereserv as $unequantitereserv)
                    {
                        $quantiteEnr = $unequantitereserv->quantite;
                    }

                    
                    $dispo[$uneCategorie->LETTRECATEGORIE] =  (string)((int)$capacitemax - (int)$quantiteEnr); 
                    $caparestante[$uneCategorie->LETTRECATEGORIE] = (string)((int)$capacitemax - (int)$quantiteEnr); 
                }      

                $caparest[$uneTraversee->NOTRAVERSEE] = $caparestante;
                $tab[$uneTraversee->NOTRAVERSEE] = $dispo;            
            }
            $session->set('caparestante', $caparest);
            $data['resultat'] = $tab;
            $session->set('resultat', $data['resultat']);
            

            return view('Templates/Header') 
            . view('Visiteur/vue_ResaParSecteur', $data)
            . view('Templates/Footer');  
        }          
    }

}