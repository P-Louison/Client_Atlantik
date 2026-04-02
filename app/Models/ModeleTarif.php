<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleTarif extends Model
{
    protected $table = 'tarifer'; // alias com sur la table commande
    protected$primaryKey = 'noperiode,lettrecategorie,notype,noliaison';
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected$allowedFields = ['noperiode', 'lettrecategorie ', 'notype' , 'noliaison', 'tarif'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT

    public function getAllTarif($noliaison)
    {
        $date = date("d-m-Y");
        $condition = ['p.datefin >=' => $date, 'tarifer.noliaison =' => $noliaison];

        return $this->join('liaison', 'liaison.NOLIAISON = tarifer.NOLIAISON', 'inner')
        ->join('type', 'tarifer.LETTRECATEGORIE = type.LETTRECATEGORIE and tarifer.NOTYPE = type.NOTYPE',  'inner')
        ->join('periode p', 'tarifer.NOPERIODE = p.NOPERIODE',  'inner')
        ->join('categorie', 'tarifer.LETTRECATEGORIE = categorie.LETTRECATEGORIE',  'inner')
        ->select('DISTINCT(p.NOPERIODE),tarif, liaison.NOLIAISON, categorie.LIBELLE as cateLibelle,type.NOTYPE, type.LIBELLE as typeLibelle, type.LETTRECATEGORIE')
        ->where($condition)
        ->orderby('periode.NOPERIODE', 'ASC')
        ->get()->getResult();
        // ->get() : pour générer le tableau automatiquement,
        // si non : ->get()->getResult();  (voir vue associée)
    }
}
