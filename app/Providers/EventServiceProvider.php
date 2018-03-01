<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'App\Events\Event' => [
//            'App\Listeners\EventListener',
//        ],
        'App\Events\WeixinMsgEvent' => [
            'App\Listeners\WeixinMsgListener',
        ],
        //OAuth 网页授权
        'Overtrue\LaravelWechat\Events\WeChatUserAuthorized' => [
            'App\Listeners\WeChatUserAuthorizedListener',
        ],
        //开放平台授权成功
        'Overtrue\LaravelWechat\Events\OpenPlatform\Authorized' => [
            'App\Listeners\AuthorizedListener',
        ],
        //平台更新授权
        'Overtrue\LaravelWechat\Events\OpenPlatform\UpdateAuthorized' => [
            'App\Listeners\UpdateAuthorizedListener',
        ],
        //开放平台取消授权
        'Overtrue\LaravelWechat\Events\OpenPlatform\Unauthorized' => [
            'App\Listeners\UnauthorizedListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
