<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <style>
        .list-group {
            padding-left: 0;
            margin-bottom: 20px;
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: 10px 15px;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .code {
            color: red;
        }

        .col-md-12 {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="list-group">
                <span class="list-group-item code">错误码：{{$code}}</span>
                <span class="list-group-item code">错误内容：{{$msg}}</span>
                <span class="list-group-item code">错误文件：{{$file}}</span>
                <span class="list-group-item code">错误行数：{{$line}}</span>
                {{--                <img class="list-group-item" src="{{$message->embed($img)}}">--}}
            </div>
        </div>
    </div>
</div>
</body>
</html>
