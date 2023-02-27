<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;


//make the  VerifyEmail notification queueable
class VerifyEmailQueued extends VerifyEmail implements ShouldQueue
{
    use Queueable;
}
