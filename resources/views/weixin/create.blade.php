@extends('layouts.weui')
@section('title')
    确认下单
@endsection
@section('header')
@endsection
@section('content')
    <div class="page__bd">
        {{--这是顶部--}}
        <div class="ming-navbar">
            <a href="{{url('api/v1/weixin/orders/select/fault')."?openid={$openid}&company_id={$company_id}&cat_id={$cat_id}&cat_name={$cat_name}&service_content_id={$service_content_id}&service_content_name={$service_content_name}&product_id={$product_id}&product_name={$product_name}&malfunction_name={$malfunction_name}&malfunction_id={$malfunction_id}"}}"><</a>
            <p>确认下单</p>
        </div>

        <div class="weui-cells__title">您选择：{{$service_content_name}}->{{$cat_name}}->{{$product_name}}</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>故障类型：{{$malfunction_name}}</p>
                </div>
                <div class="weui-cell__ft"></div>
            </div>
        </div>
        <form id="create_order" action="#" onsubmit="return false">
            <div class="weui-cells weui-cells_form">
                <input type="hidden" id="order_id" name="order_id" value="0">
                <input type="hidden" name="openid" value="{{$openid}}">
                <input type="hidden" name="company_id" value="{{$company_id}}">
                <input type="hidden" name="cat_id" value="{{$cat_id}}">
                <input type="hidden" name="service_content_id" value="{{$service_content_id}}">
                <input type="hidden" name="service_content_name" value="{{$service_content_name}}">
                <input type="hidden" name="product_id" value="{{$product_id}}">
                <input type="hidden" name="product_name" value="{{$product_name}}">
                <input type="hidden" name="malfunction_id" value="{{$malfunction_id}}">
                <input type="hidden" name="malfunction_name" value="{{$malfunction_name}}">
                <input type="hidden" id="service_mode_name" name="service_mode_name" value="">
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label for="connection_name" class="weui-label">联系人</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="connection_name" id="connection_name" type="text"
                               placeholder="请输入联系人"/>
                    </div>
                    <div class="weui-cell__ft "><i class="weui-icon-warn"></i></div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label for="connection_mobile" class="weui-label">联系电话</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" name="connection_mobile" id="connection_mobile" type="number"
                               pattern="[0-9]*"
                               placeholder="请输入联系电话"/>
                    </div>
                    <div class="weui-cell__ft "><i class="weui-icon-warn"></i></div>
                </div>
            </div>
            <div class="weui-cells__title">联系地址</div>
            <div class="weui-cells weui-cells_form">

                <div class="weui-cell">
                    <div class="weui-cell__hd"><label for="wx_city" class="weui-label">国家/地区</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text" name="wx_city" id="wx_city" placeholder="请选择">
                        <input class="weui-input" type="hidden" name="wx_citys" id="wx_citys" value="">
                    </div>
                    <div class="weui-cell__ft "><i class="weui-icon-warn"></i></div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text" name="wx_address" placeholder="请输入详细地址"/>
                    </div>
                    <div class="weui-cell__ft "><i class="weui-icon-warn"></i></div>
                </div>
            </div>
            <div class="weui-cells__title">选择服务类型</div>
            <div class="weui-cells weui-cells_radio">
                @foreach($service_modes as $k => $v)
                    <label class="weui-cell weui-check__label" for="redio_{{$k}}">
                        <div class="weui-cell__bd">
                            <p>{{$v['name']}}</p>
                        </div>
                        <div class="weui-cell__ft">
                            <input type="radio" class="weui-check" name="service_mode_id" id="redio_{{$k}}"
                                   data-name="{{$v['name']}}" value="{{$v['id']}}"
                                   @if($k==0)  checked="checked" @endif />
                            <span class="weui-icon-checked"></span>
                        </div>
                    </label>
                @endforeach
            </div>
            <div class="weui-cells__title">备注</div>
            <div class="weui-cells weui-cells_form">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                        <textarea class="weui-textarea" name="order_desc" placeholder="还有什么要求吗?" rows="3"></textarea>
                        <div class="weui-textarea-counter"><span>0</span>/200</div>
                    </div>
                </div>
            </div>
            <label for="weuiAgree" class="weui-agree">
                <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox"/>
                <span class="weui-agree__text">
                阅读并同意<a href="javascript:void(0);">《相关条款》</a>
            </span>
            </label>
        </form>
    </div>

@endsection

@section('footer')
    <div class="page__ft">
        <div class="weui-footer" style="margin-bottom: 90px">
            <p class="weui-footer__links">
                <a href="javascript:home();" class="weui-footer__link">
                    客服电话：0989-098778</a>
            </p>
            <p class="weui-footer__text">Copyright &copy; 2008-2016 智胜云售后</p>
        </div>
    </div>
    <div class="weui-footer_fixed-bottom weui-flex weui-panel" style="bottom: 0;z-index: 100">
        <div class="weui-flex__item">
            <div class=" weui-media-box weui-media-box_text">
                <h4 class="weui-media-box__title">上门费用：<span style="color: red">20元</span></h4>
                <p class="weui-media-box__desc" style="line-height:2">具体费用维完成后收取。</p>
            </div>
        </div>
        <div class="weui-flex__item ">
            <div class="">
                <a id="submit" href="javascript:;" class="weui-btn weui-btn-area weui-btn_primary ">
                    下单
                </a>

            </div>
            <input type="hidden" id="js_ok_to_url" value="{{url('api/v1/weixin/orders/success')}}">
            <input type="hidden" id="js_ajax_url" value="{{url('api/v1/weixin/order/create')}}">
            <input type="hidden" id="js_ajax_url_update" value="{{url('api/v1/weixin/order/update')}}">
        </div>
    </div>
