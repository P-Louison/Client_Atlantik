<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleCategorie extends Model
{
    protected $table = 'categorie'; // alias com sur la table commande
    protected $primaryKey = 'lettrecategorie';
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)

    protected$allowedFields = ['lettrecategorie', 'libelle'];
    // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT
}