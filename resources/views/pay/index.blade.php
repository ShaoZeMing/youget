@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">支付测试</div>
                    <div class="panel-body">

                        <h3>支付宝支付</h3>
                        <div class="list-group">
                            <a class="list-group-item" href="{{url('api/alipay/app')}}" target="_blank">手机APP支付</a>
                            <a class="list-group-item" href="{{url('api/alipay/wap')}}" target="_blank">支付宝手机网站支付</a>
                            <a class="list-group-item" href="{{url('api/alipay/qj')}}" target="_blank">扫码支付</a>
                            <a class="list-group-item" href="{{url('api/alipay/bar')}}" target="_blank">条码支付</a>
                            <a class="list-group-item" href="{{url('api/alipay/web')}}" target="_blank">电脑支付（即时到账）</a>

                            <a class="list-group-item" href="{{url('api/alipay/charge')}}" target="_blank">查询支付的订单</a>
                            <a class="list-group-item" href="queryRefund.php" target="_blank">查询退款的订单</a>
                            <a class="list-group-item" href="queryTransfer.php" target="_blank">查询转账的订单</a>

                            <a class="list-group-item" href="refund.php" target="_blank">退款订单</a>
                            <a class="list-group-item" href="transfer.php" target="_blank">转账操作</a>
                        </div>
                        <h3>微信支付demo</h3>
                        <div class="list-group">
                            <a class="list-group-item" href="appCharge.php" target="_blank">微信手机app支付</a>
                            <a class="list-group-item" href="{{url('api/weixin/qj')}}" target="_blank">微信扫码支付</a>
                            <a class="list-group-item" href="pubCharge.php" target="_blank">微信公众号支付</a>
                            <a class="list-group-item" href="liteCharge.php" target="_blank">小程序支付</a>
                            <a class="list-group-item" href="barCharge.php" target="_blank">微信刷卡支付</a>
                            <a class="list-group-item" href="wapCharge.php" target="_blank">H5手机网站支付</a>

                            <a class="list-group-item" href="queryOrder.php" target="_blank">查询支付的订单</a>
                            <a class="list-group-item" href="queryRefund.php" target="_blank">查询退款的订单</a>
                            <a class="list-group-item" href="queryTransfer.php" target="_blank">查询转账的订单(不支持沙箱)</a>

                            <a class="list-group-item" href="refund.php" target="_blank">退款订单</a>
                            <a class="list-group-item" href="transfer.php" target="_blank">转账操作(不支持沙箱)</a>
                        </div>
                        <h3>招商一网通支付demo</h3>
                        <div class="list-group">

                            <a class="list-group-item" href="charge.php" target="_blank">一网通支付</a>
                            <a class="list-group-item" href="queryPubKey.php" target="_blank">查询招行公钥</a>
                            <a class="list-group-item" href="bindCard.php" target="_blank">签约招商一网通</a>
                            <a class="list-group-item" href="queryOrder.php" target="_blank">查询支付订单信息</a>
                            <a class="list-group-item" href="queryRefund.php" target="_blank">查询退款订单信息</a>
                            <a class="list-group-item" href="refund.php" target="_blank">退款订单</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <example></example>

@endsection
