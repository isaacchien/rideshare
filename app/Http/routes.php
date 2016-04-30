<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware' => ['web']], function () {
	
	Route::get('/home', 'HomeController@index');
	Route::get('/trips', 'TripController@rides');
	Route::get('/trips/search', 'TripController@search');

	Route::post('/trips/join', 'TripController@join');
	Route::get('/directions', 'TripController@route');
	Route::get('/admin/create', 'AdminController@create');
	Route::post('/admin/store', 'AdminController@store');
	Route::post('/trips/delete', 'TripController@delete');

});

// Route::auth();
