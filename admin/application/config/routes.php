<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login";
$route['home/doDelete/(:num)'] = "home/doDelete";
$route['home/(:any)'] = "home/index";
$route['home/addEvent'] = "home/addEvent";
$route['edit_event/(:num)/(:any)'] = "edit_event/index";
$route['admin_event_dashboard/(:any)'] = "admin_event_dashboard/index";
$route['insert_team_leader/doDelete/(:num)'] = "insert_team_leader/doDelete";
$route['insert_team_leader/(:any)'] = "insert_team_leader/index";
$route['harga/doUpdate/(:any)'] = "harga/doUpdate";
$route['harga/(:any)'] = "harga/index";
$route['tl_event_dashboard/(:any)'] = "tl_event_dashboard/index";
$route['insert_spg/doDelete/(:num)'] = "insert_spg/doDelete";
$route['insert_spg/(:any)'] = "insert_spg/index";
$route['add_team_leader/doAdd/(:any)'] = "add_team_leader/doAdd";
$route['edit_team_leader/doEdit/(:any)'] = "edit_team_leader/doEdit";
$route['edit_team_leader/(:num)/(:any)'] = "edit_team_leader/index";
$route['edit_spg/doEdit/(:any)'] = "edit_spg/doEdit";
$route['edit_spg/(:num)/(:any)'] = "edit_spg/index";
$route['add_team_leader/(:any)'] = "add_team_leader/index";
$route['add_spg/doAdd/(:any)'] = "add_spg/doAdd";
$route['add_spg/(:any)'] = "add_spg/index";
$route['prize/doUpdate/(:any)'] = "prize/doUpdate";
$route['prize/(:any)'] = "prize/index";
$route['api_get_data/(:any)/(:any)/(:any)'] = "api_get_data/index";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */