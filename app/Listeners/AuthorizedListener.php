<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Overtrue\LaravelWechat\Events\OpenPlatform\Authorized;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthorizedListener
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
     * @param  Authorized  $event
     * @return void
     */
    public function handle(Authorized $event)
    {
        //
        Log::info('公众号授权事件',[$event->message,__METHOD__]);

    }
}
