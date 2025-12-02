<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Jika akses root "/", arahkan ke login (juga pakai filter noauth)
$routes->get('/', function () {
    return redirect()->to('auth/login');
}, ['filter' => 'noauth']);

// Cegah user/admin yang sudah login membuka halaman login
$routes->group('auth', ['filter' => 'noauth'], function ($routes) {
    $routes->get('login', 'AuthController::index');
    $routes->post('login', 'AuthController::aksi_login');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::aksi_register');
});
// logout
$routes->get('/auth/logout', 'AuthController::logout');

// Admin
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
});

// user
$routes->group('user', ['filter' => 'role:user'], function ($routes) {
    $routes->get('dashboard', 'UserController::dashboard');
    $routes->get('tentang-saya', 'UserController::tentang_saya');
    // pages
    $routes->get('kalkulator-peluang', 'UserController::kalkulator');
    $routes->get('simulasi-dadu-koin', 'UserController::simulasi_koin_dadu');
    $routes->get('bahan-ajar', 'UserController::bahan_ajar');
    $routes->get('modul-ajar', 'UserController::modul_ajar');
    $routes->get('lkpd-digital', 'UserController::lkpd_digital');
    $routes->get('quiz', 'UserController::quiz');
});
