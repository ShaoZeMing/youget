<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;


class WeixinController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        Log::info('获取请求数据',[$request,__METHOD__]);
        $data = $request->all();
        $echostr = $request->get('echostr');
        $signature = $request->get('signature');
        $timestamp = $request->get('timestamp');
        $nonce = $request->get('nonce');
        $token = config('wechat.token');

        $tmpArr = [$token, $timestamp, $nonce];
        sort($tmpArr, SORT_STRING);
        $tmpStr1 = implode($tmpArr);
        $tmpStr = sha1($tmpStr1);
        $context = [
            'f' => __METHOD__,
            'data' => $data,
            '$tmpArr' => $tmpArr,
            '$tmpStr' => $tmpStr,
            '$tmpStr1' => $tmpStr1,
        ];
        Log::info('请求参数', $context);


        if ($signature == $tmpStr) {
            Log::info('效验成功', ['$signature' => $signature, '$tmpStr' => $tmpStr]);
            return $echostr;

        } else {
            Log::info('效验失败', ['$signature' => $signature, '$tmpStr' => $tmpStr]);

            return response()->json([
                'code' => 121,
                'msg' => '调用失败',
                'data' => $data,
                'Token' => 'xZfV1M9Q9Vx1kjqD',
                'echostr' => $echostr,
            ]);
        }

    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function ($message) {
            return "欢迎关注 overtrue！";
        });

        return $app->server->serve();
    }


    //创建微信自定义菜单
    public function createMenu(Request $request)
    {

        $context = [
            'request' => $request->all(),
            'method' => __METHOD__,
        ];

        try {$jsonmenu = '{
    "button": [
        {
            "name": "我的博客", 
            "sub_button": [
                {
                    "type": "view", 
                    "name": "linux", 
                    "url": "http://blog.4d4k.com/category/linux/"
                }, 
                {
                    "type": "view", 
                    "name": "PHP", 
                    "url": "http://blog.4d4k.com/category/php/"
                }, 
                {
                    "type": "view", 
                    "name": "SQL", 
                    "url": "http://blog.4d4k.com/category/sql/"
                }
            ]
        }, 
        {
            "name": "扫一扫", 
            "sub_button": [
                {
                    "type": "scancode_waitmsg", 
                    "name": "扫码带提示", 
                    "key": "sao_ma_ti_shi", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "scancode_push", 
                    "name": "扫码推事件", 
                    "key": "sao_ma_tui", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "click", 
                    "name": "今日歌曲", 
                    "key": "V1001_TODAY_MUSIC"
                }
            ]
        }, 
        {
            "name": "发图", 
            "sub_button": [
                {
                    "type": "pic_sysphoto", 
                    "name": "拍照发图", 
                    "key": "pai_zhao", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "pic_photo_or_album", 
                    "name": "拍照or相册", 
                    "key": "pai_zhao_or_photos", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "pic_weixin", 
                    "name": "微信相册发图", 
                    "key": "wixin_photos"
                }, 
                {
                    "type": "location_select", 
                    "name": "发送位置", 
                    "key": "address"
                }
            ]
        }
    ]
}';

            $accessToken = ApiService::getAccessToken();

            $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$accessToken;
            $result = $this->https_request($url, $jsonmenu);
            var_dump($result);


        } catch (\Exception $e) {
            Log::info($e, $context);
        }
    }





    //https
    function https_request($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }



    //获取
    public function getAccessToken()
    {

        $key = ApiService::getAccessToken();

        return $key;
    }

}
