<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendingEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $event->user;
        $event->unhashedPassword;
        Log::info("email successfully sent to user : {$event->user->name}");
        // here we sent an email with unhashed password to login and change it
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\UserCreated  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(UserCreated $event, $exception)
    {
        Log::error("user : {$event->user->id} , not recieve an email because of  {$exception->getMessage()}");
    }
}
