@extends('layouts.weui')
@section('title')
    螺丝刀，以人为本，让生活更美好
@endsection

@section('content')
    <div class="page__bd">
        @foreach($data as $k=>$v)
            <div class="weui-cells__title">{{$v[0]['service_content']}}</div>
            <div class="weui-cells">
                @foreach($v as $vv)
                    <a class="weui-cell weui-cell_access" href="{{url('api/v1/weixin/orders/select/product')."?openid={$openid}&company_id={$company_id}&cat_id={$vv['cat_id']}&cat_name={$vv['product_cat']}&service_content_id={$vv['service_content_id']}&service_content_name={$vv['service_content']}"}}">
                        <div class="weui-cell__bd">
                            <p>{{$vv['product_cat']}}</p>
                        </div>
                        <div class="weui-cell__ft"></div>
                    </a>
                @endforeach
            </div>
        @endforeach
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