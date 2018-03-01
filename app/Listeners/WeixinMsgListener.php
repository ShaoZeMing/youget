<?php

namespace App\Listeners;

use App\Events\WeixinMsgEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeixinMsgListener
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
     * @param  WeixinMsgEvent  $event
     * @return void
     */
    public function handle(WeixinMsgEvent $event)
    {
        //
        \Log::info('555555555555555555555555',[$event->msg,__METHOD__]);

    }
}