@endsection

@section('myjs')
    <script src="{{asset('/plugins/weui/src/jquery-weui.min.js')}}"></script>
    <script src="{{asset('/plugins/weui/src/city-picker.min.js')}}"></script>
    <script src="{{asset('/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    {{--    <script src="{{asset('/plugins/weui/src/fastclick.js')}}"></script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            //            FastClick.attach(document.body);
            if (window.localStorage) {
                var order_id = window.localStorage.getItem("order_id");
                console.log('order_id', order_id);
                if (order_id) {
                    $('#wx_citys').val('青海');
                    $('#order_id').val(order_id);
                    $('#submit').text("修改订单");
                }
            }


            $("#wx_city").cityPicker({
                title: "选择地址",
                onChange: function (picker, values, displayValues) {
                    $('#wx_citys').val(displayValues.join(' '))
                }
            });

            if ($.isFunction($.fn.validate)) {
                //添加|编辑产品-szm

                jQuery.validator.addMethod("isMobile", function (value, element) {
                    var length = value.length;
                    var mobile = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
                    return this.optional(element) || (length == 11 && mobile.test(value));
                }, "请正确填写您的手机号码");
                $('#create_order').validate({
                    ignore: "",
                    errorPlacement: function (error, element) {
                        var eleme = $(element).parents('.weui-cell');
                        eleme.addClass('weui-cell_warn');
                    },
                    rules: {
                        connection_name: {
                            required: true,
                            maxlength: 20
                        },
                        connection_mobile: {
                            required: true,
                            isMobile: true
                        },
                        wx_citys: {
                            required: true
                        },
                        wx_address: {
                            required: true,
                            maxlength: 200
                        }
                    },

                    invalidHandler: function (event, validator) {
//                        display error alert on form submit
//                        alert('错误后首先执行这个函数');
                    },

                    success: function (error, element) {
                        var eleme = $(element).parents('.weui-cell');
                        eleme.removeClass('weui-cell_warn');
                    },
                    submitHandler: function (form) {
                        $('#submit').addClass("weui-btn_loading");
                        $('#submit').text("正在下单...");
                        var formData = new FormData(form); //
                        var service_mode_name = $("input[name='service_mode_id']:checked").data('name');
                        formData.append('service_mode_name', service_mode_name)
                        var order_id = $('#order_id').val();
                        console.log('order_id', order_id)
                        var _url = $("#js_ajax_url").val()
                        if (order_id != 0) {
                            _url = $("#js_ajax_url_update").val()
                            $.confirm({
                                title: '友情提示',
                                text: '你确定要更新这个工单吗',
                                onOK: function () {
                                    _ajaxOrder(formData, _url)
                                    return false;
                                },
                                onCancel: function () {
                                    return false;
                                }
                            });
                        } else {
                            _ajaxOrder(formData, _url)
                        }
                        return false;//阻止表单提交
                    }
                });
            }


            function _ajaxOrder(formData, _url) {
                $.ajax({
                    url: _url,      //提交路径Url
                    type: 'POST',       //提交方式
                    data: formData,     //提交数据
                    async: true,       //是否异步，false：同步，提交时锁屏待成功后才可以
                    cache: false,      //是否开启url缓存，false兼容IE8
                    contentType: false,    //是否转换编码，用FormData对象后设置为false
                    processData: false,    //application/x-www-form-urlencoded编码来进行转换，用FormData对象后设置为false
                    success: function (result) {
                        console.log(result);
                        $('#submit').removeClass("weui-btn_loading");
                        if (result.error) {
                            $('#submit').text("重新提交");
                            $.alert(result.msg, "出错误啦！", function () {
                                //点击确认后的回调函数
                            });
                        } else {
                            if (window.localStorage) {
                                window.localStorage.setItem("order_id", result.data);//存Id
                            }
                            console.log('result.data', result.data);
                            window.location.href = $('#js_ok_to_url').val() + '/' + result.data;
                        }
                    },
                    error: function (result) {
                        console.log(result);
                    }
                });
            }

            $("#wx_city").click(function () {
                $("input").blur();
                var eleme = $(this).parents('.weui-cell');
                if (eleme.hasClass('weui-cell_warn')) {
                    eleme.find('.weui-cell_warn').parent().remove();
                    eleme.removeClass('weui-cell_warn');
                }
            });

            $('#submit').click(function (even) {
                if ($(this).hasClass('weui-btn_loading')) {
                    return false;
                }
                $('#create_order').submit();
            })

        });
    </script>
@endsection