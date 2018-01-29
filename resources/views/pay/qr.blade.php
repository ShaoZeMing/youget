@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">扫码测试</div>
                <div class="panel-body">
                    {{--$code--}}
                    {!! isset($code) ? $code :'没有数据' !!}
                </div>
            </div>
        </div>
    </div>
</div>

<example></example>

@endsection
