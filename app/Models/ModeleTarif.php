<?php
namespace App\Models;
use CodeIgniter\Model;
 
class ModeleTarif extends Model
{
  protected $table = 'liaison'; // alias com sur la table commande
  protected$primaryKey = 'noliaison';
  protected $useAutoIncrement = true;
  protected $returnType = 'object'; // résultats retournés sous forme d'objet(s)
 
  protected$allowedFields = ['noliaison', 'noport_depart ', 'noport_arrivee' , 'distance'];
  // numero : clé primaire, non mentionné ci-dessus, car AUTOINCREMENT
 
  public function getAllTarif()
  {
    /* REQUETE SQL
    select numero, numeroclient, datecommande, referenceproduit, quantitecommandee, libelle, prixht
    FROM commande
      JOIN contenir
        ON commande.numero = contenir.numerocommande
      JOIN produit
        ON contenir.referenceproduit = produit.reference
    */
     // ci-après jointure de la table 'contenir' sur $this = table 'commande' !
     // puis jointure de produit sur le résultat précédent
     // enfin on 'select' les champs a retourner
      return $this->join('secteur', 'liaison.NOSECTEUR = secteur.NOSECTEUR', 'inner')
      ->join('port hugo', 'liaison.NOPORT_DEPART = hugo.NOPORT',  'inner')
      ->join('port pa', 'liaison.NOPORT_ARRIVEE = pa.NOPORT',  'inner')
      ->select('secteur.NOM as SecteurNom, liaison.NOLIAISON as numLiaison, distance, hugo.NOM as portDepart, pa.NOM as portArrive')
      ->get()->getResult();
      // ->get() : pour générer le tableau automatiquement,
      // si non : ->get()->getResult();  (voir vue associée)
  }
}


select tarif, liaison.NOLIAISON,p.DATEDEBUT,p.DATEFIN,categorie.LIBELLE as cateLibelle,type.NOTYPE, type.LIBELLE as typeLibelle, type.LETTRECATEGORIE from tarifer
INNER JOIN liaison on liaison.NOLIAISON = tarifer.NOLIAISON
INNER JOIN type on tarifer.LETTRECATEGORIE = type.LETTRECATEGORIE and tarifer.NOTYPE = type.NOTYPE
INNER JOIN periode p on tarifer.NOPERIODE = p.NOPERIODE
INNER JOIN categorie on tarifer.LETTRECATEGORIE = categorie.LETTRECATEGORIE