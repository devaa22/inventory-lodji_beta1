<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================
// PUBLIC (tanpa login)
// ==========================
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');


// ==========================
// INTERNAL (wajib login)
// ==========================
$routes->get('dashboard', 'Dashboard::index');

// STOCK
$routes->get('stocks', 'StockController::index');
$routes->get('stocks/transfer', 'StockController::transfer');
$routes->post('stocks/processTransfer', 'StockController::processTransfer');
$routes->get('stocks/receive', 'StockController::receive');
$routes->post('stocks/processReceive', 'StockController::processReceive');

// REPORTS
$routes->get('reports/stock', 'ReportController::stock');
$routes->get('reports/mutation', 'ReportController::mutation');
$routes->get('reports/stockin', 'ReportController::stockIn');
$routes->get('reports/stockcard', 'ReportController::stockCard');