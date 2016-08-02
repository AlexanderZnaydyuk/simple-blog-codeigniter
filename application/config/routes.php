<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'ArticleController/articles';

$route['migrate']['get'] = 'MigrationController/migrate';

$route['articles']['get'] = 'ArticleController/articles';
$route['articles/(:num)']['get'] = 'ArticleController/articles/$1';

$route['article/(:num)']['get'] = 'ArticleController/article/$1';
$route['article/delete/(:num)']['get'] = 'ArticleController/delete/$1';
$route['article/new']['get'] = 'ArticleController/getCreate';
$route['article/new']['post'] = 'ArticleController/postCreate';
$route['article/edit/(:num)']['get'] = 'ArticleController/getEdit/$1';
$route['article/edit/(:num)']['post'] = 'ArticleController/postEdit/$1';

$route['comment']['post'] = 'CommentaryController/post';

$route['auth/signup']['get']  = 'AuthController/getSignup';
$route['auth/signup']['post'] = 'AuthController/postSignup';

$route['auth/signin']['get'] = 'AuthController/getSignin';
$route['auth/signin']['post'] = 'AuthController/postSignin';

$route['auth/logout']['get'] = 'AuthController/logout';

$route['dashboard']['get'] = 'ArticleController/management';