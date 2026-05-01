<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Atlantik</title>
</head>
<body>
  <div class="p-2 bg-primary text-white text-center">
    <h1>Atlantik</h1>
  </div>
  <?php
        $session = session();
        if(!is_null($session->get('identifiant'))) : ?>
        <?php echo 'Utilisateur connecté : ' . $session->get('identifiant').'&nbsp;&nbsp;'; ?>
        <a href="<?php echo site_url('sedeconnecter') ?>" class="btn btn-outline-danger">Se déconnecter</a>&nbsp;&nbsp;
        <?php if ($session->get('profil') == 'administrateur') : ?>
            <a href="<?php echo site_url('ajouterproduit') ?>" class="btn btn-outline-warning">admin</a>&nbsp;&nbsp;
            <a href="<?php echo site_url('voircommandesproduits') ?>" class="btn btn-outline-warning">admin</a>&nbsp;&nbsp;
            <?php endif;  ?>

        <?php if ($session->get('profil') == 'client') : ?>
          <a href="<?php echo site_url('accueil') ?>" class="btn btn-outline-warning">Accueil</a>&nbsp;&nbsp;
          <a href="<?php echo site_url('afficheliaison') ?>" class="btn btn-outline-warning">Afficher les Liaisons</a>&nbsp;&nbsp;
          <a href="<?php echo site_url('reservation') ?>" class="btn btn-outline-warning">Réserver une traversée</a>&nbsp;&nbsp;
          <a href="<?php echo site_url('pageconfirmation') ?>" class="btn btn-outline-warning">client</a>&nbsp;&nbsp;
        <?php endif;  ?>

        <?php else : ?>
          <a href="<?php echo site_url('accueil') ?>" class="btn btn-outline-warning">Accueil</a>&nbsp;&nbsp;
          <a href="<?php echo site_url('seconnecter') ?>" class="btn btn-outline-warning">Se Connecter</a>&nbsp;&nbsp;
          <a href="<?php echo site_url('creercompte') ?>" class="btn btn-outline-warning">Creer un compte</a>&nbsp;&nbsp;
          <a href="<?php echo site_url('afficheliaison') ?>" class="btn btn-outline-warning">Afficher les Liaisons</a>&nbsp;&nbsp;
          <a href="<?php echo site_url('reservation') ?>" class="btn btn-outline-warning">Réservation</a>&nbsp;&nbsp;
          
        <?php endif; ?>
    


    