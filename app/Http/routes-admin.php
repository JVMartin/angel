<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', 'AuthController@dashboardOrSignIn');
	Route::post('/sign-in', 'AuthController@login');

	//---------------------
	// Crud Controllers
	//---------------------
	Route::group(['middleware' => 'admin', 'namespace' => 'Crud'], function() {
		Route::controller('users', 'UserController');
	});
});