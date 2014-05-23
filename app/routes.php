<?php

Route::get('/', function() {
	return View::make('index');
});

// API routes
Route::group(array('prefix' => 'api'), function() {
	Route::resource('shows', 'ShowController', array(
		'only' => array('index', 'show')
	));
});

// Catch all route
App::missing(function($exception) {
	return View::make('index');
});
