<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleEnregistrer extends Model
{
    protected $table = 'reservation'; // alias com sur la table commande
    protected $primaryKey = 'noreservation, lettrecategorie,notype';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected$allowedFields = ['noreseravtion', 'lettrecategorie ','notype','quantiteenregistrer', 'quantiteembarquee'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT
}