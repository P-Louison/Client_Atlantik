
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
                        if ($traverse == null)
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
                            
                            foreach ($traverse as $uneTraverse)
                            {
                                echo '<tr>';
                                echo '<td>'.anchor('reservetraverse/'.$uneTraverse->NOTRAVERSEE,$uneTraverse->NOTRAVERSEE).'</td><td>'.$uneTraverse->HEUREDEPART.'</td><td>'.$uneTraverse->NOM.'</td>';
                            
                                foreach ($categorie as $uneCategorie)
                                {
                                    foreach ($capacitemax as $uneCapaMax)
                                    {
                                        if ($uneCapaMax->LETTRECATEGORIE == $uneCategorie->LETTRECATEGORIE && $uneCapaMax->NOBATEAU == $uneTraverse->NOBATEAU) 
                                        {
                                            $capa = (int)$uneCapaMax->CAPACITEMAX;
                                            break;
                                        }
                                    }
                                    $quantite = 0;
                                    foreach ($quantiteenregistrer as $uneQuantEnr)
                                    {
                                        if ($uneQuantEnr->LETTRECATEGORIE == $uneCategorie->LETTRECATEGORIE && $uneQuantEnr->NOTRAVERSEE == $uneTraverse->NOTRAVERSEE) 
                                        {
                                            $quantite += (int)$uneQuantEnr->QUANTITERESERVEE ;
                                        }
                                    }
                                    $placerestante = $capa - $quantite;

                                    echo '<td>'.$placerestante.'</td>';
                                }
                                echo '</tr>';
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