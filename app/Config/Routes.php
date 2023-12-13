<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

use App\Controllers\Api;
$routes->get('hermew', [Api::class, 'index']);

use App\Controllers\Hermew;
$routes->get('hermew', [Hermew::class, 'index']);

use App\Controllers\Grafw;
$routes->get('hermew', [Grafw::class, 'index']);

use App\Controllers\Eklegw;
$routes->get('hermew', [Eklegw::class, 'index']);

use App\Controllers\Dhlw;
$routes->get('hermew', [Dhlw::class, 'index']);
