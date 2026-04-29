<h4>Pseudo-Panier</h4>
<form action='' method='post'>
<table border=1>
    <tr>
        <th>       </th>
        <th>Tarif en €</th>
        <th>Quantité</th>
    </tr>
    <?php

    foreach($type as $unType)
    {
        echo '<tr>';
            echo '<td>';
                echo '<input type="hidden" name="categorie[2][libelle]" />';
                echo ''.$unType->LIBELLE.'';
            echo '</td>';
            echo '<td>';
                echo '<input type="text" name="categorie[2][Quantite]" value="" />';
            echo '</td>';
        echo '</tr>';
    }
    ?>

    
</table>
<BR>
<input type="submit" value="Valider panier">
</form>