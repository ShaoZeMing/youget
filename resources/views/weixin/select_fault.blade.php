@extends('layouts.weui')
@section('title')
    选择故障类型
@endsection
@section('header')
@endsection
@section('content')
    <div class="page__bd">
        {{--这是顶部--}}
        <div class="ming-navbar"  >
            <a href="{{url('api/v1/weixin/orders/select/product')."?openid={$openid}&company_id={$company_id}&cat_id={$cat_id}&cat_name={$cat_name}&service_content_id={$service_content_id}&service_content_name={$service_content_name}&product_id={$product_id}&product_name={$product_name}"}}}"><</a>
            <p >请选择故障类型</p>
        </div>
        <div class="weui-cells__title">您选择：{{$service_content_name}}->{{$cat_name}}->{{$product_name}}</div>
        <div class="weui-cells">
            @foreach($malfunction_data as $v)
            <a class="weui-cell weui-cell_access" href="{{url('api/v1/weixin/orders/create')."?openid={$openid}&company_id={$company_id}&cat_id={$cat_id}&cat_name={$cat_name}&service_content_id={$service_content_id}&service_content_name={$service_content_name}&product_id={$product_id}&product_name={$product_name}&malfunction_name={$v['name']}&malfunction_id={$v['id']}"}}">
                <div class="weui-cell__bd">
                    <p>{{$v['name']}}</p>
                </div>
                <div class="weui-cell__ft"></div>
            </a>
           @endforeach

        </div>
    </div>
@endsection
@section('myjs')

    <script>
        var window_height = $(window).height();
        var document_height =$(document).height();
        console.log('window_height',window_height);
        console.log('document_height',document_height);

        if(document_height > window_height  ){
            $('#weui_footer').removeClass('weui-footer_fixed-bottom');
        }
    </script>
@endsection