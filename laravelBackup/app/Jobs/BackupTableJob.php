<?php

namespace App\Jobs;

use App\User;
use App\Post;
use App\Http\Controllers\BackupController;
use Illuminate\Http\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class BackupTableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post)
    // public function __construct()
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // //
        // $bup = new BackupController;
        // $bup->backup($request, $this->user, $this->post);
    }
}
