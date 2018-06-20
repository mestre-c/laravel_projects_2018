<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Artisan;
use Log;
use Storage;
use DB;
use App\Post;
use App\User;

class BackupsController extends Controller
{
   public function lockDatabaseTables()
    {

        // lock all tables
        DB::unprepared('FLUSH TABLES WITH READ LOCK;');
        
        return redirect()->action('BackupsController@backup');
    }
    
    // This method backups up db tables
    public function backup()
    {
        // Line 32 to 33 are optional. 
        // They are just for debugging purposes. So you can delete them if you wish.
        // run the artisan command to backup the db using the spatie package
        Artisan::call('backup:run', ['--only-db' => true]); 
        $output = Artisan::output();
        dump($output); 
        
        return redirect()->action('BackupsController@unlockAndCleanDatabaseTables');
    }
    
    // unlock tables and clean up backup-temp file
    public function unlockAndCleanDatabaseTables()
    {
        // unlock all tables
        DB::unprepared('UNLOCK TABLES');
        
        // Line 46 to 48 are optional. 
        // They are just for debugging purposes. So you can delete them if you wish. 
        Artisan::call('backup:clean');
        $output = Artisan::output();
        dump($output);
        
        $numTables = DB::select('SHOW TABLES');
        $countUserRecords = User::count();
        $countPostRecords = Post::count();

       	return view('result', 
       		compact('numTables', 'countUserRecords', 'countPostRecords'));

        //return redirect()->action('BackupsController@cleanBackup');

    }
}
