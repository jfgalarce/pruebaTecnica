<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('tasks', function ($routes) {
    $routes->get('/', 'TaskController::index');
    $routes->get('(:num)', 'TaskController::show/$1');
    $routes->post('/', 'TaskController::create');
    $routes->put('(:num)', 'TaskController::update/$1');
    $routes->delete('(:num)', 'TaskController::delete/$1');
});
