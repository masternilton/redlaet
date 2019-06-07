<?php

namespace App\Mail;
use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailNoticia extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $subject;
    public $noticia;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $subject,$noticia)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->noticia = $noticia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

 
        return $this->subject( $this->subject)
                    ->view('email.template_noticia')
                    ->with('user',$this->user )
                    ->with('datos',$this->noticia );
    }
}
