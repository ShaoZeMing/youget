<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class HomeController extends Controller
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



    public function welcome()
    {
    return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['auth_url'] = 'blog.4d4k.com';
            try {
                //邮件报警
                //微信授权
                $app = app('wechat');
                $openPlatform = $app->open_platform;
                $response = $openPlatform->pre_auth->redirect(url("api/weixin/platform/target/{id}/auth"));
                // 获取跳转的 URL
                $url = $response->getTargetUrl();
                Log::info('获取预授权URL Code:', [$url]);
                $data['auth_url'] = $url;
            } catch (\Exception $e) {
                Log::error($e, [__METHOD__]);
            }
            // 你的操作.....
            return view('home',$data);
        } catch (\Exception $e) {
            sendErrorMail($e);
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
