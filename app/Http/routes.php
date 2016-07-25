<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

//---------------------
// Admin Panel
//---------------------
require app_path('Http/routes-admin.php');

//---------------------
// Front-end
//---------------------
Route::group(['namespace' => 'App'], function() {
	Route::get('/', 'PageController@home');

	Route::group(['namespace' => 'Auth'], function() {
		Route::get('/sign-out', 'AuthController@logout');
	});
});