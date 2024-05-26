<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->get('/', 'DashboardController::index');
$routes->get('/dashboard', 'DashboardController::index');

// Kategori Tagihan 
$routes->get('/kategori_tagihan', 'KategoriTagihanController::index');
// $routes->get('/kategori_tagihan/add', 'KategoriTagihan::add');
$routes->post('/kategori_tagihan/store', 'KategoriTagihanController::store');
// $routes->get('/kategori_tagihan/edit/(:segment)', 'KategoriTagihan::edit/$1');
$routes->post('/kategori_tagihan/update/(:segment)', 'KategoriTagihanController::update/$1');
$routes->get('/kategori_tagihan/delete/(:segment)', 'KategoriTagihanController::delete/$1');

// Nama Tagihan 
$routes->get('/nama_tagihan', 'NamaTagihanController::index');
$routes->post('/nama_tagihan/store', 'NamaTagihanController::store');
$routes->post('/nama_tagihan/update/(:segment)', 'NamaTagihanController::update/$1');
$routes->get('/nama_tagihan/delete/(:segment)', 'NamaTagihanController::delete/$1');

// Jenis Status
$routes->get('/jenis_status', 'JenisStatusController::index');
$routes->post('/jenis_status/store', 'JenisStatusController::store');
$routes->post('/jenis_status/update/(:segment)', 'JenisStatusController::update/$1');
$routes->get('/jenis_status/delete/(:segment)', 'JenisStatusController::delete/$1');

// Status
$routes->get('/status', 'StatusController::index');
$routes->post('/status/store', 'StatusController::store');
$routes->post('/status/check_code_status/(:segment)/(:segment)', 'StatusController::check_code_status/$1/$2');

// Plan Tagihan 
$routes->get('/plan_tagihan', 'PlanTagihanController::index');
$routes->post('/plan_tagihan/detail', 'PlanTagihanController::detail');
// $routes->get('/plan_tagihan/detail/(:segment)', 'PlanTagihanController::detail/$1');
$routes->post('/plan_tagihan/store', 'PlanTagihanController::store');
$routes->post('/plan_tagihan/update/(:segment)', 'PlanTagihanController::update/$1');
$routes->get('/plan_tagihan/delete/(:segment)', 'PlanTagihanController::delete/$1');

// Code Tagihan 
$routes->get('/code_tagihan', 'CodeTagihanController::index');
$routes->post('/code_tagihan/store', 'CodeTagihanController::store');
$routes->post('/code_tagihan/update/(:segment)', 'CodeTagihanController::update/$1');
$routes->get('/code_tagihan/reset/(:segment)', 'CodeTagihanController::reset/$1');
