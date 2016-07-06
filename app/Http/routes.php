<?php

//---------------------
// Admin
//---------------------
require('routes-admin.php');

//---------------------
// Front-end
//---------------------
Route::group(['namespace' => 'App'], function() {
	Route::get('/', 'PageController@home');
});