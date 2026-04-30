<h4>Réservation</h4>

<?php
$session = session();
if ($session->get('profil') == "client")
{
    echo 'Nom : '.$session->get('nomClient').'<br>';
    echo 'Adresse : '.$session->get('adresseClient').'<br>';
    echo 'Cp : '.$session->get('cpClient').' Ville : '.$session->get('villeClient').'';
}
?>

<form action='' method='post'>
<table class="table table-striped">
    <tr>
        <th>       </th>
        <th>Tarif en €</th>
        <th>Quantité</th>
    </tr>
    <?php
    

    
    foreach($tarif as $unTarif)
    {
        echo '<tr>';
            echo '<td>';
                echo '<input type="hidden" name="categorie[2][libelle]" />';
                echo ''.$unTarif->LIBELLE.'';
            echo '</td>';
            echo '<td>';
                echo '<input type="hidden" name="categorie[2][tarif]" value="" />';
                echo ''.$unTarif->TARIF.'';
            echo '</td>';
            echo '<td>';
                echo '<input type="text" name="categorie[2][Quantite]" value="" />';
            echo '</td>';
        echo '</tr>';
    }
    ?> 
</table>
<BR>

<?php
    if ($session->get('profil') != "Client")
    {
        ?>
        <input type="submit" value="Valider panier" class="disabled btn btn-primary">
        <?php
    }
    else
    {
        ?>
        <input type="submit" value="Valider panier" class="btn btn-outline-primary">
        <?php
    }

?>

</form>