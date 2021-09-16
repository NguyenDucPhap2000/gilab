<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GetPassByEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $newpass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newpass)
    {
        $this->newpass = $newpass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.GetNewPass',['newpass',$this->newpass]);
    }
}
