<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Admin::index');
$routes->get('/Admin/ListUser', 'Admin::listUser', ['filter' => 'role:Pengelola Barang']);
$routes->post('/Admin/AddUser', 'Admin::AddUser');
$routes->get('/Admin/DetailUser/(:segment)', 'Admin::detailUser/$1', ['filter' => 'role:Pengelola Barang']);
$routes->post('/Admin/EditUser/(:num)', 'Admin::editUser/$1');
$routes->delete('/Admin/DeleteUser/(:num)', 'Admin::deleteUser/$1');


// driver
$routes->get('/listDriver', 'Driver::index');;


$routes->get('/ListMobil', 'Mobils::index');
$routes->post('/AddNewMobil', 'Mobils::addnewMobil');
$routes->get('/DetailMobil/(:segment)', 'Mobils::detailMobils/$1',  ['filter' => 'role:Pengelola Barang']);
$routes->post('/editDataMobil/(:num)', 'Mobils::editdataMobil/$1');
$routes->delete('/DeleteDataMobil/(:num)', 'Mobils::deletedataMobil/$1');

$routes->get('/ListDriver', 'Driver::index');
$routes->get('/DetailDriver/(:segment)', 'Driver::detailDriver/$1');
$routes->post('/editDriver/(:num)', 'Driver::editDriver/$1');
$routes->post('/addDriver', 'Driver::addDriver');
$routes->delete('/DeleteDriver/(:num)', 'Driver::deleteDriver/$1');

$routes->get('/ListPinjaman', 'PinjamanMobil::index');
$routes->post('/PinjamMobil', 'PinjamanMobil::PinjamMobil');
$routes->get('/KembalikanMobil', 'PinjamanMobil::KembalikanMobil');
$routes->get('/DetailPinjaman/(:segment)', 'PinjamanMobil::detailPinjaman/$1');
$routes->post('/EditPinjaman/(:num)', 'PinjamanMobil::EditPinjaman/$1');
$routes->delete('/DeletePinjaman/(:num)', 'PinjamanMobil::deletePinjaman/$1');

$routes->post('/ApproveMobil', 'PinjamanMobil::ApprovePinjaman');
$routes->get('/SuratJalan/(:segment)', 'PinjamanMobil::suratJalan/$1');
