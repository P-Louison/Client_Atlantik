<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModelePeriode extends Model
{
    protected $table = 'periode'; // alias com sur la table commande
    protected$primaryKey = 'noperiode';
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected$allowedFields = ['noperiode', 'datedebut', 'datefin'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT

    public function getAllPeriode($noliaison)
    {
        $date = date("d-m-Y");
        $condition = ['datefin >=' => $date, 'tarifer.noliaison =' => $noliaison];

        return $this->join('tarifer', 'periode.noperiode = tarifer.noperiode', 'inner')
      
        ->select('distinct(periode.noperiode), datedebut, datefin')
        ->where($condition)
        ->get()->getResult();
        // ->get() : pour générer le tableau automatiquement,
        // si non : ->get()->getResult();  (voir vue associée)
    }   

    
}