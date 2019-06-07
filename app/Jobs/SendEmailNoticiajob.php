<?php

namespace App\Jobs;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SendEmailNoticia as SendEmailTestMail;
use Mail;



class SendEmailNoticiajob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $users;
    public $subject;
    public $contenido;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $subject,$contenido,$users)
    {
        $this->user = $user;
        $this->users = $users;
        $this->subject = $subject;
        $this->contenido = $contenido;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendEmailTestMail($this->user, $this->subject,$this->contenido);

        $r= Mail::to($this->users)
                ->send($email);

        
    }
}
