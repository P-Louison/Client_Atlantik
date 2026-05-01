<center>

<h3> Compagnie Atlantik </h3>
<br>
<?php
    $session = session();
    echo 'Liaison '.$session->get('PortD-PortA').'';
    echo '<br>';
    echo 'Traversée n° '.$session->get('notraversee').' le '.$session->get('date').' à '.$session->get('heuredepart').'';
?>