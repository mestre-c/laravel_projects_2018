<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/populate', function () {

	$faker  = \Faker\Factory::create();

     foreach(range(1, 10) as $x) {
        Post::create([
           'title' => $faker->sentence(10),
           'body' => $faker->sentence(20),


        ]);
     }

	// create 20 users with just one line
	$users = factory(App\User::class, 20)->create();
    
    return view('backup');
});

Route::get('/backup', 'BackupsController@create');
Route::post('/backup', 'BackupsController@backup');
