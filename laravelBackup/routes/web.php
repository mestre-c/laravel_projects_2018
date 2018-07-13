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

    $users = factory(App\User::class, 10)->create();
    $posts = factory(App\Post::class, 500)->create();

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
