<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "Home::index");
$routes->get("/search", "Search::getApps");
$routes->get("/app/(:num)", "App::view/$1");
$routes->get("/app/publish", "App::publish");
$routes->match(["get", "post"], "/login", "Account::login");
$routes->match(["get", "post"], "/register", "Account::register");
$routes->get("/user/ascend", "Account::ascend");
$routes->get("/logout", "Account::logout");
