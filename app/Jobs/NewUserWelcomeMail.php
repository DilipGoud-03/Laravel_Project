<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewUserWelcomeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $request;
    private $testMailData;
    /**
     * Create a new job instance.
     */
    public function __construct($request, $testMailData)
    {
        $this->request = $request;
        $this->testMailData = $testMailData;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->request)->send(new SendMail(
            $this->testMailData
        ));
    }
}
