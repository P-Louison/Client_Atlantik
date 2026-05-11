<table class="table table-striped">


<?php 

    echo '<tr>';
        echo '<th>n° de réservation</th>';
        echo '<th>Date réservation</th>';
        echo '<th>Départ</th>';
        echo '<th>Arrivée</th>';
        echo '<th>Date départ</th>';
        echo '<th>Total</th>';
        echo '<th>Payé</th>';
    echo '</tr>';

    foreach ($resainfo as $uneResa) 
    {
        echo '<tr>';
            echo '<td>'.$uneResa->NORESERVATION.'</td><td>'.$uneResa->DATERESERVATION.'</td><td>'.$uneResa->PORTDEPART.'</td><td>'.$uneResa->PORTARRIVE.'</td><td>'.$uneResa->HEUREDEPART.'</td><td>'.$uneResa->MONTANTTOTAL.'</td>';
        
            if($uneResa->NORESERVATION == 1)
            {
                echo '<td> Oui </td>';
            }
            else
            {
                echo '<td> Non </td>';
            }
        
        
        echo '</tr>';
    }
?>

</table>


<?= $pager->links('default', 'pagination') ?>
