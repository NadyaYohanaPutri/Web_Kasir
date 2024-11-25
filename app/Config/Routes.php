<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/produk', 'ProdukCopy::index');
$routes->post('/produk/simpan', 'ProdukCopy::simpan_produk');
$routes->get('/produk/tampil', 'ProdukCopy::tampil_produk');
$routes->delete('/produk/hapus/(:num)', 'ProdukCopy::hapus_produk/$1');
$routes->post('/produk/update', 'ProdukCopy::update_produk');
$routes->get('/produk/detail/(:num)', 'ProdukCopy::detail/$1');

// routes pelanggan
$routes->get('/pelanggan', 'PelangganCopy::index'); 
$routes->get('/pelanggan/tampil', 'PelangganCopy::tampil_pelanggan');
$routes->post('/pelanggan/simpan', 'PelangganCopy::simpan_pelanggan');
$routes->get('/pelanggan/hapus/(:num)', 'PelangganCopy::hapus_pelanggan/$1');
$routes->post('/pelanggan/update', 'PelangganCopy::update');
$routes->get('/pelanggan/tampil/(:num)', 'PelangganCopy::tampil_by_id/$1');