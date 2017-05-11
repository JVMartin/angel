<?php

Route::group(['namespace' => 'App'], function() {
	Route::get('register', 'RegisterController@getRegister')->name('register');
	Route::post('register', 'RegisterController@postRegister');

	Route::post('sign-in', 'SignInController@login')->name('sign-in');
	Route::get('sign-out', 'SignInController@logout');

	// Forgot password routes
    Route::group(['prefix' => 'password'], function() {
        Route::get('reset', 'ForgotPasswordController@getLinkRequestForm')->name('password.forgot');
        Route::post('reset', 'ForgotPasswordController@postLinkRequestForm');
        Route::get('reset/{token}', 'ResetPasswordController@getResetForm')->name('password.reset');
        Route::post('reset/{token}', 'ResetPasswordController@postResetForm');
    });

	// MUST be the last route defined, as it has a base-level, catch-all variable.
	Route::get('{slug?}', 'PageController@getPage');
});
