<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleReservation extends Model
{
    protected $table = 'reservation'; // alias com sur la table commande
    protected $primaryKey = 'noreservation';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected$allowedFields = ['noreseravtion', 'notraversee ','noclient','dateheure', 'montanttotal', 'paye', 'modereglement'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT
}