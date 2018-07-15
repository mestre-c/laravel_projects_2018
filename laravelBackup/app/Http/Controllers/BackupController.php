<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Events\StatementPrepared; // set the fetch mode
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use League\Flysystem\Adapter\Local;
use DB;
use App\Post;
use App\User;
use App\Jobs\BackupTableJob;
use Artisan;

date_default_timezone_set('Europe/Samara');

class BackupController extends Controller
{
    // const MAX_VALUE = 100000; //kilobytes 
    const CHUNK_SIZE = 1024*1024; //size in bytes

    public function lockTable()
    {
        // lock all tables
        DB::unprepared('FLUSH TABLES WITH READ LOCK;');
    }

    public function setQueueJob(User $user, Post $post)
    {
        BackupTableJob::dispatch($user, $post)
            ->delay(Carbon::now()
            ->addSeconds(5));
        // Artisan::call('queue:work');     
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
    	$this->setPdoMode();
        $numTables = DB::select("SHOW TABLES");
        $countUserRecords = User::count();
        $countPostRecords = Post::count();
 		
        return view('backup', compact('numTables','countUserRecords', 'countPostRecords'));
    }

    public function setPdoMode()
    {
    	\Event::listen(StatementPrepared::class, function($event) {
        // $event->statement->setFetchMode(\PDO::FETCH_ASSOC);});
        $event->statement->setFetchMode(\PDO::FETCH_BOTH);});
    }

    // public function backup(Request $request, User $user, Post $post)
    public function backup(Request $request, User $user, Post $post)
    {
        // $this->setQueueJob($user, $post);          
    	if ($request->all()) {
    		$tables = request('table');
    		$output = '';     
        	foreach ($tables as $key => $table) {  
                $this->lockTable();
                $show_table_query = $this->queryFetch("SHOW CREATE TABLE {$table}");
                // $this->setPdoMode();
                // $show_table_query = DB::select("SHOW CREATE TABLE {$table}");
                // $output .="\n" . $show_table_query[0][1] . ";\n";
    			$output .="\n" . $show_table_query[1] . ";\n";
        		// $single_result = DB::select("SELECT * FROM {$table}");
                $single_result = $this->chunkData($table);
                $output .= $this->getTableData($single_result, $table);
                $output .= $this->cacheData($table, $output); 
            }

            // $this->download($output);
            $this->downloadFile($output);
            return redirect()->route('create');                  
	    }             
            // return redirect()->route('create'); 
            // return redirect()->route('backupError'); 
    }

    // Stores the file in this location: storage/app
    public function download($output)
    {
        $dt = Carbon::now();
        $file_name = 'backup_on[' . $dt->format('y-m-d H-i-s') . '].sql';
        $local_disk = Storage::disk('local');
        if (!$local_disk->exists($file_name)) {
            $output = $this->readFileChunked($file_name, $output); // chunk a file
            // $output = $this->readTheFile($file_name, $output); // chunk a file
            $local_disk->put($file_name, $output); // store file
            \Log::info($this->formatBytes(memory_get_peak_usage()));
        }
    }
    // download file into storage/app
    public function downloadFile($output)
    {
      $dt = Carbon::now();
      $file_name = 'backup_on[' . $dt->format('y-m-d H-i-s') . '].sql';
      $local_disk = Storage::disk('local');

      if (!$local_disk->exists($file_name)) {
          $file_handle = fopen($file_name, 'w+'); // Open for reading and writing
          fwrite($file_handle, $output);// write to a file
          $local_disk->put($file_name, $output);
          fclose($file_handle);
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename=' . basename($file_name));
          header('Content-Transfer-Encoding: binary'); 
          header("Expires: 0");
          ob_clean(); // clean the output buffer
          flush(); // flush the system output buffer
          $this->readFileChunked($file_name); // output a file
          // readfile($file_name); // output a file
          unlink($file_name); // remove SQL files which is generated in folder
          \Log::info($this->formatBytes(memory_get_peak_usage()));  
      }
          return redirect()->route('backup');    
    }

    public function getTableData($single_result, $table) 
    {
        $this->unlockTable();
        $output = '';
        foreach ($single_result as $key => $table_val) {
            // if ($table === "posts" || $table === "users") {
                $output .= "\nINSERT INTO $table("; 
                $output .= "" .addslashes(implode(", ", array_keys($table_val))) . ") VALUES(";
                $output .= "'" . addslashes(implode("','", array_values($table_val))) . "');\n";
            // }  
        }  
        return $output;
    }

    public function cacheData($table, $data)
    {
        $start = microtime(true);
        $data = Cache::remember('table', 10, function() use ($table){
            return DB::table($table)->get();
        });
        $duration = (microtime(true) -$start) * 1000;

        \Log::info("From cache: " . $duration .' ms');
        return $data;
    }

    public function chunkData($table)
    {
        $result;
        $table = 'App\\' . ucwords(rtrim($table,'s')); 
        $table::chunk(200, function($models) use (&$result) {
        foreach ($models as $model) {
            $result[] = $model->toArray();
                   // var_dump($result);
        }});                  
             return $result;      
    }

    // chunk file
    public function readFileChunked($filename, $retbytes = TRUE)
    {
        $buffer = "";
        $cnt =0;
        $handle = fopen($filename, "rb");
        // $handle = fopen($filename, "w+");
        if ($handle === false) {
            return false;
        }
        // fwrite($handle, $output);
        while (!feof($handle)) {
            $buffer = fread($handle, self::CHUNK_SIZE);
            echo $buffer;
            ob_flush();
            flush();
            if ($retbytes) {
                $cnt += strlen($buffer);
            }
        }
        $status = fclose($handle);
        if ($retbytes === $status) {
            return $cnt; // return num. bytes delivered like readfile() does.
        }
            return $status;
        // fclose($handle);
        \Log::info($this->formatBytes(memory_get_peak_usage()));
        // return $output;
    }

    function formatBytes($bytes, $precision = 2) 
    {
        $units = ["b", "kb", "mb", "gb", "tb"];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . " " . $units[$pow];
    }

    // Use generators
    public function readTheFile($file)
    {
        $handle = fopen($file, "rb");
        // $handle = fopen($file, "w+b");
        if ($handle === false) {
            return false;
        }
        fwrite($handle, $output);
        while(!feof($handle)) {
            yield trim(fgets($handle));
        }
        fclose($handle);
        // return $output;
    }

    

}
