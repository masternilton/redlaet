<?php

namespace App\Mail;
use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailTest extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $subject;
    public $contenido;
     public $mifile;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $subject,$contenido, $mifile)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->contenido = $contenido;
        $this->mifile= $mifile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if( $this->mifile!="0"){
             return $this->subject( $this->subject)
                    ->attach( $this->mifile)
                    ->view('email.template')->with('contenido',$this->contenido );
        }
        else
        {
            return $this->subject( $this->subject)
                    ->view('email.template')->with('contenido',$this->contenido );

        }


       
    }
}
