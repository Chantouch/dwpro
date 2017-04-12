<?php

namespace App\Mail;

use App\Models\Apply;
use App\Models\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyJob extends Mailable
{
    use Queueable, SerializesModels;
    private $user;

    /**
     * Create a new message instance.
     *
     * @param Apply $user
     */
    public function __construct(Apply $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.applied.cv');
    }
}
