<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendRegVerifyEmailClass;
use Mail;

class SendVerifyEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userToEmail)
    {
        $this -> userData = $userToEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail ::to( $this -> userData['email'] ) -> send(new SendRegVerifyEmailClass($this -> userData ));
    }
}
