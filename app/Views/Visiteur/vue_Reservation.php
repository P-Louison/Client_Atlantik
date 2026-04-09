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
        <br><br><br>
        <h1> Merci de sélectionner un secteur avant tout ! <h1>
    </div>
</div>