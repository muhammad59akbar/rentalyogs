<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Admin::index');
$routes->get('/Admin/ListUser', 'Admin::listUser');
$routes->post('/Admin/AddUser', 'Admin::AddUser');
$routes->get('/Admin/DetailUser/(:segment)', 'Admin::detailUser/$1');
$routes->post('/Admin/EditUser/(:num)', 'Admin::editUser/$1');
$routes->delete('/Admin/DeleteUser/(:num)', 'Admin::deleteUser/$1');
