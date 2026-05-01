<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleTarif extends Model
{
    protected $table = 'tarifer'; // alias com sur la table commande
    protected $primaryKey = 'noperiode,lettrecategorie,notype,noliaison';
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected$allowedFields = ['noperiode', 'lettrecategorie ', 'notype' , 'noliaison', 'tarif'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT

    public function getNombreType($noliaison)
    {
        $condition = ['NOPERIODE' => 1, 'tarifer.noliaison =' => $noliaison];

        return $this->select('DISTINCT(LETTRECATEGORIE),count(LETTRECATEGORIE) as NOMBRE')
        ->where($condition)
        ->groupby('LETTRECATEGORIE')
        ->orderby('LETTRECATEGORIE','asc')
        ->get()->getResult();
    }


    public function getAllType()
    {
        return $this->join('type', 'tarifer.LETTRECATEGORIE = type.LETTRECATEGORIE and tarifer.NOTYPE = type.NOTYPE', 'inner')
        ->select('DISTINCT(type.LETTRECATEGORIE), type.LIBELLE, type.NOTYPE')
        ->get()->getResult();
    }

    public function getAllCategorie()
    {
        return $this->join('categorie', 'categorie on tarifer.LETTRECATEGORIE = categorie.LETTRECATEGORIE', 'inner')
        ->select('DISTINCT(categorie.LETTRECATEGORIE), categorie.LIBELLE')
        ->orderby('categorie.LETTRECATEGORIE','asc')
        ->get()->getResult();
    }

    public function getTypeTarif($date,$noliaison)
    {
        $condition = $condition = ['tarifer.NOPERIODE' => $date, 'tarifer.noliaison =' => $noliaison];

        return $this->join('type t', 'tarifer.LETTRECATEGORIE = t.LETTRECATEGORIE and tarifer.NOTYPE = t.NOTYPE', 'inner')
        ->join('periode p','tarifer.NOPERIODE = p.NOPERIODE','inner')
        ->select('t.LIBELLE, tarifer.TARIF, tarifer.LETTRECATEGORIE, t.NOTYPE')
        ->where($condition)
        ->get()->getResult();
    }

    public function getNoPeriode($date)
    {
        $condition = ['p.DATEDEBUT <=' => $date, 'p.DATEFIN >=' => $date];

        return $this->join('periode p', 'tarifer.NOPERIODE = p.NOPERIODE', 'inner')
        ->select('DISTINCT(p.NOPERIODE) as PERIODE')
        ->where($condition)
        ->get()->getResult();
    }
}
