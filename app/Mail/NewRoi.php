<?php

namespace App\Mail;

use App\Models\Tp_Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRoi extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new message instance.
     *
     * @var Demo
     */
    public $plan, $amount, $plandate, $user, $subject;

    public function __construct(User $user, $plan, $amount, $plandate, $subject)
    {
        $this->plan = $plan;
        $this->user = $user;
        $this->subject = $subject;
        $this->amount = $amount;
        $this->plandate = $plandate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newroi')->subject($this->subject);
    }
}
