



<h2><?php echo $TitreDeLaPage ?></h2>
<?php
if ($TitreDeLaPage == 'Saisie compte incorrecte')
echo service('validation')->listErrors();
echo form_open('creercompte');
?>
<?php echo csrf_field(); ?>
 
<label for="txtNom">Nom : </label>
<input type="input" name="txtNom" value="<?php echo set_value('txtNom'); ?>" /><br />

<label for="txtPrenom">Prenom : </label>
<input type="input" name="txtPrenom" value="<?php echo set_value('txtPrenom'); ?>" /><br />

<label for="txtAdresse">Adresse : </label>
<input type="input" name="txtAdresse" value="<?php echo set_value('txtAdresse'); ?>" /><br />

<label for="txtCodePostal">Code Postal : </label>
<input type="input" name="txtCodePostal" value="<?php echo set_value('txtCodePostal'); ?>" /><br />

<label for="txtVille">ville : </label>
<input type="input" name="txtVille" value="<?php echo set_value('txtVille'); ?>" /><br />

<label for="txtTelephoneFixe">Téléphone fixe : </label>
<input type="input" name="txtTelephoneFixe" value="<?php echo set_value('txtTelephoneFixe'); ?>" /><br />

<label for="txtTelephoneMobile">Téléphone mobile : </label>
<input type="input" name="txtTelephoneMobile" value="<?php echo set_value('txtTelephoneMobile'); ?>" /><br />

<label for="txtMel">Mel : </label>
<input type="input" name="txtMel" value="<?php echo set_value('txtMel'); ?>" /><br />

<label for="txtMotDePasse">Mot de passe : </label>
<input type="input" name="txtMotDePasse" value="<?php echo set_value('txtMotDePasse'); ?>" /><br />

<input type="submit" name="submit" value="Creer un compte" />
<?php echo form_close(); ?>

<p><a href="<?php echo site_url('accueil') ?>" class="btn btn-outline-primary">Retour à l'accueil</a><p>