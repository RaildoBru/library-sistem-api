<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class SendEmailJob implements ShouldQueue
{
    use Queueable;

    public $loanInfo;

    public function __construct($loanInfo)
    {
        $this->loanInfo = $loanInfo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Log::info("E-mail enviado para");
        //Mail::to($this->loanInfo['email'])->send(new SendEmail($this->loanInfo));
    }
}
