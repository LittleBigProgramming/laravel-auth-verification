<?php

namespace App\Listeners\Auth;

use App\Events\Auth\ActivationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendActivationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActivationEmail  $event
     * @return void
     */
    public function handle(ActivationEmail $event)
    {
        if ($event->user->is_active) {
            return;
        }

        Mail::to($event->user->email)->send(new \App\Mail\Auth\ActivationEmail($event->user));
    }
}
