<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emaildata;
    /**
     * Create a new job instance.
     */
    public function __construct($emaildata)
    {
        $this->emaildata = $emaildata;
        // dd($emaildata);
        Mail::send('emails.test', $emaildata, function ($message) {
            $message->to($this->emaildata['email'])->subject('Laravel HTML Testing Mail');
            $message->from('xyz@gmail.com');
        });
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
