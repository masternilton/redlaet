<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;
    public $contenido;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $subject,$contenido)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->contenido = $contenido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject( $this->subject)
                    ->view('email.template')->with('contenido',$this->contenido );
    }
}
