<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "Home::index");
$routes->get("/search", "Search::getApps");
$routes->match(["get", "post"], "/login", "Account::login");
$routes->match(["get", "post"], "/register", "Account::register");
$routes->get("/logout", "Account::logout");
