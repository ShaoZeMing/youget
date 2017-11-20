<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Shaozeming\Push\PushManager;
use Payment\Common\PayException;
use Payment\Client\Charge;
use Payment\Config;

class PayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $aliConfig ;
    public function __construct()
    {
        date_default_timezone_set('Asia/Shanghai');
        $this->aliConfig = config('aliconfig');
    }


    public function index()
    {

        return view('pay.index');
    }


    //支付宝app支付
    public function aliAppPay()
    {
        $aliConfig = $this->aliConfig;
// 订单信息
        $orderNo = time() . rand(1000, 9999);
        $payData = [
            'body'    => 'ali qr pay',
            'subject'    => '测试支付宝 app支付',
            'order_no'    => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'    => '0.01',// 单位为元 ,最小为0.01
            'return_param' => '123123',
            'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'goods_type' => '1',
            'store_id' => '',
        ];

        try {
            $str = Charge::run(Config::ALI_CHANNEL_APP, $aliConfig, $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }
        echo $str;// 这里如果直接输出到页面，&not 会被转义，请注意
    }



    //支付宝扫码支付
    public function aliQrPay()
    {
        $aliConfig = $this->aliConfig;

// 订单信息
        $orderNo = time() . rand(1000, 9999);
        $payData = [
            'body'    => 'ali qr pay',
            'subject'    => '测试支付宝扫码支付',
            'order_no'    => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'    => '0.01',// 单位为元 ,最小为0.01
            'return_param' => '123123',
            'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'goods_type' => '1',
            'store_id' => '',
        ];


        try {
            $url = Charge::run(Config::ALI_CHANNEL_QR, $aliConfig, $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }

        echo $url;
    }


    //网站支付|及时到账
    public function aliWebPay()
    {

        $aliConfig = $this->aliConfig;

// 订单信息
        $orderNo = time() . rand(1000, 9999);
        $payData = [
            'body'    => 'ali web pay',
            'subject'    => '测试支付宝电脑网站支付',
            'order_no'    => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'    => '0.01',// 单位为元 ,最小为0.01
            'return_param' => '123123',
            'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'goods_type' => '1',
            'store_id' => '',

            // 说明地址：https://doc.open.alipay.com/doc2/detail.htm?treeId=270&articleId=105901&docType=1
            // 建议什么也不填
            'qr_mod' => '',
        ];

        try {
            $url = Charge::run(Config::ALI_CHANNEL_WEB, $aliConfig, $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }

        header('Location:' . $url);
    }


    //条码支付
    public function aliBarPay()
    {

        $aliConfig = $this->aliConfig;

// 订单信息
        $orderNo = time() . rand(1000, 9999);
        $payData = [
            'body'    => 'ali bar pay',
            'subject'    => '测试支付宝条码支付',
            'order_no'    => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'    => '0.01',// 单位为元 ,最小为0.01
            'return_param' => '123123',
            'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'goods_type' => '1',
            'store_id' => '',
            'operator_id' => '',
            'terminal_id' => '',// 终端设备号(门店号或收银设备ID) 默认值 web
            'alipay_store_id' => '',
            'scene' => 'bar_code',// 条码支付：bar_code 声波支付：wave_code
            'auth_code' => '1231212232323123123',
        ];

        try {
            $ret = Charge::run(Config::ALI_CHANNEL_BAR, $aliConfig, $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }

        var_dump($ret);
    }
    //手机wap网页支付
    public function aliWapPay()
    {
        $aliConfig = $this->aliConfig;

// 订单信息
        $orderNo = time() . rand(1000, 9999);
        $payData = [
            'body'    => 'ali wap pay',
            'subject'    => '测试支付宝手机网站支付',
            'order_no'    => $orderNo,
            'timeout_express' => time() + 600,// 表示必须 600s 内付款
            'amount'    => '0.01',// 单位为元 ,最小为0.01
            'return_param' => 'tata',// 一定不要传入汉字，只能是 字母 数字组合
            'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',// 客户地址
            'goods_type' => '1',
            'store_id' => '',
        ];

        try {
            $url = Charge::run(Config::ALI_CHANNEL_WAP, $aliConfig, $payData);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }

        header('Location:' . $url);
    }

    //查询订单
    public function getPayCharge()
    {

        $aliConfig = $this->aliConfig;

        $data = [
            'out_trade_no' => '14935448529859',
            'trade_no' => '2017043021001004350200163279',
        ];

        try {
            $ret = Query::run(Config::ALI_CHARGE, $aliConfig, $data);
        } catch (PayException $e) {
            echo $e->errorMessage();
            exit;
        }

        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    }
}