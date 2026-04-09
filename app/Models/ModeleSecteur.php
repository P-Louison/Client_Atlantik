<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleSecteur extends Model
{
    protected $table = 'secteur'; // alias com sur la table commande
    protected $primaryKey = 'nosectceur';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected$allowedFields = ['nosecteur', 'nom'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT

    public function getSecteurLiaison($nosecteur)
    {
    $condition = ['secteur.nosecteur =' => $nosecteur]; 

    return $this->join('liaison', 'liaison.NOSECTEUR = secteur.NOSECTEUR',  'inner')
    ->join('port pa', 'liaison.NOPORT_ARRIVEE = pa.NOPORT',  'inner')
    ->join('port hugo', 'liaison.NOPORT_DEPART = hugo.NOPORT',  'inner')
    ->select('liaison.noliaison as numLiaison, hugo.NOM as portDepart, pa.NOM as portArrive')
    ->where($condition)
    ->get()->getResult();
      
    }
   
}