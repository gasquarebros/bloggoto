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
$route['default_controller'] = 'login';
$route['changepassword'] = 'login/changepassword';
$route['reset_password/(.*)'] = 'login/reset_password/$1';
$route['activation/(.*)'] = 'login/activation/$1';
$route['logout'] = 'login/logout';
$route['login'] = 'login/index';
$route['faq/(.*)'] = 'faq/index/$1';
$route['ncadminpanel'] = 'ncadminpanel/index';
$route['ncadminpanel/(.*)'] = 'ncadminpanel/$1';
$route['myprofile/viewbio'] = 'myprofile/viewbio';
$route['myprofile/viewbio/(.*)'] = 'myprofile/viewbio/$1';
$route['myprofile/viewblogs'] = 'myprofile/viewblogs';
$route['myprofile/viewtags'] = 'myprofile/viewtags';
$route['myprofile/message/(.*)'] = 'myprofile/message/$1';
$route['myprofile/viewblogs/(.*)'] = 'myprofile/viewblogs/$1';
$route['myprofile/viewtags/(.*)'] = 'myprofile/viewtags/$1';
$route['myprofile/add_followers/(.*)'] = 'myprofile/add_followers/$1';
$route['myprofile/post_likes/(.*)'] = 'myprofile/post_likes/$1';
$route['myprofile/post_favor/(.*)'] = 'myprofile/post_favor/$1';
$route['myprofile/comments/(.*)'] = 'myprofile/comments/$1';
$route['myprofile/addcomments'] = 'myprofile/addcomments';
$route['myprofile/pull_post_log'] = 'myprofile/pull_post_log';		
$route['myprofile/getstates'] = 'myprofile/getstates';		
$route['myprofile/getcities'] = 'myprofile/getcities';		
$route['myprofile/favorlist'] = 'myprofile/favorlist';		
$route['myprofile/favor_ajax_pagination'] = 'myprofile/favor_ajax_pagination';		
$route['myprofile/get_followers_profile/(.*)'] = 'myprofile/get_followers_profile/$1';		
$route['myprofile/get_following_profile/(.*)'] = 'myprofile/get_following_profile/$1';		
$route['myprofile/deletepostcomment/(.*)'] = 'myprofile/deletepostcomment/$1';		
$route['myprofile/notify_mark_read'] = 'myprofile/notify_mark_read';		
$route['myprofile/accountdelete/(.*)'] = 'myprofile/accountdelete/$1';		
$route['notification'] = 'myprofile/notification';
$route['myprofile/(.*)'] = 'myprofile/index/$1';
$route['myprofile'] = 'myprofile/index';
$route['wall'] = 'home/wall';
$route['home'] = 'home/wall';
$route['home/wall_ajax_pagination'] = 'home/wall_ajax_pagination';
$route['home/wall_ajax_pagination/(.*)'] = 'home/wall_ajax_pagination/$1';
$route['home/draftpost'] = 'home/draftpost';
$route['home/addpost'] = 'home/addpost';
$route['home/savedraftpost'] = 'home/savedraftpost';
$route['home/ajax_pagination'] = 'home/ajax_pagination';
$route['home/ajax_autocomplete'] = 'home/ajax_autocomplete';
$route['home/updatepost'] = 'home/updatepost';
$route['home/editpost/(.*)'] = 'home/editpost/$1';
$route['home/deletepost'] = 'home/deletepost';
$route['home/reportpost'] = 'home/reportpost';
$route['home/view/(.*)'] = 'home/view/$1';
$route['home/(.*)'] = 'home/index/$1';
$route['registration'] = 'registration/index';
$route['search'] = 'search/index';
$route['conversations'] = 'conversations/index';
$route['conversations/view/(.*)'] = 'conversations/view/$1';
$route['conversations/new_message/(.*)'] = 'conversations/new_message/$1';
$route['conversations/new_message'] = 'conversations/new_message';
$route['conversations/create_message'] = 'conversations/create_message';
$route['conversations/post_reply'] = 'conversations/post_reply';
$route['conversations/(.*)'] = 'conversations/$1';
$route['keep_alive'] = 'login/keep_alive';
$route['page/(.*)'] = 'home/page/$1';
$route['(.*)'] = 'myprofile/index/$1';
$route['products/ajax_pagination'] = 'products/ajax_pagination';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
