<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Admin::index');
$routes->get('/Admin/ListUser', 'Admin::listUser');
$routes->get('/Admin/DetailUser/(:segment)', 'Admin::detailUser/$1');
