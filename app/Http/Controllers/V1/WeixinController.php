<?php

namespace App\Http\Controllers\V1;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Shaozeming\Push\PushManager;
use App\Http\Controllers\Controller;


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


       $key =  ApiService::getAccKey();

       return $key;

        $data = $request->all();
        $echostr = $request->get('echostr');
        $signature = $request->get('signature');
        $timestamp = $request->get('timestamp');
        $nonce = $request->get('nonce');
        $token = 'xZfV1M9Q9Vx1kjqD';

        $tmpArr = [$token,$timestamp, $nonce];
        sort($tmpArr, SORT_STRING);
        $tmpStr1 = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr1 );
        $context = [
            'f' => __METHOD__,
            'data' => $data,
            '$tmpArr' => $tmpArr,
            '$tmpStr' => $tmpStr,
            '$tmpStr1' => $tmpStr1,
        ];
        Log::info('请求参数',$context);


        if( $signature ==$tmpStr){
            Log::info('效验成功',['$signature'=> $signature ,'$tmpStr'=> $tmpStr]);
            return $echostr;

        }else{
            Log::info('效验失败',['$signature'=> $signature ,'$tmpStr'=> $tmpStr]);

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
        $app->server->push(function($message){
            return "欢迎关注 overtrue！";
        });

        return $app->server->serve();
    }
}
