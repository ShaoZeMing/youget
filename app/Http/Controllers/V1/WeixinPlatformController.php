<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use EasyWeChat\Core\Exceptions\HttpException;
use EasyWeChat\OpenPlatform\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeixinPlatformController extends Controller
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
    public function server(Request $request,$id)
    {

        Log::info('获取请求数据platform', [$request, $id, __METHOD__]);

        $app = app('wechat')->open_platform->server;
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

    //授权成功跳转页面
    public function targetAuth(Request $request, $id)
    {

        $companyId = $id;
        $context = [
            '$request' => $request->all(),
            'companyId' => $companyId,
            'method' => __METHOD__,
        ];
        Log::notice('授权成功跳转方法', $context);
        $openPlatform = app('wechat')->open_platform;
        $info = $openPlatform->getAuthorizationInfo();
        Log::notice('凭证+更新状态:', [$info->toArray()]);
        $date = [
            'app_id' => $info->get('authorization_info.authorizer_appid'),
            'refresh_token' => $info->get('authorization_info.authorizer_refresh_token'),
        ];
        dd($info);
        return redirect('/');
    }



    //获取
    public function user()
    {
        $user = session('wechat.platform.oauth_user'); // 拿到授权用户资料
        dd($user);
    }


    /**
     * 处理平台微信的请求消息
     *
     * @return string
     */
    public function auth(Request $request)
    {
        Log::info('获取请求数据platform', [$request, __METHOD__]);
        $context = [
            '$request' => $request->all(),
            'method' => __METHOD__,
        ];
        try {
            Log::info('微信授权接收接口', $context);
            $openPlatform = app('wechat')->open_platform;
            $openPlatform->server->setMessageHandler(function ($event) use ($openPlatform) {
                // 事件类型常量定义在 \EasyWeChat\OpenPlatform\Guard 类里
                switch ($event->InfoType) {
                    case Guard::EVENT_AUTHORIZED: // 授权成功
                        $authorizationInfo = $openPlatform->getAuthorizationInfo($event->AuthorizationCode);
                        // 保存数据库操作等...
                        Log::info('授权成功', [$authorizationInfo]);
                        break;
                    case Guard::EVENT_UPDATE_AUTHORIZED: // 更新授权
                        // 更新数据库操作等...
                        Log::info('授权更新', [__METHOD__]);
                        break;
                    case Guard::EVENT_UNAUTHORIZED: // 授权取消
                        // 更新数据库操作等...
                        Log::info('授权取消', [__METHOD__]);
//                        $authorizationInfo = $openPlatform->getAuthorizationInfo();
//                        $date = [
//                            'refresh_token' => '',
//                        ];
//                        $company = $companyRepository->where('app_id',$authorizationInfo->authorizer_appid)->update($date);
                        break;
                }
            });
            return $openPlatform->server->serve();
        } catch (\Exception $e) {
            Log::error($e, $context);
            return 'success';
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


    public function orderCreate()
    {

        return view('weixin.order_create');
    }


    public function sendNotice()
    {

        try {
            $app = app('wechat');
            $notice = $app->notice;
            $templateArr = $notice->getPrivateTemplates();
            Log::info('模板列表', [$templateArr, __METHOD__]);
            $messageId = $notice->send([
                'touser' => 'oYzfov2raQuxOG0S_Mv4eoX69Cps',
                'template_id' => 'yThwCBLqv_tSrdJYlKjYjvBcyuxBGqqkRhgLJ3k_kow',
                'url' => 'http://test.4d4k.com/api/weixin/mp/user',
                'data' => [
                    "first" => array("下单成功！"),
                    "keyword1" => array("已安排工程师上门"),
                    "keyword2" => array("171130103701752935"),
                    "keyword3" => array("上门"),
                    "keyword4" => array("2017-11-30 12:00:00"),
                    "keyword5" => array("国强师傅-18513117316"),
                    "remark" => array('请保持电话畅通，等待上门。'),
                ],
            ]);
            Log::info('模板消息ID', [$messageId, __METHOD__]);
            return '模板消息发送成功';
        } catch (HttpException $e) {
            Log::error($e, [__METHOD__]);
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
