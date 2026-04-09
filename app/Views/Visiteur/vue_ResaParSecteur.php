
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
            <div class='col-md-3'>        
                <select name="liaison" required>
                    <?php
                    
                        foreach ($secteurLiaison as $uneLigne) :
                            echo ' <option value="'.$uneLigne->numLiaison.'"> '.$uneLigne->portDepart. ' - ' .$uneLigne->portArrive.'</option>';   
                        endforeach 
                    ?>                             
                </select>
            </div>
            <div class='col-md-3'>
                <form>
                    <input type="date" id="date" name="date">
                </form>
            </div>
            <div class='col-md-3'>
                <input type="submit" class="btn btn-outline-primary" value="Afficher" name="btnAfficher">
            </div>
        </div> 
        <div class='row'>
            <?php

                if(isset($_POST['btnAfficher'])) 
                {
                    echo 'AAAAA';
                }
                else 
                {
                    echo 'BBBBB';
                }    
            ?>
        </div>
    </div>
</div>