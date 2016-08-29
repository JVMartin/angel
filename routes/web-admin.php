<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', 'LoginController@dashboardOrSignIn');
	Route::post('/sign-in', 'LoginController@login');

	//---------------------
	// Crud Controllers
	//---------------------
	Route::group(['middleware' => 'admin', 'namespace' => 'Crud'], function() {
		Route::controller('users', 'UserController');
		Route::controller('pages', 'PageController');

		Route::get('changes/{crudRepository}/{id}/{column}', 'ChangesController@getLog');
	});
});