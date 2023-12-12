<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
service('auth')->routes($routes);

use App\Controllers\Hermew;

$routes->get('hermew', [Hermew::class, 'index']);
