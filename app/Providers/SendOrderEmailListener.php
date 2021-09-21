<?php

namespace App\Providers;

use App\Mail\OrderShippedMail;
use App\Providers\OrderPlacedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MongoDB\Driver\Session;

class SendOrderEmailListener
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
     * @param  OrderPlacedEvent  $event
     * @return void
     */
    public function handle(OrderPlacedEvent $event)
    {
        Log::info('Handle EVENT');

        Mail::to($event->eventData['user_email'])->send(new OrderShippedMail($event->eventData['invoice']));
    }
}
