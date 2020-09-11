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
$route['admin_dashboard'] = "master/DashboardCtrl/admin_dashboard";
$route['test_form'] = "master/DashboardCtrl/test_form";
$route['test_table'] = "master/DashboardCtrl/test_table";
$route['test_all'] = "master/DashboardCtrl/test_all";
$route['test_profile'] = "master/DashboardCtrl/test_profile";
$route['test_info'] = "master/DashboardCtrl/test_info";



$route['default_controller'] = "LoginCtrl/login";
$route['login'] = "LoginCtrl/login";
$route['sign_up'] = "LoginCtrl/sign_up";
$route['sign_in'] = "LoginCtrl/sign_in";
$route['logout'] = "LoginCtrl/logout";

$route['set_home_type'] = "master/MasterCtrl/set_home_type";
$route['get_home_type'] = "master/MasterCtrl/get_home_type";
$route['deleterow'] = "master/MasterCtrl/deleterow";
$route['edit_table'] = "master/MasterCtrl/edit_table";

$route['view_user'] = "master/MasterCtrl/view_user";
$route['add_user'] = "master/MasterCtrl/add_user";
$route['view_profile/:any'] = "master/MasterCtrl/view_profile";
$route['edit_user/:any'] = "master/MasterCtrl/edit_user";

$route['view_zone'] = "master/MasterCtrl/view_zone";
$route['view_brand'] = "master/MasterCtrl/view_brand";

$route['view_category'] = "master/MasterCtrl/view_category";
$route['add_category'] = "master/MasterCtrl/add_category";

$route['view_product'] = "master/MasterCtrl/view_product";
$route['add_product'] = "master/MasterCtrl/add_product";
$route['view_product_details/:any'] = "master/MasterCtrl/view_product_details";
$route['edit_product/:any'] = "master/MasterCtrl/edit_product";
$route['get_category_from_shop'] = "master/MasterCtrl/get_category_from_shop";

$route['view_advertisment'] = "master/MasterCtrl/view_advertisment";
$route['add_advertisment'] = "master/MasterCtrl/add_advertisment";
$route['view_advertisment_details/:any'] = "master/MasterCtrl/view_advertisment_details";
$route['edit_advertisment/:any'] = "master/MasterCtrl/edit_advertisment";

$route['add_text'] = "master/MasterCtrl/add_text";
$route['view_quiz'] = "master/MasterCtrl/view_quiz";
$route['add_quiz'] = "master/MasterCtrl/add_quiz";
$route['view_quiz_details/:any'] = "master/MasterCtrl/view_quiz_details";
$route['edit_quiz/:any'] = "master/MasterCtrl/edit_quiz";
$route['view_question'] = "master/MasterCtrl/view_question";
$route['edit_quiz_question/:any'] = "master/MasterCtrl/edit_quiz_question";
$route['delete_question/:any'] = "master/MasterCtrl/delete_question";
$route['select_winner'] = "master/MasterCtrl/select_winner";
$route['deleteimg'] = "master/MasterCtrl/deleteimg";

$route['view_push_notification'] = "master/MasterCtrl/view_push_notification";

$route['view_shop'] = "master/MasterCtrl/view_shop";
$route['add_shop'] = "master/MasterCtrl/add_shop";
$route['view_shop_details/:any'] = "master/MasterCtrl/view_shop_details";
$route['edit_shop/:any'] = "master/MasterCtrl/edit_shop";

$route['view_orders'] = "master/MasterCtrl/view_orders";
$route['assign_delivery'] = "master/MasterCtrl/assign_delivery";
$route['assign_offer'] = "master/MasterCtrl/assign_offer";
$route['get_notification'] = "master/MasterCtrl/get_notification";
$route['get_notification_list'] = "master/MasterCtrl/get_notification_list";
$route['view_order_details/:any'] = "master/MasterCtrl/view_order_details";
$route['view_orders_dperson'] = "master/MasterCtrl/view_orders_dperson";
$route['order_status_by_dperson'] = "master/MasterCtrl/order_status_by_dperson";
$route['edit_order/:any'] = "master/MasterCtrl/edit_order";
$route['add_order'] = "master/MasterCtrl/add_order";
$route['cancel_order/:any'] = "master/MasterCtrl/cancel_order";
$route['delete_order_item/:any'] = "master/MasterCtrl/delete_order_item";
$route['order_print_view/:any'] = "master/MasterCtrl/order_print_view";
$route['view_pushnotification'] = "master/MasterCtrl/view_pushnotification";
$route['change_status'] = "master/MasterCtrl/change_status";

////////////// STRAT API ROUTES   ///////////////////////////
$route['api_login'] = "master/ApiCtrl/api_login";
$route['api_fetchProductsByName'] = "master/ApiCtrl/api_fetchProductsByName";
$route['api_view_brand'] = "master/ApiCtrl/api_view_brand";
$route['api_view_category'] = "master/ApiCtrl/api_view_category";
$route['api_view_product'] = "master/ApiCtrl/api_view_product";
$route['api_view_advertisment'] = "master/ApiCtrl/api_view_advertisment";
$route['api_view_news'] = "master/ApiCtrl/api_view_news";
$route['api_view_quiz'] = "master/ApiCtrl/api_view_quiz";
$route['api_view_shop'] = "master/ApiCtrl/api_view_shop";
$route['api_view_product_details'] = "master/ApiCtrl/api_view_product_details";
$route['api_view_shop_details'] = "master/ApiCtrl/api_view_shop_details";
$route['api_insert_order'] = "master/ApiCtrl/api_insert_order";
$route['api_signup_user'] = "master/ApiCtrl/api_signup_user";
$route['api_login_user'] = "master/ApiCtrl/api_login_user";
$route['api_fetchProductsByBrandName'] = "master/ApiCtrl/api_fetchProductsByBrandName";
////////////// STRAT API ROUTES   ///////////////////////////


$route['view_news'] = "master/MasterCtrl/view_news";
$route['edit_news'] = "master/MasterCtrl/edit_news";
$route['superadmin_dashboard'] = "master/DashboardCtrl/superadmin_dashboard";
$route['edit_demoexamplan/:any'] = 'master/MasterCtrl/edit_demoexamplan';
$route['delete_demoexamplan/:num'] = 'master/MasterCtrl/delete_demoexamplan';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
