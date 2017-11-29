@extends('layouts.weui')
@section('title')
    选择故障类型
@endsection
@section('header')
@endsection
@section('content')
    <div class="page__bd">
        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">下单成功</h2>
                <p class="weui-msg__desc">我们会尽快与您取得联系确认上门维修时间，请保持电话畅通。<a href="javascript:void(0);">文字链接</a></p>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <a href="{{url('api/v1/weixin/orders/'.$id.'/show')}}" class="weui-btn weui-btn_primary">查询订单详情</a>
                </p>
            </div>
            <div class="weui-msg__extra-area">
                <div class="weui-footer">
                    <p class="weui-footer__links">
                        <a href="javascript:;" class="weui-footer__link">
                            客服电话：0989-098778</a>
                    </p>
                    <p class="weui-footer__text">Copyright &copy; 2008-2016 智胜云售后</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
@section('myjs')
@endsection

