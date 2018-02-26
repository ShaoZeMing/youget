<?php

return [
    /*
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug'  => true,

    /*
     * 使用 Laravel 的缓存系统
     */
    'use_laravel_cache' => true,

//    /*
//     * 账号基本信息，请从微信公众平台/开放平台获取
//     */
//    'app_id'  => env('WECHAT_APPID', 'wxfb55ae0afdc9a269'),         // AppID
//    'secret'  => env('WECHAT_SECRET', 'c089b366f5eb8e970f7b2f28cc65a2bd'),     // AppSecret
//    'token'   => env('WECHAT_TOKEN', 'xZfV1M9Q9Vx1kjqD'),          // Token
//    'aes_key' => env('WECHAT_AES_KEY', 'f0tsQwDCNvTl0nejemVEUcLR7p0FkIUMR0i5ytxzcor'),                    // EncodingAESKey
//    'url' => env('WECHAT_URL', 'https://api.weixin.qq.com/'),                    // EncodingAESKey

    /*
     * 微信测试号，请从微信公众平台/开放平台获取
     */
    'app_id'  => env('WECHAT_APPID', 'wx82127081471bb2ad'),         // AppID
    'secret'  => env('WECHAT_SECRET', '3acc4259d54577ecddd33d06b36b6780'),     // AppSecret
    'token'   => env('WECHAT_TOKEN', 'xZfV1M9Q9Vx1kjqD'),          // Token
    'aes_key' => env('WECHAT_AES_KEY', 'f0tsQwDCNvTl0nejemVEUcLR7p0FkIUMR0i5ytxzcor'),                    // EncodingAESKey
    'url' => env('WECHAT_URL', 'https://api.weixin.qq.com/'),                    // EncodingAESKey

    /**
     * 开放平台第三方平台配置信息
     */
     'open_platform' => [
         'app_id'  => env('WECHAT_OPEN_PLATFORM_APPID', 'wx060eed678e52387a'),
         'secret'  => env('WECHAT_OPEN_PLATFORM_SECRET', ''),
         'token'   => env('WECHAT_OPEN_PLATFORM_TOKEN', 'xZfV1M9Q9Vx1kjqD'),
         'aes_key' => env('WECHAT_OPEN_PLATFORM_AES_KEY', 'f0tsQwDCNvTl0nejemVEUcLR7p0FkIUMR0i5ytxzcor'),
     ],

    /**
     * 小程序配置信息
     */
    // 'mini_program' => [
    //     'app_id'  => env('WECHAT_MINI_PROGRAM_APPID', ''),
    //     'secret'  => env('WECHAT_MINI_PROGRAM_SECRET', ''),
    //     'token'   => env('WECHAT_MINI_PROGRAM_TOKEN', ''),
    //     'aes_key' => env('WECHAT_MINI_PROGRAM_AES_KEY', ''),
    // ],

    /**
     * 路由配置
     */
    'route' => [
        'enabled' => true,         // 是否开启路由
        'attributes' => [           // 路由 group 参数
            'prefix' => null,
            'middleware' => null,
            'as' => 'easywechat::',
        ],
        'open_platform_serve_url' => 'http://test.4d4k.com/api/weixin/platform/auth', // 开放平台服务URL
    ],

    /*
     * 日志配置
     *
     * level: 日志级别，可选为：
     *                 debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => env('WECHAT_LOG_LEVEL', 'debug'),
        'file'  => env('WECHAT_LOG_FILE', storage_path('logs/wechat.log')),
    ],

    /*
     * OAuth 配置
     *
     * only_wechat_browser: 只在微信浏览器跳转
     * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
     * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
     */
     'oauth' => [
         'only_wechat_browser' => false,
         'scopes'   => array_map('trim', explode(',', env('WECHAT_OAUTH_SCOPES', 'snsapi_userinfo'))),
         'callback' => env('WECHAT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
     ],

    /*
     * 微信支付
     */
     'payment' => [
         'merchant_id'        => env('WECHAT_PAYMENT_MERCHANT_ID', 'your-mch-id'),
         'key'                => env('WECHAT_PAYMENT_KEY', 'key-for-signature'),
         'cert_path'          => env('WECHAT_PAYMENT_CERT_PATH', 'path/to/your/cert.pem'), // XXX: 绝对路径！！！！
         'key_path'           => env('WECHAT_PAYMENT_KEY_PATH', 'path/to/your/key'),      // XXX: 绝对路径！！！！
         // 'device_info'     => env('WECHAT_PAYMENT_DEVICE_INFO', ''),
         // 'sub_app_id'      => env('WECHAT_PAYMENT_SUB_APP_ID', ''),
         // 'sub_merchant_id' => env('WECHAT_PAYMENT_SUB_MERCHANT_ID', ''),
         // ...
     ],

    /*
     * 开发模式下的免授权模拟授权用户资料
     *
     * 当 enable_mock 为 true 则会启用模拟微信授权，用于开发时使用，开发完成请删除或者改为 false 即可
     */
    'enable_mock' => env('WECHAT_ENABLE_MOCK', false),
    'mock_user' => [
        'openid' => 'odh7zsgI75iT8FRh0fGlSojc9PWM',
        // 以下字段为 scope 为 snsapi_userinfo 时需要
        'nickname' => 'overtrue',
        'sex' => '1',
        'province' => '北京',
        'city' => '北京',
        'country' => '中国',
        'headimgurl' => 'http://wx.qlogo.cn/mmopen/C2rEUskXQiblFYMUl9O0G05Q6pKibg7V1WpHX6CIQaic824apriabJw4r6EWxziaSt5BATrlbx1GVzwW2qjUCqtYpDvIJLjKgP1ug/0',
    ],
];
