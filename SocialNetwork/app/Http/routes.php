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

/**
* Home
*/
Route::get('/', [
	'uses' => '\SocialNetwork\Http\Controllers\HomeController@index',
	'as' => 'home',
]);

/*
* Authetication
*/
Route::get('/signup', [

	'uses' => '\SocialNetwork\Http\Controllers\AuthController@getSignup',
	'as' => 'auth.signup'
]);

Route::post('/signup', [
	'uses' =>'\SocialNetwork\Http\Controllers\AuthController@postSignup',
]);


// Route::get('/alert', function() {
// 	return redirect()->route('home')->with('info', 'You have signed up!');
// });