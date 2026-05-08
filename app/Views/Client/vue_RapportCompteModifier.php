<br><br><br>
<?php
if ($comptemodif) {
    echo 'Modification du compte effectué.';
} else {
    echo 'Echec de modification';
}
?>
<br><br><br>
<p><a href="<?php echo site_url('accueil') ?>" class="btn btn-outline-primary">Retour à l'accueil</a></p>