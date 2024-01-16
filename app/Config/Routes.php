<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Dhlw;
use App\Controllers\Grafw;

/*
use App\Controllers\Eklegw;
 */

/**
 * @var RouteCollection $routes
 */
service('auth')->routes($routes);

$routes->get('/', 'Home::index');

$routes->resource('api/langues', ['controller' => 'Langues']) ;
$routes->resource('api/corpus', ['controller' => 'Corpus']) ;
$routes->resource('api/livres', ['controller' => 'Livres']) ;
$routes->resource('api/textes', ['controller' => 'Textes']) ;

$routes->get('dhlw', [Dhlw::class, 'index']);
$routes->get('grafw', [Grafw::class, 'index']);
//$routes->get('dhlw/(:any)', [Dhlw::class, 'find']);
//$routes->post('dhlw', [Dhlw::class, 'find']);

/* $routes->get('api', [Api::class, 'index']);
$routes->get('eklegw', [Eklegw::class, 'index']);
$routes->get('dhlw', [Dhlw::class, 'index']);
 */

