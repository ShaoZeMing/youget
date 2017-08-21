@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">首页</div>

                <div class="panel-body">
                    <ul>
                        <li><a href="ali/index.html">支付宝支付demo</a></li>
                        <li><a href="wx/index.html">微信支付demo</a></li>
                        <li><a href="cmb/index.html">招商一网通支付demo</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<example></example>
@endsection
