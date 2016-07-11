<?php

//---------------------
// Admin Panel
//---------------------

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', 'AdminAuthController@gateway');
	Route::post('sign-in', 'AdminAuthController@postSignIn');

	/*Route::group(['middleware' => 'admin'], function() {
		// @TODO:
		// Should we use middleware here that implements a policy gate...
		// or perhaps handle this from the AdminController constructor?
	});*/
});