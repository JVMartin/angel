<?php

//---------------------
// Admin
//---------------------
require('routes-admin.php');

//---------------------
// Front-end
//---------------------
Route::group(['namespace' => 'App\FrontEnd'], function() {
	Route::get('/', 'PageController@home');
});