<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleTraverse extends Model
{
    protected $table = 'traversee'; // alias com sur la table commande
    protected $primaryKey = 'notraversee';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected$allowedFields = ['notraversee', 'noliaison ', 'nobateau' , 'dateheuredepart', 'dateheurearrive'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT

    public function getInfo($numliaison, $date)
    {
        $condition = ['DATEHEUREDEPART LIKE' => $date . '%', 'traversee.noliaison =' => $numliaison];

        return $this->join('bateau', 'traversee.NOBATEAU = bateau.NOBATEAU', 'inner')
      
        ->select('NOTRAVERSEE,traversee.NOBATEAU, NOLIAISON,bateau.NOM as NOM,DATE_FORMAT(DATEHEUREDEPART, "%d/%m/%Y") as DATEDEPART,DATE_FORMAT(DATEHEUREARRIVEE, "%d/%m/%Y") as DATEARRIVEE,DATE_FORMAT(DATEHEUREDEPART, "%H:%i") as HEUREDEPART, DATE_FORMAT(DATEHEUREARRIVEE, "%H:%i") as HEUREARRIVEE')
        ->where($condition)
        ->get()->getResult();
        // ->get() : pour générer le tableau automatiquement,
        // si non : ->get()->getResult();  (voir vue associée)
    }   

    public function getCapaciteMax($lettre, $numtraversee)
    {
        $condition = ['c.LETTRECATEGORIE = ' => $lettre , 'traversee.NOTRAVERSEE =' => $numtraversee];

        return $this->join('contenir c', 'c.NOBATEAU = traversee.NOBATEAU',  'inner')
        ->join('categorie ca', 'c.LETTRECATEGORIE = ca.LETTRECATEGORIE',  'inner')
        ->select('DISTINCT(c.NOBATEAU), traversee.NOTRAVERSEE, c.CAPACITEMAX as capamax, c.LETTRECATEGORIE')
        ->where($condition)
        ->get()->getResult();
        // ->get() : pour générer le tableau automatiquement,
        // si non : ->get()->getResult();  (voir vue associée)
    }  

    public function getQuantite($lettre, $numtraversee)
    {
        $condition = ['e.LETTRECATEGORIE = ' => $lettre , 'traversee.NOTRAVERSEE =' => $numtraversee];

        return $this->join('reservation r', 'r.NOTRAVERSEE = traversee.NOTRAVERSEE ',  'inner')
        ->join('enregistrer e', 'r.NORESERVATION = e.NORESERVATION ',  'inner')
        ->select('traversee.NOTRAVERSEE, SUM(e.QUANTITERESERVEE) as quantite,e.LETTRECATEGORIE')
        ->where($condition)
        ->get()->getResult();
        // ->get() : pour générer le tableau automatiquement,
        // si non : ->get()->getResult();  (voir vue associée)
    }  
    
}