<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecieveMail;

class RecieveMailFromUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $recieveMailData;
    private $request;
    /**
     * Create a new job instance.
     */
    public function __construct($request, $recieveMailData)
    {
        $this->request = $request;
        $this->recieveMailData = $recieveMailData;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->request)->send(new RecieveMail(
            $this->recieveMailData
        ));
    }
}
