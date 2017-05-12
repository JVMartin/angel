<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

	// The "/admin" route - redirect to whichever admin module you want the admins to land on
	// by default.
	Route::get('/', function() {
		return redirect()->route('admin.users.index');
	})->name('admin');

	Route::group(['middleware' => 'admin', 'namespace' => 'Crud'], function() {
		// Blogs
		Route::group(['prefix' => 'blogs'], function() {
			Route::get('/', 'BlogController@getIndex')->name('admin.blogs.index');
			Route::post('search', 'BlogController@postSearch')->name('admin.blogs.index.search');
			Route::get('order-by/{column}', 'BlogController@getOrderBy')->name('admin.blogs.index.order-by');
			Route::get('add', 'BlogController@getAdd')->name('admin.blogs.add');
			Route::post('add', 'BlogController@postAdd');
			Route::get('edit/{hashid}', 'BlogController@getEdit')->name('admin.blogs.edit');
			Route::post('edit/{hashid}', 'BlogController@postEdit');
			Route::delete('{hashid}', 'BlogController@delete')->name('admin.blogs.delete');
		});

		// Pages
		Route::group(['prefix' => 'pages'], function() {
			Route::get('/', 'PageController@getIndex')->name('admin.pages.index');
			Route::post('search', 'PageController@postSearch')->name('admin.pages.index.search');
			Route::get('order-by/{column}', 'PageController@getOrderBy')->name('admin.pages.index.order-by');
			Route::get('add', 'PageController@getAdd')->name('admin.pages.add');
			Route::post('add', 'PageController@postAdd');
			Route::get('edit/{hashid}', 'PageController@getEdit')->name('admin.pages.edit');
			Route::post('edit/{hashid}', 'PageController@postEdit');
			Route::delete('{hashid}', 'PageController@delete')->name('admin.pages.delete');
		});

		// Users
		Route::group(['prefix' => 'users'], function() {
			Route::get('/', 'UserController@getIndex')->name('admin.users.index');
			Route::post('search', 'UserController@postSearch')->name('admin.users.index.search');
			Route::get('order-by/{column}', 'UserController@getOrderBy')->name('admin.users.index.order-by');
			Route::get('add', 'UserController@getAdd')->name('admin.users.add');
			Route::post('add', 'UserController@postAdd');
			Route::get('show/{hashid}', 'UserController@getShow')->name('admin.users.show');
			Route::get('edit/{hashid}', 'UserController@getEdit')->name('admin.users.edit');
			Route::post('edit/{hashid}', 'UserController@postEdit');
			Route::post('edit/{hashid}/password', 'UserController@postPassword')->name('admin.users.edit.password');
			Route::delete('{hashid}', 'UserController@delete')->name('admin.users.delete');
		});

		Route::get('changes/{crudRepository}/{hashid}/{column}', 'ChangesController@getLog')->name('admin.changes.log');
	});
});
