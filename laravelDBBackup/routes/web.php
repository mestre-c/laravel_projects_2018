<?php

use App\Post;
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

Route::get('/', function () {

	$faker  = \Faker\Factory::create();

     foreach(range(1, 100) as $x) {
        Post::create([
           'title' => $faker->sentence(10),
           'body' => $faker->sentence(50),


        ]);
     }

     // create 50 users with just one line
	$users = factory(App\User::class, 50)->create();


    return '<form method="GET" action="lock">

      <button style="font-size:30px;background-color:rgba(50, 255, 0, 0.7);
      border-radius:10px;cursor:pointer;">Backupdb</button>

    </form>';
});

Route::get('/lock', 'BackupsController@lockDatabaseTables');
Route::get('/backup', 'BackupsController@backup');
Route::get('/unlockAndClean', 'BackupsController@unlockAndCleanDatabaseTables');
// Route::get('/clean', 'BackupsController@cleanBackup');