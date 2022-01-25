<?php

namespace App\Http\Service;

use App\Mail\newMessage;
use App\Models\Message;
use App\Models\Talk;
use Illuminate\Support\Facades\Mail;

class MailService
{
    /**
     * prepare data and send mail for notice about new message in talk
     */
    public static function sendNewMessageMail(Message $message, Talk $talk) : void
    {
        $users = self::getAllReceiver($talk);
        Mail::bcc($users)->send(new newMessage($message, $talk));
    }

    /**
     * collect list of user who write inside talk
     * @param Talk $talk
     * @return array
     */
    private static function getAllReceiver(Talk $talk) : array
    {
        $users = [];
        foreach ($talk->messages as $message)
        {
            $users[] = $message->author->email;
        }
        return $users;
    }
}