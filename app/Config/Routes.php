<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "Home::index");
$routes->get("/search", "Search::search");
$routes->get("/login", "Login::index");
$routes->post("/auth", "Login::auth");
