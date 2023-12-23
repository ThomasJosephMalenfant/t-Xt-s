<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Hermew;
/* use App\Controllers\Api;
use App\Controllers\Grafw;
use App\Controllers\Eklegw;
use App\Controllers\Dhlw;
 */
// Controller bidon... à effacer quand superflus...
use App\Controllers\Livres;

/**
 * @var RouteCollection $routes
 */
service('auth')->routes($routes);

$routes->get('/', 'Home::index');
$routes->get('hermew', [Hermew::class, 'index']);
$routes->get('hermew/(:any)', [Hermew::class, 'search']);


/* $routes->get('api', [Api::class, 'index']);
$routes->get('grafw', [Grafw::class, 'index']);
$routes->get('eklegw', [Eklegw::class, 'index']);
$routes->get('dhlw', [Dhlw::class, 'index']);
 */
//Routes bidon, à effacer quand superflus
$routes->get('livres', [Livres::class, 'index']);
$routes->get('livres/(:segment)', [Livres::class, 'show']);


