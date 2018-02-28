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
            $jsonmenu = [
                [
                    "name" => "我的博客",
                    "sub_button" => [
                        [
                            "type" => "view",
                            "name" => "微信下单",
                            "url" => "http=>//shouhou.yipinxiaobai.com/api/v1/weixin/orders/VKLX2MVeAwez/index"
                        ],
                        [
                            "type" => "view",
                            "name" => "PHP",
                            "url" => "http=>//blog.4d4k.com/category/php/"
                        ],
                        [
                            "type" => "view",
                            "name" => "SQL",
                            "url" => "http=>//blog.4d4k.com/category/sql/"
                        ]
                    ]
                ],
                [
                    "name" => "扫一扫",
                    "sub_button" => [
                        [
                            "type" => "scancode_waitmsg",
                            "name" => "扫码带提示",
                            "key" => "sao_ma_ti_shi",
                            "sub_button" => []
                        ],
                        [
                            "type" => "scancode_push",
                            "name" => "扫码推事件",
                            "key" => "sao_ma_tui",
                            "sub_button" => []
                        ],
                        [
                            "type" => "click",
                            "name" => "今日歌曲",
                            "key" => "V1001_TODAY_MUSIC"
                        ]
                    ]
                ],
                [
                    "name" => "发图",
                    "sub_button" => [
                        [
                            "type" => "pic_sysphoto",
                            "name" => "拍照发图",
                            "key" => "pai_zhao",
                            "sub_button" => []
                        ],
                        [
                            "type" => "pic_photo_or_album",
                            "name" => "拍照or相册",
                            "key" => "pai_zhao_or_photos",
                            "sub_button" => []
                        ],
                        [
                            "type" => "pic_weixin",
                            "name" => "微信相册发图",
                            "key" => "wixin_photos"
                        ],
                        [
                            "type" => "location_select",
                            "name" => "发送位置",
                            "key" => "address"
                        ]
                    ]
                ]
            ];

            $app = app('wechat');
            $xx = $app->menu->add($jsonmenu);

            return $xx;
        } catch (\Exception $e) {
            Log::info($e, $context);
        }
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
                'url' => 'http://shouhou.yipinxiaobai.com/api/v1/weixin/orders/536880791171367940/show',
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
