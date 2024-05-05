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