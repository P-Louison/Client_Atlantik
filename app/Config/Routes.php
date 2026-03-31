<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('bonjourparametre/(:alpha)', 'Test::bonjourParametre/$1');
$routes->match(['get', 'post'], 'bonjournom', 'Test::bonjourNom');

$routes->get('accueil', 'Visiteur::accueil');
$routes->get('accueil', 'Administrateur::accueil');
$routes->match(['get', 'post'], 'creercompte', 'Visiteur::creercompte');

$routes->get('afficheliaison', 'Visiteur::afficheliaison');
$routes->get('tarif/(:alphanum)', 'Visiteur::tarif/$1');

$routes->match(['get', 'post'], 'seconnecter', 'Visiteur::seConnecter');
$routes->match(['get', 'post'], 'sedeconnecter', 'Visiteur::seDeconnecter');


