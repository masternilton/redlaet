<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SendUsuarioRegistro as SendUsuarioRegistro;
use Mail;



class JobUsuarioRegistro implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    
    public $users;
    public $usersel;
    public $subject;
    public $clavesol;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $subject,$users,$usersel,$clavesol)
    {
       
        $this->users = $users;
        $this->usersel = $usersel;
        $this->subject = $subject;
        $this->clavesol = $clavesol;
     
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
     $email = new SendUsuarioRegistro($this->usersel, $this->subject,$this->users,$this->clavesol);

        
        $r= Mail::to($this->users)
                  ->send($email);

              

        
    }
}
