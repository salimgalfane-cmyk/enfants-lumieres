<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::index');
$routes->get('nos-actions', 'Pages::nosActions');
$routes->get('notre-impact', 'Pages::notreImpact');
$routes->get('parrainage', 'Pages::parrainage');
$routes->get('politique-de-confidentialite', 'Pages::confidentialite');

$routes->get('actualites', 'Actualites::index');
$routes->get('actualite/(:segment)', 'Actualites::show/$1');

$routes->get('contact', 'Contact::index');
$routes->post('contact', 'Contact::store');

$routes->get('sitemap.xml', 'Sitemap::index');

// Routes admin publiques (pas de session requise)
$routes->group('admin', static function (RouteCollection $routes) {
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('login', 'Admin\Auth::attempt');
    $routes->get('logout', 'Admin\Auth::logout');
});

// Routes admin protégées par AdminAuthFilter (voir app/Filters/AdminAuthFilter.php)
$routes->group('admin', ['filter' => 'adminauth'], static function (RouteCollection $routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    $routes->get('actualites', 'Admin\Actualites::index');
    $routes->get('actualites/create', 'Admin\Actualites::create');
    $routes->post('actualites', 'Admin\Actualites::store');
    $routes->get('actualites/(:num)/edit', 'Admin\Actualites::edit/$1');
    $routes->post('actualites/(:num)', 'Admin\Actualites::update/$1');
    $routes->get('actualites/(:num)/delete', 'Admin\Actualites::delete/$1');

    $routes->get('contacts', 'Admin\Contacts::index');
    $routes->get('contacts/(:num)/marquer-lu', 'Admin\Contacts::marquerLu/$1');

    $routes->get('enfants', 'Admin\Enfants::index');
    $routes->get('enfants/create', 'Admin\Enfants::create');
    $routes->post('enfants', 'Admin\Enfants::store');
    $routes->get('enfants/(:num)/edit', 'Admin\Enfants::edit/$1');
    $routes->post('enfants/(:num)', 'Admin\Enfants::update/$1');
    $routes->get('enfants/(:num)/delete', 'Admin\Enfants::delete/$1');
});
