<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ResendOtpEmailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;


    public $email;
    public $newToken;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $newToken
     */

    public function __construct($email, $newToken)
    {
        $this->email = $email;
        $this->token = $newToken;
    }


    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {

        Mail::send('emails.verify-otp', ['token' => $this->newToken], function ($message) {
            $message->to($this->email)->subject('Verifikasi Email - Kode OTP');
        });
    }
}
