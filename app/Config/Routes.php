<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/template', 'Home::index');

$routes->get('courses', 'Courses::index');
$routes->get('courses/detail/(:segment)', 'Courses::detail/$1');

$routes->get('kelolauser', 'KelolaUser::index');
$routes->post('kelolauser/updateAkses/(:num)', 'KelolaUser::updateAkses/$1');


$routes->get('historipembelian', 'Home::historipembelian');
$routes->post('pembayaran/simpanpembayaran', 'Pembayaran::simpanpembayaran');
$routes->get('pembayaran/proses/(:segment)', 'Pembayaran::proses/$1');
$routes->get('pembayaran/instruksi/(:num)', 'Pembayaran::instruksi/$1');
$routes->post('pembayaran/updateStatus/(:num)', 'Pembayaran::updateStatus/$1');
$routes->get('pembayaran/deletepembelian/(:num)', 'Pembayaran::deletepembelian/$1');


$routes->get('infopengaturanujian', 'Pengaturanujian::daftar');
$routes->get('pengaturanujian', 'PengaturanUjian::index');
$routes->get('pengaturanujian/edit/(:num)', 'PengaturanUjian::edit/$1');
$routes->post('pengaturanujian/update/(:num)', 'PengaturanUjian::update/$1');
$routes->get('pengaturanujian/delete/(:num)', 'PengaturanUjian::delete/$1');
$routes->post('pengaturanujian/simpan', 'PengaturanUjian::simpan');



$routes->get('/ujian', 'PengaturanUjian::ujian');
$routes->get('mulaiujian/(:num)', 'PengaturanUjian::mulai/$1');
$routes->post('pengaturanujian/simpanjawaban/(:num)', 'PengaturanUjian::simpanjawaban/$1');



$routes->get('soal/tambah', 'Soal::tambah');
$routes->post('soal/simpan', 'Soal::simpan');
$routes->get('soal/edit/(:num)', 'Soal::edit/$1');
$routes->post('soal/update/(:num)', 'Soal::update/$1');
$routes->get('soal/delete/(:num)', 'Soal::delete/$1');
$routes->get('daftarsoal', 'Soal::index');


//web MainPage
$routes->get('/', 'Home::index');
$routes->get('/pages', 'Pages::view/index');              // default page (home)


$routes->post('/ceklogin', 'Home::ceklogin');
$routes->post('/logout', 'Home::logout');


$routes->post('/inputUser', 'Home::inputUser');


$routes->get('/inputProduk', 'Home::inputProduk');
$routes->post('simpanPembelianProduk', 'Home::simpanPembelianProduk');


$routes->get('(:any)', 'Pages::view/$1');       // catch-all for pages like /about, /contact, etc.

