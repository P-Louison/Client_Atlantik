
<table class="table table-striped">
    <tr colspan = 3>
        <th rowspan=2 colspan=3>Catégorie</th>
        <th rowspan=2 colspan=3>Type</th>
        <th rowspan=1 colspan=4>
            Période
        </th>
    </tr>
    <tr>
        <?php
            foreach ($periode as $uneLigne) :
                echo '<th rowspan=1>'.$uneLigne->datedebut.'<br>'.$uneLigne->datefin.'</th>';
            endforeach 
        ?>
    </tr>
            

    
    <?php
        $libelle_courant = "";
        $numperiode = 0;
        $numtype = 1;
        foreach ($retour as $uneLigne)
        {       
            // Tant qu'on est sur le même nom de region, on met la première cellule (colonne) à vide
            if ($uneLigne->LETTRECATEGORIE==$libelle_courant )
            {  
                
                echo '<tr rowspan=3>' ;                                
                    foreach ($retour as $tab) 
                    {                         
                        if ($tab->LETTRECATEGORIE==$libelle_courant)
                        {
                             echo '<td colspan=3>'
                                .$uneLigne->LETTRECATEGORIE."</br>".$uneLigne->cateLibelle.
                            '</td></tr>';
                            

                            foreach($retour as $col)
                            {
                                if ($col->LETTRECATEGORIE==$libelle_courant and $col->NOTYPE==$numtype)
                                {
                                    echo '<tr><td>'
                                        .$col->LETTRECATEGORIE."".$col->NOTYPE." - ".$col->typeLibelle.
                                    '</td>';

                                    foreach($retour as $prix)
                                    {
                                        if ($prix->LETTRECATEGORIE==$libelle_courant and $prix->NOTYPE==$numtype and $prix->NOPERIODE==$numperiode)
                                        {   
                                            echo '<td>' .$prix->tarif. '</td>';
                                        }
                                        $numperiode++;
                                    } 
                                    echo '</tr>';
                                }
                                $numtype++; 
                            }     
                                                             
                        }
                        
                    }   
                    
                echo '</tr> ';   

            }
            $libelle_courant = $uneLigne->LETTRECATEGORIE;
            $numperiode =  $uneLigne->NOPERIODE;
        }
    ?>
</table>