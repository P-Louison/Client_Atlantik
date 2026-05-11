<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleReservation extends Model
{
    protected $table = 'reservation'; // alias com sur la table commande
    protected $primaryKey = 'noreservation';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected $allowedFields = ['notraversee','noclient','dateheure', 'montanttotal', 'paye', 'modereglement'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT

    public function getInfo($noclient)
    {
        $condition = ['reservation.noclient = ' => $noclient];

        return $this->join('traversee t', 'reservation.NOTRAVERSEE = t.NOTRAVERSEE',  'inner')
        ->join('liaison l', 't.NOLIAISON = l.NOLIAISON',  'inner')
        ->join('port pd', 'pd.NOPORT = l.NOPORT_DEPART',  'inner')
        ->join('port pa', 'pa.NOPORT = l.NOPORT_ARRIVEE',  'inner')
        ->select('reservation.NORESERVATION, DATE_FORMAT(reservation.DATEHEURE, "%d/%m/%Y") as DATERESERVATION, pd.NOM as PORTDEPART, pa.NOM as PORTARRIVE, DATE_FORMAT(t.DATEHEUREDEPART, "%d/%m/%Y") as HEUREDEPART, MONTANTTOTAL, PAYE')
        ->where($condition)
        ->paginate(3);
    }  

}