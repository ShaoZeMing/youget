<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
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


        Log::info('获取请求数据', [$request, __METHOD__]);

        //1、获取到微信推送过来的POST数据（XML格式）
        //$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        $postArr = file_get_contents("php://input");
        //file_put_contents('b.xml', $postArr);
        //2、接受了就开始处理了,这个函数把xml转换为一个对象
        $postObj = simplexml_load_string($postArr);
        Log::info('获取xml', [$postArr]);
        Log::info('msgType', [$postObj->MsgType]);
        $touser = $postObj->FromUserName;
        $fromuser = $postObj->ToUserName;
        $time = time();
        $MsgType = '';
        $content = '';
        if (strtolower($postObj->MsgType) == 'event') {
            if (strtolower($postObj->Event) == 'subscribe') {
                //回复用户消息
                $content = '感谢关注';
                $MsgType = 'text';
            }
            switch ($postObj->EventKey) {
                case 'sao_ma_ti_shi':
                    $content = '扫码成功！';
                    $MsgType = 'text';
                    break;
                case 'V1001_TODAY_MUSIC':
                    $content = '今天歌曲是，《老子明天不上班》';
                    $MsgType = 'text';
                    break;
            }
            $template = "<xml>
							   <ToUserName><![CDATA[%s]]></ToUserName>
							   <FromUserName><![CDATA[%s]]></FromUserName>
							   <CreateTime>%s</CreateTime>
							   <MsgType><![CDATA[%s]]></MsgType>
							   <Content><![CDATA[%s]]></Content>
							   </xml>";
            $template = trim($template);
            $info = sprintf($template, $touser, $fromuser, $time, $MsgType, $content);
            return $info;
        } elseif (strtolower($postObj->MsgType) == 'location') {
            $locationX = $postObj->Location_X;
            $locationY = $postObj->Location_Y;
            $address = $postObj->Label;
            $content = "你当前的地址是：【{$address}】，经度：【{$locationX}】，纬度：【{$locationY}】";
            $MsgType = 'text';
            $template = "<xml>
							   <ToUserName><![CDATA[%s]]></ToUserName>
							   <FromUserName><![CDATA[%s]]></FromUserName>
							   <CreateTime>%s</CreateTime>
							   <MsgType><![CDATA[%s]]></MsgType>
							   <Content><![CDATA[%s]]></Content>
							   </xml>";
            $template = trim($template);
            $info = sprintf($template, $touser, $fromuser, $time, $MsgType, $content);
            return $info;
        } elseif (strtolower($postObj->MsgType) == 'text') {
            $address = $postObj->Content;
            $content = "你说什么？我看不见你说的：【{$address}】";
            $MsgType = 'text';
            if ($address == '来张图片') {
                $content = '木得图片给你，好好学习才是王道';
            }
            $template = "<xml>
							   <ToUserName><![CDATA[%s]]></ToUserName>
							   <FromUserName><![CDATA[%s]]></FromUserName>
							   <CreateTime>%s</CreateTime>
							   <MsgType><![CDATA[%s]]></MsgType>
							   <Content><![CDATA[%s]]></Content>
							   </xml>";
            $template = trim($template);
            $info = sprintf($template, $touser, $fromuser, $time, $MsgType, $content);
            return $info;
        } elseif (strtolower($postObj->MsgType) == 'image') {
            $MediaId = $postObj->MediaId;
            $MsgType = 'text';
            $template = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                            </xml>";
            $template = trim($template);
            $info = sprintf($template, $touser, $fromuser, $time, $MsgType, $MediaId);
            return $info;
        } else {
            return $postArr;
        }


//        $data = $request->all();
//        $echostr = $request->get('echostr');
//        $signature = $request->get('signature');
//        $timestamp = $request->get('timestamp');
//        $nonce = $request->get('nonce');
//        $token = config('wechat.token');
//
//        $tmpArr = [$token, $timestamp, $nonce];
//        sort($tmpArr, SORT_STRING);
//        $tmpStr1 = implode($tmpArr);
//        $tmpStr = sha1($tmpStr1);
//        $context = [
//            'f' => __METHOD__,
//            'data' => $data,
//            '$tmpArr' => $tmpArr,
//            '$tmpStr' => $tmpStr,
//            '$tmpStr1' => $tmpStr1,
//        ];
//        Log::info('请求参数', $context);
//
//
//        if ($signature == $tmpStr) {
//            Log::info('效验成功', ['$signature' => $signature, '$tmpStr' => $tmpStr]);
//            $msg = "";
//            return $echostr;
//
//        } else {
//            Log::info('效验失败', ['$signature' => $signature, '$tmpStr' => $tmpStr]);
//
//            return response()->json([
//                'code' => 121,
//                'msg' => '调用失败',
//                'data' => $data,
//                'Token' => 'xZfV1M9Q9Vx1kjqD',
//                'echostr' => $echostr,
//            ]);
//        }

    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function index(Request $request)
    {
        Log::info('获取请求数据', [$request, __METHOD__]);

        $app = app('wechat');
        $msgArr = $app->getMessage();
        Log::info('请求message',$msgArr);

        $app->server->setMessageHandler(function ($message) {
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

        return $app->server->serve();
    }


    //创建微信自定义菜单
    public function createMenu(Request $request)
    {

        $context = [
            'request' => $request->all(),
            'method' => __METHOD__,
        ];

        try {
            $jsonmenu = '{
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

            $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $accessToken;
            $result = $this->https_request($url, $jsonmenu);
            var_dump($result);


        } catch (\Exception $e) {
            Log::info($e, $context);
        }
    }


    //https
    function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
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

}
