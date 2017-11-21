<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;

//use Liyu\Signature\Facade\Signature;

/**
 *  OrderBillingService.php
 *
 * @author gengzhiguo@xiongmaojinfu.com
 * $Id: OrderBillingService.php 2017-03-23 下午1:48 $
 */
class ApiService
{
    public static function request($url, $data, $method = 'get')
    {
//        $data['timestamp'] = time();
//        $data['app_id'] = $appId;

//        $secretKey = config('signature.sign_key.' . $appId);
//        $sign = Signature::signer('hmac')
//                         ->setAlgo('sha256')
//                         ->setKey($secretKey)
//                         ->sign($data);
//        $data['sign'] = $sign;

        $response = Curl::to($url)->withData($data)->$method();

        return $response;
    }

//    public static function verify($sign, $data, $appId)
//    {
//        if (!$sign) {
//            return false;
//        }
//
//        $secretKey = config('signature.sign_key.' . $appId);
//        if (!$secretKey) {
//            return false;
//        }
//        return Signature::setAlgo('sha256')
//                        ->setKey($secretKey)
//                        ->verify($sign, $data);
//    }


    public static function getAccessToken()
    {

        $appId = config('wechat.app_id');
        $secret = config('wechat.secret');
        $token = config('wechat.token');
        $aesKey = config('wechat.aes_key');
        $url = rtrim(config('wechat.url'), '/') . '/cgi-bin/token';

        $data = [
            'grant_type' => 'client_credential',
            'appid' => $appId,
            'secret' => $secret,
        ];

        $minutes = 110; //缓存分钟数
        $accessToken = Cache::remember('access_token', $minutes, function () use ($url, $data) {
            $response = Curl::to($url)->withData($data)->get();
            Log::info('获取接口结果', [$response, __METHOD__]);
            $response = is_object($response) ? $response : json_decode($response);
            if (!isset($response->errcode)) {
                return $response->access_token;
            }else{
                Log::error($response,[__METHOD__]);
            }
        });
        return $accessToken;
    }
}
