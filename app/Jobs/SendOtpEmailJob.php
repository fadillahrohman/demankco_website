<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOtpEmailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $email;
    public $token;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $token
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.verify-otp', ['token' => $this->token], function ($message) {
            $message->to($this->email)->subject('Verifikasi Email - Kode OTP');
        });
    }
}
