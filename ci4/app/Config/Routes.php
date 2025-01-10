<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    return view('main');
});


$routes->group('auth', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');

    // Rute untuk lupa password
    $routes->post('forgot-password', 'AuthController::forgotPassword');

    // Rute untuk reset password
    $routes->post('reset-password', 'AuthController::resetPassword');

    // View aja
    $routes->get('register', function () {
        echo view('register');
    });
    $routes->get('login', function () {
        echo view('register');
    });
});

$routes->group('appointments', function($routes)
{
    // Rute untuk mendapatkan jadwal yang available
    $routes->get('available', 'AppointmentController::getAvailableSchedules');

    // Rute untuk memesan jadwal (POST)
    $routes->post('book/(:segment)', 'AppointmentController::bookAppointment/$1');

    // Rute untuk menampilkan jadwal yang sudah dibooking oleh user
    $routes->get('booked/(:segment)', 'AppointmentController::getBookedAppointments/$1');

    // Rute untuk membatalkan reservasi
    $routes->delete('cancel/(:segment)', 'AppointmentController::cancelReservation/$1');

    // View aja
    $routes->get('available', function () {
        echo view('available');
    });
});

$routes->group('articles', function($routes)
{
    // Rute untuk menampilkan semua artikel
    $routes->get('', 'ArticleController::index');
});

$routes->get('/available-schedules', 'AppointmentController::avail');
$routes->get('/bookschedule', 'AppointmentController::book');
$routes->get('/bookings', 'AppointmentController::bookedView');