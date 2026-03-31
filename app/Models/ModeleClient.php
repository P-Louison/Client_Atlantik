<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleClient extends Model
{
    protected $table = 'client'; // nom de la table mappée
    /* ci-dessus on indique la table a 'mapper' */
    protected $primaryKey = 'noclient'; // clé primaire
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
 
    protected $allowedFields = ['nom', 'prenom', 'ville', 'adresse', 'codepostal', 'telephonemobile', 'mel'];
    /* champs pour lesquels insertion, et mises à jour sont autorisées
    Nota Bene : on n'autorise pas les champs en AUTOINCREMENT */
 
    // voir contrôleur Client pour utilisation des méthodes héritées de Model

}