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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('phone/code', 'ApiController@sendVerifyCode');


Route::group([
    'middleware' => ['web', 'wechat.oauth']],
    function () {
    Route::get('weixin/user', function () {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($user);
    });
});

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



    Route::any('weixin', 'WeixinController@index'); //微信
    Route::any('weixin/platform/{$id}', 'WeixinController@platform'); //微信
    Route::any('weixin/platform', 'WeixinController@platformAuth');//微信
    Route::any('weixin/menu/create', 'WeixinController@createMenu'); //创建微信菜单
    Route::get('weixin/token', 'WeixinController@getAccessToken'); //微信
    Route::get('weixin/orders/create', 'WeixinController@orderCreate'); //微信
    Route::any('weixin/notice', 'WeixinController@sendNotice'); //模板消息
});

