
<table class="table table-striped">
    <tr>
      <th>Secteur</th>
      <th>N°liaison</th>
      <th>Distance</th>
      <th>Port départ</th>
      <th>Port Arrivé</th>
    </tr>
    <?php
        $region_courante = "";
        foreach ($retour as $uneLigne) :
            // Tant qu'on est sur le même nom de region, on met la première cellule (colonne) à vide
            if ($uneLigne->SecteurNom==$region_courante )
            {
                
            echo '<TR><TD></TD><TD>' .anchor('tarif/'.$uneLigne->numLiaison,$uneLigne->numLiaison). '</TD><TD>' . $uneLigne->distance . '</TD><TD>' . $uneLigne->portDepart . '</TD><TD>' . $uneLigne->portArrive . '</TD></TR>';
            }
            else
            {// On change de nom region, on met ce nom dans la première cellule (colonne)
            echo '<TR><TD>' . $uneLigne->SecteurNom . '</TD><TD>' .anchor('tarif/'.$uneLigne->numLiaison,$uneLigne->numLiaison). '</TD><TD>' . $uneLigne->distance . '</TD><TD>' . $uneLigne->portDepart . '</TD><TD>' . $uneLigne->portArrive . '</TD></TR>';

            }
            $region_courante = $uneLigne->SecteurNom;
        endforeach ?>
</table>

