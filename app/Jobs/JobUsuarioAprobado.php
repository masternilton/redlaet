<?php

namespace App\Jobs;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SendUsuarioAprobado as SendUsuarioAprobado;
use Mail;



class JobUsuarioAprobado implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $useremail;
    public $subject;
    public $password;
    public $usuario;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $subject,$password,$useremail,$usuario)
    {
        $this->usuario = $usuario;
        $this->useremail = $useremail;
        $this->subject = $subject;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendUsuarioAprobado($this->usuario, $this->subject,$this->password);

        $r= Mail::to($this->useremail)
                  ->send($email);

        
    }
}
