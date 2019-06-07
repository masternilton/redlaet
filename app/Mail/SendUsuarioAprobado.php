<?php

namespace App\Mail;
use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUsuarioAprobado extends Mailable
{
    use Queueable, SerializesModels;
    public $usersel;
    public $subject;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usersel, $subject,$password)
    {
        $this->usersel = $usersel;
        $this->subject = $subject;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject( $this->subject)
                    ->view('email.template_usuario_aprobado')->with('user',$this->usersel )
                                                             ->with('password',$this->password );
    }
}
