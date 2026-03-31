<br><br><br>
<?php
if ($compteajoutee) { // true (1) si ajout, false (0) sinon
    echo 'Ajout du compte effectué.';
} else {
    echo 'Echec enregistrement';
}
?>
<br><br><br>
<p><a href="<?php echo site_url('accueil') ?>">Retour à l'accueil</a></p>
 