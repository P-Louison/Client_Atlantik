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
    foreach($tarif as $unTarif)
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
        /* lien vers l'UC 8 a faire (lien sous forme btn)*/
        ?>
        <a href="<?php echo site_url('pageconfirmation') ?>"><input type="button" name="btnValider" value="Valider panier" class="btn btn-primary"></a>
        <?php
    }
?>
</form>
<?php

    if (isset($_POST['btnValider']))
    {
        $tab = array();
        $montanttotal = 0;
        if (isset($_POST['type']))
        {
            $compte = 0;
            foreach ($_POST['type'] as $unType)
            {
                if ($unType['quantite'] != "")
                {
                    $tabType = array();
                    $montanttotal += ((float)($unType['tarif'])) * ((float)($unType['quantite']));
                    $tabType['libelle'] = $unType['libelle'];
                    $tabType['notype'] = $unType['notype'];
                    $tabType['quantite'] = $unType['quantite'];
                    $tab[$compte] = $tabType;
                    $compte++;          
                }        
            }
            
            $session->set('montanttotal', $montanttotal);
            $session->set('type', $tab);
        }
    }
?>

