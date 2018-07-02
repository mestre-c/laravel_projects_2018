<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Events\StatementPrepared; // set the fetch mode
// use Storage;
use Carbon\Carbon;

use DB;
use App\Post;
use App\User;

class BackupController extends Controller
{

    public function lockDatabaseTables()
    {

        // lock all tables
        DB::unprepared('FLUSH TABLES WITH READ LOCK;');
        
        return redirect()->action('BackupsController@backup');
    }

     public function create(Request $request)
    {

        $numTables = $this->query("SHOW TABLES");
        // $countUserRecords = User::count();
        // $countPostRecords = Post::count();
 
        return view('backup', compact('numTables'));
    }

    public function setPDOMode()
    {
    	\Event::listen(StatementPrepared::class, function ($event) {
        $event->statement->setFetchMode(\PDO::FETCH_ASSOC);});
    }

    public function backup()
    {

    }
}
