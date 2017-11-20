<?php

namespace App\Http\Controllers\V1;

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


    public function push()
    {


        echo "发送push 中....";
        try {
            Log::info('testPush', [__METHOD__]);
            $deviceId = 'b2e5b64931f06f617e363b74c8057cf6';
//            $deviceId = '160a3797c8310b57df9';
//            $deviceId = [
//                'ea34a4715b08b1b8d77aabf36c977cba',
//                'ea34a4715b08b1b8d77aabf36c977cba',
//            ];
            $title = '点击查看\(^o^)/~';
            $content = '23232323fdf';

            $title = request()->get('title', $title);
            $content = request()->get('content', $content);
//            $deviceId = request()->get('device_id', $deviceId);

            $data = [
                'url' => 'http://test.4d4k.com/push',
                'type' => 5,
                'title' => $title,
                'content' => $content,
                'id' => '3a92y3GR1neZ',
                'merchant_name' => '米粒科技',
                'big_cat' => '电视机',
                'full_address' => '北京市海淀区五道口清华大学',
                'price' => 36,
                'urgent_fee' => 20,
                'order_type' => 0,
                'order_type_txt' => '保内',
            ];


            $push = app('PushManager')->driver();
            $getuiResponse = $push->push($deviceId, $data);

            $res = json_encode($getuiResponse);
            echo '<br>';
            echo $res;
            Log::info($res, [__METHOD__]);
        } catch (\Exception $e) {
            echo "Error : 错误" . $e->getMessage();
        }

    }
}
