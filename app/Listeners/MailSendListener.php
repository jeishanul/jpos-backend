<?php

namespace App\Listeners;

use App\Events\MailSendEvent;
use App\Mail\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailSendListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MailSendEvent $event): void
    {
        Mail::to($event->email)->send(new SendMail($event->email, $event->token));
    }
}
