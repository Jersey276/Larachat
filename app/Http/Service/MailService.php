<?php

namespace App\Http\Service;

use App\Mail\newMessage;
use App\Models\Message;
use App\Models\Talk;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function sendNewMessageMail(Message $message, Talk $talk)
    {
        $users = self::getAllReceiver($talk);
        Mail::bcc($users)->send(new newMessage($message, $talk));
    }


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