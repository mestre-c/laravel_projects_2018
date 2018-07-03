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

    public function lockTable()
    {
        // lock all tables
        DB::unprepared('FLUSH TABLES WITH READ LOCK;');
        
        // return redirect()->action('BackupsController@backup');
    }

    public function unlockTable()
    {
        // unlock all tables
        DB::unprepared('UNLOCK TABLES');
    }

    public function queryFetch($data)
    {
        $pdo  = DB::connection()->getPdo();
        $stmt = $pdo->prepare($data);
        $stmt->execute();
        // $stmt = $pdo->query($data);
        $results = $stmt->fetch();
        return $results;
    }

     public function create(Request $request)
    {
    	$this->setPDOMode();

        $numTables = DB::select("SHOW TABLES");
        // $numTables = $this->query("SHOW TABLES");
        $countUserRecords = User::count();
        $countPostRecords = Post::count();
 		
        return view('backup', compact('numTables','countUserRecords', 'countPostRecords'));
    }

    public function setPDOMode()
    {
    	\Event::listen(StatementPrepared::class, function ($event) {
        $event->statement->setFetchMode(\PDO::FETCH_ASSOC);});
    }

    public function backup(Request $request)
    {

    	if ($request->all()) {

    		$tables = request('table');

    		$output = '';

    		foreach ($tables as $key => $table) 
            {   
                $this->lockTable();

    			$show_table_query = $this->queryFetch("SHOW CREATE TABLE {$table}");

    			$output .="\n" . $show_table_query[1] . ";\n";
    			// $output .="\n" . $show_table_query[1];

                $this->setPDOMode();
	    		$single_result = DB::select("SELECT * FROM {$table}");

                $output .= $this->getTableData($single_result, $table);

            }
            // $this->unlockTable();
            $this->downloadFile($output);
    	}
    }
    
     /*
        TODO: Use Laravel Storage instead 
      */ 
    public function downloadFile($output)
    {
    	$file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
    	$file_handle = fopen($file_name, 'w+');
    	fwrite($file_handle, $output);
    	fclose($file_handle);
    	header('Content-Description: File Transfer');
    	header('Content-Type: application/octet-stream');
    	header('Content-Disposition: attachment; filename=' . basename($file_name));
    	header('Content-Transfer-Encoding: binary');
    	header("Expires: 0");
    	ob_clean();
        // ob_end_clean(); 
    	flush();
    	readfile($file_name);
    	unlink($file_name);

    }

    public function getTableData($single_result, $table) 
    {
        $this->unlockTable();

        $output = '';

        foreach ($single_result as $key => $table_val) 
        {  

        $output .= "\nINSERT INTO $table("; // MAKE DYNAMIC INSERT
        $output .= "" .implode(", ", array_keys($table_val)) . ") VALUES(";
        $output .= "'" . implode("','", array_values($table_val)) . "');\n";

        }

        return $output;
    }
}
