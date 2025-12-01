<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return redirect()->to('auth/login');
});
$routes->get('/auth/login', 'AuthController::index');
$routes->post('/auth/login', 'AuthController::aksi_login');
$routes->get('/auth/logout', 'AuthController::logout');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'login']);

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
