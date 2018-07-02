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

    public function queryFetch($data)
    {
        $pdo  = DB::connection()->getPdo();
        $stmt = $pdo->query($data);
        $results = $stmt->fetch();
        return $results;
    }


    public function queryFetchAll($data)
    {
        $pdo  = DB::connection()->getPdo();
        $stmt = $pdo->query($data);
        $results = $stmt->fetchAll();
        return $results;
    }

     public function create(Request $request)
    {
    	$this->setPDOMode();

        $numTables = DB::select("SHOW TABLES");
        // $numTables = $this->query("SHOW TABLES");
        // $countUserRecords = User::count();
        // $countPostRecords = Post::count();
 		// dd($numTables);
        return view('backup', compact('numTables'));
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

    		foreach ($tables as $key => $table) {
    		
    			$show_table_query = $this->queryFetch("SHOW CREATE TABLE {$table}");
    			
    			var_dump($show_table_query);

    			$output .="\n" . $show_table_query[1] . ";\n";
    			// $output .="\n" . $show_table_query[1];


	    		$single_result = $this->queryFetch("SELECT * FROM {$table}");
	    		// var_dump($single_result);

	    		$table_column_array = array_keys(array_unique($single_result));
	    		$table_value_array = array_values(array_unique($single_result));

	    	    // var_dump($table_column_array);
	    		// var_dump($table_value_array);

	    		$output .= "\nINSERT INTO $table("; // MAKE DYNAMIC INSERT
	    		$output .= "" .implode(", ", $table_column_array) . ") VALUES(";
	    		$output .= "'" . implode("','", $table_value_array) . "');\n";

	    		// var_dump($output); 

	    		$this->downloadFile($output);

    		}

    		// $output .= "\INSERT INTO $table("; // MAKE DYNAMIC INSERT
	    	// $output .= "" .implode(", ", $table_column_array) . ") VALUES(";
	    	// $output .= "'" . implode("','", $table_value_array) . "');\n";

	    	// var_dump($output); 

    	}
    }

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
    	flush();
    	readfile($file_name);
    	unlink($file_name);

    }
}
