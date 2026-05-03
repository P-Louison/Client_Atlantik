<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleEnregistrer extends Model
{
    protected $table = 'enregistrer'; // alias com sur la table commande
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected $allowedFields = ['NORESERVATION', 'LETTRECATEGORIE','NOTYPE','QUANTITERESERVEE', 'QUANTITEEMBARQUEE'];
}