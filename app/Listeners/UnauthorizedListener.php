<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Overtrue\LaravelWechat\Events\OpenPlatform\Unauthorized;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UnauthorizedListener
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
     * @param  Unauthorized  $event
     * @return void
     */
    public function handle(Unauthorized $event)
    {
        //
        Log::info('授权事件',[$event->message,__METHOD__]);

    }
}
