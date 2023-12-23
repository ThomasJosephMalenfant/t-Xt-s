<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Hermew;
/* use App\Controllers\Api;
use App\Controllers\Grafw;
use App\Controllers\Eklegw;
use App\Controllers\Dhlw;
 */

/**
 * @var RouteCollection $routes
 */
service('auth')->routes($routes);

$routes->get('/', 'Home::index');
$routes->get('hermew', [Hermew::class, 'search']);
$routes->get('hermew/(:any)', [Hermew::class, 'find']);
$routes->post('hermew', [Hermew::class, 'find']);


/* $routes->get('api', [Api::class, 'index']);
$routes->get('grafw', [Grafw::class, 'index']);
$routes->get('eklegw', [Eklegw::class, 'index']);
$routes->get('dhlw', [Dhlw::class, 'index']);
 */

