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
use App\Post;

Route::get('/', function () {
	$faker  = \Faker\Factory::create();
     foreach(range(1, 10) as $x) {
        Post::create([
           'title' => $faker->sentence(10),
           'body' => $faker->sentence(20),
        ]);
     }
	// create 20 users with just one line
	$users = factory(App\User::class, 20)->create();

  return redirect()->route('create');
});

Route::get('/backup', 'BackupController@create')->name('create');
Route::post('/backup', 'BackupController@backup')->name('backup');

Route::get('/backupError', function() {

   return '<form method="GET" action="backup">
      <div>
            <p>The File is too large. Please, Try again!</p>
      </div>
      <button style="font-size:30px;background-color:rgba(50, 255, 0, 0.7);
      border-radius:10px;cursor:pointer;">GO Back</button>
    </form>';

    // return redirect()->route('create');

})->name('backupError');
