<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "HomeController::index");
$routes->match(["GET", "POST"], "/user/login", "UserController::login");
$routes->match(["GET", "POST"], "/user/register", "UserController::register");
$routes->match(["GET", "POST"], "/user/(:num)", "UserController::view/$1");
$routes->match(["GET", "POST"], "/user/edit", "UserController::edit");
$routes->post("/user/elevateToPublisher", "UserController::becomePublisher");
$routes->get("/user/dashboard", "UserController::dashboard");
$routes->get("/user/logout", "UserController::logout");
$routes->match(["GET", "POST"], "/app/(:num)", "ApplicationController::view/$1");
$routes->match(["GET", "POST"], "/app/submit", "ApplicationController::submit");
$routes->get("/app/search", "ApplicationController::search");
$routes->match(["GET", "POST"], "/app/edit", "ApplicationController::edit");
$routes->get("/mod/panel", "ModeratorController::panel");
$routes->post("/mod/verify", "ModeratorController::verifyApplication");
