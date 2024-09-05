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
$route['default_controller']   = 'dashboard';
$route['404_override'] 			 = 'pagenotfound';
$route['translate_uri_dashes'] = FALSE;

$route['test/(:any)']			= 'main/test/$1';
$route['admin-login']			= 'login/index/admin';
$route['admin-mobile-otp']			= 'login/admin_mobile_otp';
$route['admin-check-otp']			= 'login/admin_check_otp';
$route['admin-update-pass']			= 'login/admin_update_pass';

$route['dashboard_content'] 	 = 'dashboard/dashboard_content';
$route['host_dashboard_content'] = 'dashboard/host_dashboard_content';

$route['changeStatusDispaly']  = 'main/changeStatusDispaly';
$route['change_status']        = 'main/change_status';
$route['change_status2']        = 'main/change_status2';
$route['changeIndexing']       = 'main/changeIndexing';
$route['title/(:any)/(:num)']  = 'main/title/$1/$2';
$route['logout'] 	           = 'login/logout';



// Start:: Profile
$route['profile']		        	= 'profile/index';
$route['profile/(:any)']			= 'profile/index/$1';
// End:: Profile

// Start Remote
$route['remote/(:any)'] 		= 'masters/remote/$1';
$route['remote/(:any)/(:any)'] 	= 'masters/remote/$1/$2';
$route['remote/(:any)/(:any)/(:any)'] = 'masters/remote/$1/$2/$3';
// End Remote

// Start :: Masters
$route['game-master'] 		       		= 'masters/game_master';
$route['game-master/(:any)'] 		    = 'masters/game_master/$1';
$route['game-master/(:any)/(:num)'] 	= 'masters/game_master/$1/$2';

$route['game-items'] 		       		= 'masters/game_items';
$route['game-items/(:any)'] 		    = 'masters/game_items/$1';
$route['game-items/(:any)/(:num)'] 	= 'masters/game_items/$1/$2';

$route['game-schedule'] 		       		= 'masters/game_schedule';
$route['game-schedule/(:any)'] 		    = 'masters/game_schedule/$1';
$route['game-schedule/(:any)/(:num)'] 	= 'masters/game_schedule/$1/$2';

$route['consumers'] 		       		= 'consumers/index';
$route['consumers/(:any)'] 		    = 'consumers/index/$1';
$route['consumers/(:any)/(:num)'] 	= 'consumers/index/$1/$2';

$route['consumers_remote/(:any)'] 		= 'consumers/consumers_remote/$1';
$route['consumers_remote/(:any)/(:any)'] 	= 'consumers/consumers_remote/$1/$2';
$route['consumers_remote/(:any)/(:any)/(:any)'] = 'consumers/consumers_remote/$1/$2/$3';

$route['consumers-wallet/(:num)'] 		       		= 'consumers/consumers_wallet/wallet/$1';
$route['consumers-wallet/tb/(:num)'] 		    = 'consumers/consumers_wallet/tb/$1';

$route['consumers-withdrawals/(:num)'] 		       		= 'consumers/consumers_withdrawals/withdrawals/$1';
$route['consumers-withdrawals/tb/(:num)'] 		    = 'consumers/consumers_withdrawals/tb/$1';

$route['withdrawals'] 		       		= 'consumers/withdrawals';
$route['withdrawals/(:any)'] 		    = 'consumers/withdrawals/$1';
$route['withdrawals/(:any)/(:num)'] 	= 'consumers/withdrawals/$1/$2';

$route['consumer-bets'] 		       		= 'consumers/bets';
$route['consumer-bets/(:any)'] 		    = 'consumers/bets/$1';
$route['consumer-bets/(:any)/(:num)'] 	= 'consumers/bets/$1/$2';

// End :: Masters









