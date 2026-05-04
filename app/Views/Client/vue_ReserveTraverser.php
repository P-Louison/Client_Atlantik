<center>
<h4>Réservation d'une traversée : </h4>
<?php
$session = session();
if ($session->get('profil') == "client")
{
    echo 'Nom : '.$session->get('nomClient').'<br>';
    echo 'Adresse : '.$session->get('adresseClient').'<br>';
    echo 'Cp : '.$session->get('cpClient').' Ville : '.$session->get('villeClient').'';
}
else
{ ?>
    <h5> Il faut être connecté à un profil pour réserver ! </h5>
    <p> Merci de bien vouloir vous connectez ou de créez un compte pour procéder à la réservation ! </p>

 <?php }
?>
</center>
<form action='' method='post'>
<table class="table table-striped">
    <tr>
        <th>       </th>
        <th>Tarif en €</th>
        <th>Quantité</th>
    </tr>

    <?php   
    $compteur = 0;
    $tab = $session->get('caparestante')[$notraversee];
    foreach($tab as $cle => $uneCapa)
    {
        foreach($tarif as $unTarif)
        {
            
            if (((int)($uneCapa)) > 0 && ($cle == $unTarif->LETTRECATEGORIE))
            {
               
                echo '<tr>';
                    echo '<td>';
                        echo '<input type="hidden" name="type['.$compteur.'][libelle]" value="'.$unTarif->LIBELLE.'"/>';
                        echo '<input type="hidden" name="type['.$compteur.'][notype]" value="'.$unTarif->NOTYPE.'"/>';
                        echo '<input type="hidden" name="type['.$compteur.'][lettrecategorie]" value="'.$unTarif->LETTRECATEGORIE.'"/>';
                        echo ''.$unTarif->LIBELLE.'';
                    echo '</td>';
                    echo '<td>';
                        echo '<input type="hidden" name="type['.$compteur.'][tarif]" value="'.$unTarif->TARIF.'" />';
                        echo ''.$unTarif->TARIF.'';
                    echo '</td>';
                    echo '<td>';
                        echo '<input type="text" name="type['.$compteur.'][quantite]" value="" />';
                    echo '</td>';
                echo '</tr>';
                $compteur++;
            }
        }
    }
    
    
    ?> 
</table>
<BR>

<?php
    if ($session->get('profil') != "client")
    {
        
        ?>
        <input type="submit" value="Valider panier" class="disabled btn btn-primary">
        <?php
    }
    else
    {
        if ($tab == array())
        {
            echo 'vieillez a remplir un ou plusieurs cases afin de poursuivre la réservation !';
            echo '<br>';
        }  
        ?>
        <input type="submit" name="btnValider" value="Valider Panier" class="btn btn-primary">
        <?php
    }
?>
</form>
<?php

  

