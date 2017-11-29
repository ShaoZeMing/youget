@extends('layouts.weui')
@section('title')
    订单详情
@endsection
@section('header')
@endsection
@section('content')
    <div class="page__bd">
        {{--这是顶部--}}
        {{--<div class="ming-navbar"  >--}}
            {{--<a href="{{url('api/v1/weixin/orders/select/fault')}}"><</a>--}}
            {{--<p >订单详情</p>--}}
        {{--</div>--}}

        <div class="weui-cells weui-panel weui-panel_access">
            <div class="weui-panel__bd">
                <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box__hd">
                        <i class="{{$html_class}} ming-icon_msg"></i>
                    </div>
                    <div class="weui-media-box__bd">
                        <h4 class="weui-media-box__title" @if($state >=0 && $state<99 ) style="color: green"  @else style="color: red"  @endif>{{$state_txt}}</h4>
                        <p class="weui-media-box__desc">{{$html_text}}</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">单号：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$order_no}}</p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">报单时间：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$created_at}}</p>
                </div>
            </div>
        </div>

        @if($worker_mobile)
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">工程师：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$worker_name}}</p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">电话：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$worker_mobile}}</p>
                </div>
            </div>
        </div>
        @endif
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">姓名：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$connect_user_name}}</p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">电话：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$connect_user_mobile}}</p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">地址：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$full_address}}</p>
                </div>
            </div>
        </div>

        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">服务内容：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$service_content_name . '->'.$cat_name}}</p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">故障类型：</label>
                </div>
                <div class="weui-cell__bd">
                    <p>{{$malfunction_name}}</p>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>其他要求：
                        <span class="ming-textarea">
                            {{$order_desc}}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <div class="page__ft">
            <div class="weui-footer">
            <p class="weui-footer__links">
                <a href="javascript:home();" class="weui-footer__link">
                    客服电话：0989-098778</a>
            </p>
            <p class="weui-footer__text">Copyright &copy; 2008-2016 智胜云售后</p>
        </div>
    </div>
@endsection

@section('myjs')
<script>
    if(window.localStorage) {
        window.localStorage.removeItem("order_id");
    }
</script>
@endsection