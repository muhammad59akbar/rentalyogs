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


// driver
$routes->get('/listDriver', 'Driver::index');;


$routes->get('/ListMobil', 'Mobils::index');
$routes->post('/AddNewMobil', 'Mobils::addnewMobil');
$routes->get('/DetailMobil/(:segment)', 'Mobils::detailMobils/$1');
$routes->post('/editDataMobil/(:num)', 'Mobils::editdataMobil/$1');
$routes->delete('/DeleteDataMobil/(:num)', 'Mobils::deletedataMobil/$1');

$routes->get('/ListPinjaman', 'PinjamanMobil::index');
$routes->post('/PinjamMobil', 'PinjamanMobil::PinjamMobil');
// $routes->post('/KembalikanMobil', 'PinjamanMobil::KembalikanMobil');
$routes->get('/DetailPinjaman/(:segment)', 'PinjamanMobil::detailPinjaman/$1');
$routes->get('/SuratJalan/(:segment)', 'PinjamanMobil::suratJalan/$1');
