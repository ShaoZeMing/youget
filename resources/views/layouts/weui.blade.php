<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/weui.css')}}"/>
    <style>
        html,body{height:100%;-webkit-tap-highlight-color:transparent;}
        #content{position:absolute;top:0;right:0;bottom:0;left:0;overflow:hidden;background-color:#fafafa;-webkit-overflow-scrolling:touch;}
    </style>
    <script src="{{asset('js/weui.js')}}"></script>
</head>
<body>
<div id="popout">@yield('popout')</div>
<div id="mask">@yield('mask')</div>
<div id="navigation">@yield('navigation')</div>
<div id="content">@yield('content')</div>
</body>
@yield('myjs')
</html>
