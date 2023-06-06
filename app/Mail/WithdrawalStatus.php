<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $withdrawal, $subject, $user;
    public $foramin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Withdrawal $withdrawal, User $user, $subject, $foramin = false)
    {
        $this->withdrawal = $withdrawal;
        $this->user = $user;
        $this->foramin = $foramin;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.withdrawal-status')->subject($this->subject);
    }
}
