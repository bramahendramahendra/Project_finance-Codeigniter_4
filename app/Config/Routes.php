<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->get('/', 'Dashboard::index');

// Kategori Tagihan 
$routes->get('/kategori_tagihan', 'KategoriTagihan::index');
// $routes->get('/kategori_tagihan/add', 'KategoriTagihan::add');
$routes->post('/kategori_tagihan/store', 'KategoriTagihan::store');
// $routes->get('/kategori_tagihan/edit/(:segment)', 'KategoriTagihan::edit/$1');
$routes->post('/kategori_tagihan/update/(:segment)', 'KategoriTagihan::update/$1');
$routes->get('/kategori_tagihan/delete/(:segment)', 'KategoriTagihan::delete/$1');
