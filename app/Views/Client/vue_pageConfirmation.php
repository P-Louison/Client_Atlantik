<center>

<h3> Compagnie Atlantik </h3>
<br>
<?php
    $session = session();
    echo 'Liaison '.$session->get('PortD-PortA').'';
    echo '<br>';
    echo 'Traversée n° '.$notraversee.' le '.$session->get('date').' à '.$heure.'';
    echo '<br>';
    echo 'réservation enregistrée sous le n° '.$session->get('noreservation').'<br>';
    echo ''.$session->get('nomClient').', '.$session->get('adresseClient').', '.$session->get('cpClient').', '.$session->get('villeClient').'';
    echo '<br><br>';

    foreach($tab as $unElement)
    {
        echo ''.$unElement['libelle'].' : '.$unElement['quantite'].'<br>';
    }

    echo '<br>';
    echo 'Montant total à régler : '.$session->get('montanttotal').'€';
    echo '<br>';
    echo 'Modalités de règlement : Carte Bancaire';
?>