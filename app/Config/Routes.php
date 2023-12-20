<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

use App\Controllers\Api;
$routes->get('api', [Api::class, 'index']);

use App\Controllers\Hermew;
$routes->get('hermew', [Hermew::class, 'index']);

use App\Controllers\Grafw;
$routes->get('grafw', [Grafw::class, 'index']);

use App\Controllers\Eklegw;
$routes->get('eklegw', [Eklegw::class, 'index']);

use App\Controllers\Dhlw;
$routes->get('dhlw', [Dhlw::class, 'index']);

use App\Controllers\Livres;
$routes->get('livres', [Livres::class, 'index']);
$routes->get('livres/(:segment)', [Livres::class, 'show']);