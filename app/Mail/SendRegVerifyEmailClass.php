<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegVerifyEmailClass extends Mailable
{
    use Queueable, SerializesModels;

    protected $userData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userData)
    {
        $this -> userData = $userData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this -> subject('[voi.im]新注册用户邮箱激活');
        return $this->view('Email.regEmail',[
            'title' => $this -> userData['title'],
            'username' => $this -> userData['username'],
            'verifyUrl' => asset('/verifyEmail').'/'.$this -> userData['verifyUrl'],
            'sendTime' => Carbon::now(),
        ]);
    }
}
