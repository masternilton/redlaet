<?php

namespace App\Jobs;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SendEmailTest as SendEmailTestMail;
use Mail;



class SendEmailTest implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $users;
    public $subject;
    public $contenido;
    public $pathfile;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $subject,$contenido,$users,$pathfile)
    {
        $this->user = $user;
        $this->users = $users;
        $this->subject = $subject;
        $this->contenido = $contenido;
        $this->pathfile = $pathfile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendEmailTestMail($this->user, $this->subject,$this->contenido, $this->pathfile);
     
               $r= Mail::to($this->users)
                ->send($email);

        
    }
}
