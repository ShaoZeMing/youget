@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">首页</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <send-code-field></send-code-field>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <div class="list-group">
            <a class="list-group-item" href="{{url('api/pay')}}" >支付测试</a>
        </div>
    </div>
    </div>
</div>

<example></example>
@endsection
