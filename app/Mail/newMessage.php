<?php

namespace App\Mail;

use App\Models\Message as ModelMessage;
use App\Models\Talk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newMessage extends Mailable
{
    use Queueable, SerializesModels;

    public Talk $talk;

    public ModelMessage $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ModelMessage $message, Talk $talk)
    {
        $this->message = $message;
        $this->talk = $talk;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new-message')->with(['newMessage' => $this->message, 'talk' => $this->talk]);
    }
}
