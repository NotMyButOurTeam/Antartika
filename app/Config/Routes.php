<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "HomeController::index");
$routes->match(["GET", "POST"], "/user/login", "UserController::login");
$routes->match(["GET", "POST"], "/user/register", "UserController::register");
$routes->match(["GET", "POST"], "/user/(:num)", "UserController::view/$1");
$routes->get("/user/logout", "UserController::logout");
$routes->match(["GET", "POST"], "/app/(:num)", "ApplicationController::view/$1");
$routes->match(["GET", "POST"], "/app/submit", "ApplicationController::submit");
