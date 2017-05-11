<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', function() {
		return redirect()->route('admin.users.index');
	});

    Route::group(['middleware' => 'admin', 'namespace' => 'Crud'], function() {
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
