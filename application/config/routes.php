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

$route['account'] = 'Welcome/account';
$route['importdatabase'] = 'Welcome/importdatabase';
//AUTH ROUTES
$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';
$route['register'] = 'Auth/register';
$route['activate/(:num)/(:any)'] = 'Auth/activate/$1/$2';
$route['resend_activation'] = 'Auth/resend_activation';
$route['forgot_password'] = 'Auth/forgot_password';
$route['reset_password/(:any)'] = 'Auth/reset_password/$1';
/*
 * --------------------------------------------------------
 * ADMIN ROUTES
 * --------------------------------------------------------
 */
//AUTH ROUTES
$route['admin/login'] = 'AuthAdmin/index';
$route['admin/logout'] = 'AuthAdmin/logout';
$route['admin/register'] = 'AuthAdmin/register';
$route['admin/activate/(:num)/(:any)'] = 'AuthAdmin/activate/$1/$2';
$route['admin/resend_activation'] = 'AuthAdmin/resend_activation';
$route['admin/forgot_password'] = 'AuthAdmin/forgot_password';
$route['admin/reset_password/(:any)'] = 'AuthAdmin/reset_password/$1';

$route['admin'] = 'Admin/index';
//Roles
$route['admin/roles'] = 'Admin/roles';
$route['admin/roles/create'] = 'Admin/role_create';
$route['admin/roles/edit/(:num)'] = 'Admin/role_edit/$1';
$route['admin/roles/delete/(:num)'] = 'Admin/role_delete/$1';
//Modules
$route['admin/modules'] = 'Admin/modules';
$route['admin/modules/create'] = 'Admin/module_create';
$route['admin/modules/edit/(:num)'] = 'Admin/module_edit/$1';
$route['admin/modules/delete/(:num)'] = 'Admin/module_delete/$1';
//Users
$route['admin/users'] = 'Admin/users';
$route['admin/users/create'] = 'Admin/user_create';
$route['admin/users/edit/(:num)'] = 'Admin/user_edit/$1';
$route['admin/users/delete/(:num)'] = 'Admin/user_delete/$1';
//Admins
$route['admin/admins'] = 'Admin/admins';
$route['admin/admins/create'] = 'Admin/admin_create';
$route['admin/admins/edit/(:num)'] = 'Admin/admin_edit/$1';
$route['admin/admins/delete/(:num)'] = 'Admin/admin_delete/$1';
//Unauthorized
$route['admin/unauthorized'] = 'Welcome/unauthorized';
