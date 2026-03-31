<?php
namespace App\Controllers;
use App\Models\ModeleProduit;
use App\Models\ModeleAdministrateur;
use App\Models\ModeleClient; 

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
            echo view('Visiteur/vue_ConnexionReussie');
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
                
                $data['Identifiant'] = $Identifiant;
                echo view('Templates/Header', $data);
                echo view('Visiteur/vue_ConnexionReussie');
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
        return redirect()->to('seconnecter');
    } // Fin seDeconnecter

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
            'txtTelephoneFixe' => 'permit_empty|regex_match[^0[67]\.\d{2}(\.\d{2}){3}$]',
            'txtTelephoneMobile' => 'permit_empty|regex_match[^0[67]\.\d{2}(\.\d{2}){3}$]',
            'txtMel' => 'required|max_length[254]|valid_email',
            'txtMotDePasse' => 'required|string|max_length[30]',            
        ];
        
        if (!$this->validate($reglesValidation)) 
        {
            /* formulaire non validé, on renvoie le formulaire */
            return view('Templates/Header')
            . view('Visiteur/vue_CreerUnCompte', $data)
            . view('Templates/Footer');
        }

        /* SI FORMULAIRE NON VALIDE, LE CODE QUI SUIT N'EST PAS EXECUTE */
        /* INSERTION PRODUIT SAISI DANS BDD */
        
        $donneesAInserer = array(
            'nomclient' => $this->request->getPost('txtNom'),
            'prenomclient' => $this->request->getPost('txtPrenom'),
            'adresseclient' => $this->request->getPost('txtAdresse'),
            'codepostalclient' => $this->request->getPost('txtCodePostal'),
            'villeclient' => $this->request->getPost('txtVille'),
            'telfixeclient' => $this->request->getPost('txtTelephoneFixe'),
            'telmobileclient' => $this->request->getPost('txtTelephoneMobile'),
            'melclient' => $this->request->getPost('txtMel'),
            'mdpclient' => $this->request->getPost('txtMotDePasse'),
            
        ); // reference, libelle, prixht, quantiteenstock, image : champs de la table 'produit'
        
        $modelCompte = new ModeleCreerCompte(); //instanciation du modèle
        $donnees['compteajoutee'] = $modelCompte->insert($donneesAInserer, false);
        // provoque insert into sur la table mappée (produit, ici), retourne 1 (true) si ajout OK
 
        return view('Templates/Header')
            .view('Visiteur/vue_RapportCompteCreer', $donnees)
            .view('Templates/Footer');
    } 

}