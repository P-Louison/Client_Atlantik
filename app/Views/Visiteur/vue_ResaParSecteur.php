
<div class='row'>
    <div class='col-md-2'>
        <table class="table table-striped">
        <?php
            

            foreach ($secteur as $uneLigne) :
                  echo '<tr><td>'.anchor('reservation/'.$uneLigne->NOSECTEUR,$uneLigne->NOM).'</td></tr>';
            endforeach 
        ?>
        </table>
    </div>
    <div class='col-md-10'>
        <h3> Sélectionner la liaison, et la date souhaitée : </h3>
        <br>
        <div class='row'>
            <form action="" method="post">
                <div class='col-md-3'>        
                    <select name="liaison">
                        <?php
                        
                            foreach ($secteurLiaison as $uneLigne) :
                                echo ' <option value="'.$uneLigne->numLiaison.'"> '.$uneLigne->portDepart. ' - ' .$uneLigne->portArrive.'</option>';   
                            endforeach 
                        ?>                             
                    </select>
                </div>
                <div class='col-md-3'>  
                    <input type="date" id="date" name="date">       
                </div>
                <div class='col-md-3'>
                    <input type="submit" class="btn btn-outline-primary" value="Afficher" name="btnAfficher">
                </div>
            </form>
        </div> 

        <br>

        



        <div class='row'>
            <?php
                if(!isset($_POST['btnAfficher'])) 
                {
                    echo 'veuillez selectionner une liaison ainsi que la liaison';
                }
                else 
                {
                    $dateactuel = date('Y/m/d');
                    $date1 = new DateTime($dateactuel);
                    $date2 = new DateTime($_POST['date']);
                    if ((($_POST['date']) == "") || ($date2 < $date1))
                    {
                        echo 'merci de bien selectionner les informations !';
                        echo '<br>';
                        echo 'Les dates inférieurs à la date du jour ne sont pas prise en compte !';
                    }
                    else
                    { 
                        if ($resultat == null)
                        {
                            echo 'PAS DE TRAVERSEE POUR LA DATE CHOISIE';
                        }
                        else
                        {
                            foreach ($port as $uneLigne) :
                            echo ''.$uneLigne->portDepart.' - '.$uneLigne->portArrive.'';
                            endforeach  ?> 

                            <p> Traversées pour le <?php echo ''.$_POST['date'].''; ?> Sélectionner la traversée souhaitée </p>
                            <table class="table table-striped">
                            <?php
                    
                            echo '<tr colspan = 2>';
                                echo '<th>N°</th> <th>Heure</th> <th>Bateau</th>';
                            
                                foreach($categorie as $uneCategorie)
                                    {
                                        echo '<th>';
                                        echo ''.$uneCategorie->LETTRECATEGORIE."</br>".$uneCategorie->LIBELLE.'';
                                        echo '</th>';
                                    }
                            echo '</tr>';
                            
                            foreach($resultat as $LeResultat)
                            {

                                foreach($LeResultat as $unResultat)
                                {
                                    
                                    echo '<tr>';
                                    echo '<td>'.anchor('reservetraverse/'.$unResultat->NOTRAVERSEE,$unResultat->NOTRAVERSEE).'</td><td>'.$unResultat->HEURE.'</td><td>'.$unResultat->BATEAU.'</td><td>'.$unResultat->PLACEA.'</td><td>'.$unResultat->PLACEB.'</td><td>'.$unResultat->PLACEC.'</td>';
                                    echo '</tr>'; 
                                }         
                            }
                                
                        }
                        ?>
                        </table>
                        <?php  
                    }     
                }    
            ?>
        </div>
    </div>
</div>