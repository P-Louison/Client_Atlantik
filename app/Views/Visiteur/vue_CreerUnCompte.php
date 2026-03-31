
<?php

 
  /* set_value : en cas de non validation, les données déjà saisies sont réinjectées dans le formulaire */
  echo form_open('creercompte');
  echo csrf_field();
 
  echo form_label('Nom','txtNom');
  echo form_input('txtNom1', set_value('txtNom'));
  echo '<br><br>';
  
  echo form_label('Prenom','txtPrenom');
  echo form_input('txtPrenom', set_value('txtPrenom'));  
  echo '<br><br>';

  echo form_label('Adresse','txtAdresse');
  echo form_input('txtAdresse', set_value('txtAdresse'));  
  echo '<br><br>';

  echo form_label('Code Postal','txtCodePostal');
  echo form_input('txtCodePostal', set_value('txtCodePostal')); 
  echo '<br><br>' ;

  echo form_label('Ville','txtVille');
  echo form_input('txtVille', set_value('txtVille')); 
  echo '<br><br>' ;

  echo form_label('TelephoneFixe','txtTelephoneFixe');
  echo form_input('txtTelephoneFixe', set_value('txtTelephoneFixe')); 
  echo '<br><br>';
  
  echo form_label('TelephoneMobile','txtTelephoneMobile');
  echo form_input('txtTelephoneMobile', set_value('txtTelephoneMobile'));
  echo '<br><br>';

  echo form_label('Mel','txtMel');
  echo form_input('txtMel', set_value('txtMel'));
  echo '<br><br>';
 
  echo form_label('Mot de passe','txtMotDePasse');
  echo form_password('txtMotDePasse', set_value('txtMotDePasse'));    
  echo '<br><br>';
 
  echo form_submit('submit', 'creer');
  echo form_close();
  echo '<br><br>';
?>

<p><a href="<?php echo site_url('accueil') ?>">Retour à l'accueil</a><p>