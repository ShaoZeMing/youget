<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use EasyWeChat\Core\Exceptions\HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function server(Request $request)
    {
        Log::info('获取请求数据weixin', [$request, __METHOD__]);
        $app = app('wechat')->server;
        $msgArr = $app->getMessage();
        Log::info('请求message', $msgArr);
        $app->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    return '收到事件消息1';
                    break;
                case 'text':
                    return '收到文字消息1';
                    break;
                case 'image':
                    return '收到图片消息1';
                    break;
                case 'voice':
                    return '收到语音消息1';
                    break;
                case 'video':
                    return '收到视频消息1';
                    break;
                case 'location':
                    return '收到坐标消息1';
                    break;
                case 'link':
                    return '收到链接消息1';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息1';
                    break;
            }
        });

        return $app->serve();

    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function index(Request $request)
    {

        Log::info('获取请求数据weixin', [$request, __METHOD__]);

        $app = app('wechat')->server;
        $msgArr = $app->getMessage();
        Log::info('请求message', $msgArr);

        $app->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });

        return $app->serve();
    }




    //创建微信自定义菜单
    public function createMenu(Request $request)
    {

        $context = [
            'request' => $request->all(),
            'method' => __METHOD__,
        ];

        try {
            $buttons = [
                [
                    "type" => "view",
                    "name" => "在线下单",
                    "url" => "https://bm.dxlsd.com.cn/api/v1/weixin/orders/123/index"
                ],
                [
                    "name" => "最新活动",
                    "sub_button" => [
                        [
                            "type" => "view",
                            "name" => "获取当前用户",
                            "url" => "http://test.4d4k.com/api/weixin/mp/user/"
                        ],
                        [
                            "type" => "view",
                            "name" => "视频",
                            "url" => "http://v.qq.com/"
                        ],
                        [
                            "type" => "click",
                            "name" => "赞一下我们",
                            "key" => "V1001_GOOD"
                        ],
                    ]

                ],
                [
                    "type" => "click",
                    "name" => "我的订单",
                    "key" => "my_orders"
                ],
            ];

            $app = app('wechat');
            $xx = $app->menu->add($buttons);

            return 111111;
        } catch (\Exception $e) {
            Log::info($e, $context);
        }
    }


    //获取
    public function user()
    {

        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($user);
    }

    //获取
    public function getAccessToken()
    {

        $key = ApiService::getAccessToken();

        return $key;
    }


    //指定行业
    public function setIndustry()
    {

        $key = ApiService::getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=" . $key;
        $data = '  {
          "industry_id1":"1",
          "industry_id2":"2"
       }';
        $result = $this->https_request($url, $data);
        var_dump($result);
    }

    //查看指定行业
    public function getIndustry()
    {
        $key = ApiService::getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=" . $key;
        $result = $this->https_request($url);
        var_dump($result);
    }


    public function orderCreate()
    {
        return view('weixin.order_create');
    }


    public function sendNotice()
    {

        try {
            $app = app('wechat');
            $notice = $app->notice;
//        $templateId = $notice->addTemplate("TM00002");
//        Log::info('创建模板ID',[$templateId,__METHOD__]);
            $templateArr = $notice->getPrivateTemplates();
            Log::info('模板列表', [$templateArr, __METHOD__]);
//        $messageId = $notice->send([
//            'touser' => 'oYzfov2raQuxOG0S_Mv4eoX69Cps',
////            'template_id' => $templateId,
//            'url' => 'http://shouhou.yipinxiaobai.com/api/v1/weixin/orders/536969186711176198/show',
//            'data' => [
//                "first"    => array("下单成功！", '#555555'),
//                "keyword1" => array("171201100201302634", "#FF0000"),
//                "keyword2" => array("2017-12-04", "#888888"),
//        ],
//        ]);
//        Log::info('模板消息ID',[$messageId,__METHOD__]);
            $messageId = $notice->send([
                'touser' => 'oYzfov2raQuxOG0S_Mv4eoX69Cps',
//            'template_id' => 'E5FVz2OunMtIp9aEje3bF3n9dpZSX_McBuv2rGVTMbM',
                'template_id' => 'xcdVz2OunMtIp9aEje3bF3n9dpZSX_McBuv2rGVTMbM',
                'url' => 'http://test.4d4k.com/api/weixin/mp/user',
                'data' => [
                    "title" => array("下单成功！"),
                    "desc" => array("已安排工程师上门"),
                    "order_no" => array("171130103701752935"),
                    "service_mode" => array("上门"),
                    "worker_name" => array("国强师傅-18513117316"),
                    "booked_at" => array("2017-11-30 12:00:00"),
                    "remark" => array('工程师：国强师傅-18513117316 ""请保持电话畅通，等待上门。'),
                ],
            ]);
            Log::info('模板消息ID', [$messageId, __METHOD__]);
            return '模板消息发送成功';
        } catch (HttpException $e) {
            Log::error($e, [__METHOD__]);
            echo "nidaye";
            return $e->getMessage() . ',code:' . $e->getCode();
        }

    }


    public function createNotice()
    {
        $notice = "	{{ title.DATA }}\n {{ desc.DATA }}\n 工单号：{{ order_no.DATA }}\n 服务方式：{{ service_mode.DATA }}";

        $app = app('wechat');
//        $app = new Application([]);
        $notice = $app->notice;
        $templateId = $notice->addTemplate(6);
        $templateArr = $notice->getPrivateTemplates();

    }


}
