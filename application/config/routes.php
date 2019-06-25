<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Routing Sign In */
$route['admin'] = 'admin/Auth';
$route['admin/signin'] = 'admin/Auth';
$route['admin/check'] = 'admin/Auth/check';
$route['admin/reset-password'] = 'admin/Auth/reset';
$route['admin/signout'] = 'admin/Auth/signout';
/* End Routing Sign In */


/* Routing Dashboard */
$route['admin/dashboard'] = 'admin/Site';

/* Routing Kategori Produk */
$route['admin/kategori'] = 'admin/Kategori';
$route['admin/kategori/add'] = 'admin/Kategori/add';
$route['admin/kategori/create'] = 'admin/Kategori/create';
$route['admin/kategori/edit/(:any)'] = 'admin/Kategori/edit/$1';
$route['admin/kategori/update'] = 'admin/Kategori/update';
$route['admin/kategori/delete/(:any)'] = 'admin/Kategori/delete/$1';

/* Routing Produk */
$route['admin/produk'] = 'admin/Produk';
$route['admin/produk/add'] = 'admin/Produk/add';
$route['admin/produk/create'] = 'admin/Produk/create';
$route['admin/produk/edit/(:any)'] = 'admin/Produk/edit/$1';
$route['admin/produk/update'] = 'admin/Produk/update';
$route['admin/produk/delete/(:any)'] = 'admin/Produk/delete/$1';

/* Routing Kota */
$route['admin/kota'] = 'admin/Kota';
$route['admin/kota/add'] = 'admin/Kota/add';
$route['admin/kota/create'] = 'admin/Kota/create';
$route['admin/kota/edit/(:any)'] = 'admin/Kota/edit/$1';
$route['admin/kota/update'] = 'admin/Kota/update';
$route['admin/kota/delete/(:any)'] = 'admin/Kota/delete/$1';
