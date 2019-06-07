<?php

namespace App\Mail;
use App\User;
use App\UsuariosPendientes;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUsuarioSolicitud extends Mailable
{
    use Queueable, SerializesModels;
    public $users;
    public $usersel;
    public $subject;
    public $clavesol;
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UsuariosPendientes $usersel, $subject,$users,$clavesol)
    {
        $this->users = $users;
        $this->usersel = $usersel;
        $this->subject = $subject;
        $this->clavesol = $clavesol;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject( $this->subject)
                    ->view('email.template_usuario_solicitud')->with('user',$this->usersel )
                                                              ->with('clavesol',$this->clavesol );
    }
}
