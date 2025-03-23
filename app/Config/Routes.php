<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "Home::index");
$routes->match([ "post", "get" ], "/login", "Account::login");
$routes->match([ "post", "get" ], "/register", "Account::register");
$routes->match([ "post", "get" ], "/account", "Account::index");
$routes->get("/account/elevate", "Account::elevate");
$routes->post("/logout", "Account::logout");
$routes->get("/apps", "App::index");
$routes->match([ "post", "get" ], "/apps/publish", "App::publish");
$routes->get("/apps/dashboard", "App::dashboard");
$routes->get("/apps/category", "App::category");
$routes->get("/apps/ranking", "App::ranking");
$routes->get("/apps/search", "App::search");
$routes->post("/apps/ban", "App::ban");
$routes->get("/apps/id/(:num)", "App::view/$1");
$routes->post("/file/uploadProfileImage", "File::uploadProfileImage");
