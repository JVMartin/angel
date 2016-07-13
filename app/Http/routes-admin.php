<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

//---------------------
// Admin Panel
//---------------------

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', 'AdminAuthController@dashboardOrSignIn');
	Route::post('/sign-in', 'AdminAuthController@login');

	/*Route::group(['middleware' => 'admin'], function() {
		// @TODO:
		// Should we use middleware here that implements a policy gate...
		// or perhaps handle this from the AdminController constructor?
	});*/
});