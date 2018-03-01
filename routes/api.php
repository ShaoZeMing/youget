<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('phone/code', 'ApiController@sendVerifyCode');




Route::group([
//    'middleware' => 'signature',
    'namespace' => 'V1',
//    'prefix'     => 'api',
], function ($app) {
    Route::any('pay/notify/wx', 'PayController@notify'); //支付回调
    Route::get('pay', 'PayController@index'); //支付宝app支付

    //支付宝支付
    Route::get('alipay/app', 'PayController@aliAppPay'); //支付宝app支付
    Route::get('alipay/qj', 'PayController@aliQrPay'); //支付宝扫描支付
    Route::get('alipay/web', 'PayController@aliWebPay'); //支付宝网页支付
    Route::get('alipay/wap', 'PayController@aliWapPay'); //支付宝手机网页支付
    Route::get('alipay/bar', 'PayController@aliBarPay'); //支付宝条码支付
    Route::get('alipay/charge', 'PayController@getPayCharge'); //支付宝查询订单

    //微信支付
    Route::get('weixin/app', 'PayController@wxAppPay'); //支付宝app支付
    Route::get('weixin/qj', 'PayController@wxQrPay'); //支付宝扫描支付
    Route::get('weixin/pub', 'PayController@wxPubPay'); //支付宝扫描支付




    Route::any('weixin/mp/server', 'WeixinController@server'); //单版本公众号微信接收事件接口
    Route::get('weixin/mp/menu/create', 'WeixinController@createMenu'); //创建微信菜单

    Route::group([
        'middleware' => ['web', 'wechat.oauth']],
        function () {
            Route::get('weixin/mp/user', 'WeixinController@user');
        });

    Route::any('weixin/platform/server/{id}', 'WeixinPlatformController@server'); //第三方平台微信事件接收接口
//    Route::any('weixin/platform/auth', 'WeixinPlatformController@auth'); //第三方平台微信公众号授权后接收接口
    Route::any('weixin/platform/target/{id}/auth', 'WeixinPlatformController@targetAuth'); //第三方平台微信公众号授权后接收接口
    Route::get('weixin/token', 'WeixinPlatformController@getAccessToken'); //微信
    Route::get('weixin/orders/create', 'WeixinPlatformController@orderCreate'); //微信
    Route::any('weixin/notice', 'WeixinPlatformController@sendNotice'); //模板消息


});

