<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "HomeController::index");
$routes->get("/app/(:num)", "ApplicationController::view/$1");
$routes->match(["GET", "POST"], "/app/submit", "ApplicationController::submit");
