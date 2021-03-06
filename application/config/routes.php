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
$route['default_controller'] = 'store/Site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/** ----------------------------------------------------------------------- */
/** Store Controller */
/** ----------------------------------------------------------------------- */

/* Routing Home */
$route['home'] = 'store/Site';
$route['(:num)'] = 'store/Site';
// $route['page/(:num)'] = 'store/Site';
// $route['page/(:num)'] = 'store/Site/index/$1';
$route['home/list_json/(:any)'] = 'store/Site/list_json/$1';

/* Routing Pages */
$route['tata-cara-lelang'] = 'store/Site/tata_cara_lelang';

/* Routing Produk */
$route['kategori'] = 'store/Kategori';
$route['kategori/(:any)'] = 'store/Kategori/index/$1';
$route['kategori/(:any)/(:num)'] = 'store/Kategori/index/$1/$2';

$route['produk'] = 'store/Produk';
$route['produk/detail/(:any)'] = 'store/Produk/detail/$1';

/* Routing Auth */
$route['login'] = 'store/Auth/login';
$route['signin'] = 'store/Auth/check';
$route['signout'] = 'store/Auth/signout';

/* Routing Peserta */
$route['peserta'] = 'store/Peserta';
$route['peserta/registrasi'] = 'store/Peserta/registrasi';
$route['peserta/profil'] = 'store/Peserta/profil';
$route['peserta/status-bid'] = 'store/Peserta/status_bid';
$route['peserta/checkout/(:num)'] = 'store/Peserta/checkout/$1';
$route['peserta/submit'] = 'store/Peserta/insert_data';
$route['peserta/update'] = 'store/Peserta/modify_data';
$route['peserta/list-invoice'] = 'store/Peserta/list_invoice';
$route['peserta/add-order'] = 'store/Peserta/add_order';
$route['peserta/pay-order/(:any)'] = 'store/Peserta/pay_order/$1';
$route['peserta/confirm-pay'] = 'store/Peserta/pay_confirm';
$route['peserta/add-pay'] = 'store/Peserta/add_pay';
$route['peserta/shipping-detail/(:any)'] = 'store/Peserta/shipping_detail/$1';
$route['peserta/finish-order'] = 'store/Peserta/finish_order';

/* Routing Bid */
$route['bid'] = 'store/Bid';
$route['bid/add'] = 'store/Bid/insert_data_bid';
$route['bid/order'] = 'store/Bid/insert_data_bin';
$route['bid/detail'] = 'store/Bid/detail';
$route['bid/update'] = 'store/Bid/modify_data';
$route['bid/up'] = 'store/Bid/up_data';
$route['bid/delete/(:num)'] = 'store/Bid/del_data/$1';
$route['bid/total'] = 'store/Bid/total';
$route['bid/total/item/(:any)'] = 'store/Bid/total_by_item';

/** ----------------------------------------------------------------------- */
/** End Store Controller */
/** ----------------------------------------------------------------------- */

/** ----------------------------------------------------------------------- */
/** Admin Controller */
/** ----------------------------------------------------------------------- */

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

/* Routing Biaya Kirim */
$route['admin/biaya-kirim'] = 'admin/BiayaKirim';
$route['admin/biaya-kirim/add'] = 'admin/BiayaKirim/add';
$route['admin/biaya-kirim/create'] = 'admin/BiayaKirim/create';
$route['admin/biaya-kirim/edit/(:any)'] = 'admin/BiayaKirim/edit/$1';
$route['admin/biaya-kirim/update'] = 'admin/BiayaKirim/update';
$route['admin/biaya-kirim/delete/(:any)'] = 'admin/BiayaKirim/delete/$1';

/* Routing Akun */
$route['admin/akun'] = 'admin/Akun';
$route['admin/akun/add'] = 'admin/Akun/add';
$route['admin/akun/create'] = 'admin/Akun/create';
$route['admin/akun/edit/(:any)'] = 'admin/Akun/edit/$1';
$route['admin/akun/profil/(:any)'] = 'admin/Akun/profil/$1';
$route['admin/akun/update'] = 'admin/Akun/update';
$route['admin/akun/delete/(:any)'] = 'admin/Akun/delete/$1';

/* Routing Pelelang */
$route['admin/pelelang'] = 'admin/Pelelang';
$route['admin/pelelang/add'] = 'admin/Pelelang/add';
$route['admin/pelelang/create'] = 'admin/Pelelang/create';
$route['admin/pelelang/edit/(:any)'] = 'admin/Pelelang/edit/$1';
$route['admin/pelelang/profil/(:any)'] = 'admin/Pelelang/profil/$1';
$route['admin/pelelang/update'] = 'admin/Pelelang/update';
$route['admin/pelelang/delete/(:any)'] = 'admin/Pelelang/delete/$1';
$route['admin/pelelang/block/(:any)'] = 'admin/Pelelang/banned/$1';

/* Routing Peserta */
$route['admin/peserta'] = 'admin/Peserta';
$route['admin/peserta/add'] = 'admin/Peserta/add';
$route['admin/peserta/create'] = 'admin/Peserta/create';
$route['admin/peserta/edit/(:any)'] = 'admin/Peserta/edit/$1';
$route['admin/peserta/profil/(:any)'] = 'admin/Peserta/profil/$1';
$route['admin/peserta/update'] = 'admin/Peserta/update';
$route['admin/peserta/delete/(:any)'] = 'admin/Peserta/delete/$1';
$route['admin/peserta/block/(:any)'] = 'admin/Peserta/banned/$1';


/* Routing Orders */
$route['admin/orders'] = 'admin/Orders';
$route['admin/orders/verify/(:num)'] = 'admin/Orders/verify/$1';
$route['admin/orders/verify-paid/(:any)'] = 'admin/Orders/verify_paid/$1';
$route['admin/orders/input-resi/(:any)'] = 'admin/Orders/input_resi/$1';
$route['admin/orders/submit-resi'] = 'admin/Orders/submit_resi';
$route['admin/orders/total-saldo'] = 'admin/Orders/get_total_saldo';

/** ----------------------------------------------------------------------- */
/** End Admin Controller */
/** ----------------------------------------------------------------------- */
