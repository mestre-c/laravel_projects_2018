<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Artisan;
use Log;
use Storage;

class BackupsController extends Controller
{
    // This method backups up db tables
    public function backup()
    {
        
        // lock all tables
        DB::unprepared('FLUSH TABLES WITH READ LOCK;');

        // run the artisan command to backup the db using the package I linked to
        Artisan::call('backup:run', ['--only-db' => true]);  // something like this

        // unlock all tables
        DB::unprepared('UNLOCK TABLES');
        
        return redirect()->action('BackupsController@stopBackup');
    }

    public function stopBackup() 
    {
        Artisan::call('backup:run', ['--only-db' => true]);
        $output = Artisan::output();
        dump($output);
    }
}
