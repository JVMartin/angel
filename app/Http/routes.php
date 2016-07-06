<?php

//---------------------
// Admin
//---------------------
require('routes-admin.php');

//---------------------
// Front-end
//---------------------
Route::group(['namespace' => 'FrontEnd'], function() {
	Route::get('/', 'PageController@home');
});