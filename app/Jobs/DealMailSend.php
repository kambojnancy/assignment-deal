<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;
use App\Mail\MailSend;
use Mail;

class DealMailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


     protected $deal;

     public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($deal)
    {
      $this->deal = $deal;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info('triggered');
        $users = User::where('id', '!=', $this->deal->user_id)->take(4)->get()->pluck('email')->all();
        Mail::to('admin@admin.com')->cc($users)->send(new MailSend($this->deal)); 
    }
}
