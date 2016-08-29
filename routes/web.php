<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

Route::group(['namespace' => 'App'], function() {
	Route::get('/', 'PageController@getPage');

	Route::group(['namespace' => 'Auth'], function() {
		Route::get('/sign-out', 'LoginController@logout');
	});

	// MUST be the last route defined, as it has a base-level, catch-all variable.
	Route::get('{slug}', 'PageController@getPage');
});