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
$route['default_controller'] = 'sam/home';
$route['my-account.html'] = 'sam/users/login';

$route['san-pham.html'] = 'sam/products';
$route['index.html'] = 'sam/home';
$route['gio-hang.html'] = 'sam/cart/showCart';
$route['thanh-toan.html'] = 'sam/payment/checkout';
$route['san-pham/(:any).html'] = 'sam/products/detail/$1';
$route['danh-muc/(:any).html'] = 'sam/products/category/$1';
$route['tu-khoa/(:any).html'] = 'sam/products/tag/$1';

$route['lien-he.html'] = 'sam/page/contact';
$route['ve-chung-toi.html'] = 'sam/page/about';

$route['category/(:any).html'] = 'sam/news/category/$1';
$route['tag/(:any).html'] = 'sam/news/tag/$1';
$route['(:any).html'] = 'sam/news/detail/$1';

$route['admin/login'] = 'admin/verify/login';
$route['admin/logout'] = 'admin/verify/logout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
