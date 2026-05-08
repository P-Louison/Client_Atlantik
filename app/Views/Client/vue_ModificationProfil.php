<?php
    $session = session();
?>

<?php
if ($TitreDeLaPage == 'Saisie compte incorrecte')
echo service('validation')->listErrors();
echo form_open('modificationcompte/'.$session->get('noclient').'');
?>
<?php echo csrf_field(); ?>
 
<label for="txtNom">Nom : </label>
<input type="input" name="txtNom" value="<?php echo ''.$session->get('nomClient').''; ?>" /><br />

<label for="txtPrenom">Prenom : </label>
<input type="input" name="txtPrenom" value="<?php echo ''.$session->get('prenomClient').''; ?>" /><br />

<label for="txtAdresse">Adresse : </label>
<input type="input" name="txtAdresse" value="<?php echo ''.$session->get('adresseClient').''; ?>" /><br />

<label for="txtCodePostal">Code Postal : </label>
<input type="input" name="txtCodePostal" value="<?php echo ''.$session->get('cpClient').''; ?>" /><br />

<label for="txtVille">ville : </label>
<input type="input" name="txtVille" value="<?php echo ''.$session->get('villeClient').''; ?>" /><br />

<label for="txtTelephoneFixe">Téléphone fixe : </label>
<input type="input" name="txtTelephoneFixe" value="<?php echo ''.$session->get('telFixeClient').''; ?>" /><br />

<label for="txtTelephoneMobile">Téléphone mobile : </label>
<input type="input" name="txtTelephoneMobile" value="<?php echo ''.$session->get('telPortClient').''; ?>" /><br />

<label for="txtMel">Mel : </label>
<input type="input" name="txtMel" value="<?php echo ''.$session->get('melClient').'';; ?>" /><br />

<label for="txtMotDePasse">Mot de passe : </label>
<input type="input" name="txtMotDePasse" value="<?php echo ''.$session->get('mdpClient').'';; ?>" /><br />

<input type="submit" name="submit" value="Modifier le compte" />
<?php echo form_close(); ?>

<p><a href="<?php echo site_url('accueil') ?>" class="btn btn-outline-primary">Retour à l'accueil</a><p>