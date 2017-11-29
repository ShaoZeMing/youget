@extends('layouts.weui')
@section('title')
    选择产品
@endsection
@section('header')
@endsection
@section('content')
    <div class="page__bd">
        {{--这是顶部--}}
        <div class="ming-navbar"  >
            <a href="{{url('api/v1/weixin/orders/index')."?openid={$openid}&company_id={$company_id}&cat_id={$cat_id}&cat_name={$cat_name}&service_content_id={$service_content_id}&service_content_name={$service_content_name}"}}}"><</a>
            <p >请选择产品</p>
        </div>
        <div class="weui-cells__title">您选择：{{$service_content_name}}->{{$cat_name}}</div>
        <div class="weui-cells">
            @if(count($products))
            @foreach($products as $v)
            <a class="weui-cell weui-cell_access" href="{{url('api/v1/weixin/orders/select/fault')."?openid={$openid}&company_id={$company_id}&cat_id={$cat_id}&cat_name={$cat_name}&service_content_id={$service_content_id}&service_content_name={$service_content_name}&product_id={$v['id']}&product_name={$v['name']}"}}">
                <div class="weui-cell__bd">
                    <p>{{$v['name']}}</p>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
           @endforeach
                @else
                {{--<a class="weui-cell weui-cell_access" href="{{url('api/v1/weixin/orders/select/fault')."?openid={$openid}&company_id={$company_id}&cat_id={$cat_id}&cat_name={$cat_name}&service_content_id={$service_content_id}&service_content_name={$service_content_name}&product_id={$v['id']}&product_name={$v['name']}"}}">--}}
                   <div class="weui-cell ">
                       <div class="weui-cell__bd">
                           <p>该品类下没有产品</p>
                       </div>
                   </div>
                    {{--<div class="weui-cell__ft"></div>--}}
                {{--</a>--}}
           @endif
        </div>
    </div>
@endsection
@section('myjs')

    <script>
        if(window.localStorage) {
            window.localStorage.removeItem("order_id");
        }

        var window_height = $(window).height();
        var document_height =$(document).height();
        console.log('window_height',window_height);
        console.log('document_height',document_height);

        if(document_height > window_height  ){
            $('#weui_footer').removeClass('weui-footer_fixed-bottom');
        }
    </script>
@endsection