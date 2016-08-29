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
	if ( ! function_exists('crudController')) {
		function crudController($controller) {
			return function() use ($controller) {
				Route::get('/', $controller . '@getIndex');
				Route::post('search', $controller . '@postSearch');
				Route::get('order-by/{column}', $controller . '@getOrderBy');
				Route::get('add', $controller . '@getAdd');
				Route::post('add', $controller . '@postAdd');
				Route::get('edit/{id}', $controller . '@getEdit');
				Route::post('edit/{id}', $controller . '@postEdit');
			};
		}
	}
	Route::group(['middleware' => 'admin', 'namespace' => 'Crud'], function() {
		Route::group(['prefix' => 'users'], crudController('UserController'));
		Route::group(['prefix' => 'pages'], crudController('PageController'));

		Route::get('changes/{crudRepository}/{id}/{column}', 'ChangesController@getLog');
	});
});