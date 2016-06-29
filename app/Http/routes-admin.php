<?php

//---------------------
// Admin Panel
//---------------------

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', 'AdminAuthController@authorize');

	Route::group(['middleware' => 'admin'], function() {
		// @TODO:
		// Should we use middleware here that implements a policy gate...
		// or perhaps handle this from the AdminController constructor?
	});
});