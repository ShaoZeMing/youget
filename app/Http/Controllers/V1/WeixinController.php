<?php

namespace App\Http\Controllers\V1;

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
    public function index()
    {

        return response()->json([
            'code' => 0,
            'msg' => '调用成功',
            'data' => ['数据1','数据2'],
        ]);

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
