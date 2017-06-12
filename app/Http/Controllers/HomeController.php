<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        echo$v= base64_encode('今天其实想和聊天开视频的，可是感觉昨天聊了那么久，今天再找你，你会觉得烦，就不敢了。今天是我们qq好友177天,我们认识了198天了。');
        echo '<br>';
        echo $vs= $v &(md5('ming'));
        echo '<br>';
        echo base64_decode('5LuK5aSp5YW25a6e5oOz5ZKM6IGK5aSp5byA6KeG6aKR55qE77yM5Y+v5piv5oSf6KeJ5pio5aSp6IGK5LqG6YKj5LmI5LmF77yM5LuK5aSp5YaN5om+5L2g77yM5L2g5Lya6KeJ5b6X54Om77yM5bCx5LiN5pWi5LqG44CC5LuK5aSp5piv5oiR5LuscXHlpb3lj4sxNzflpKks5oiR5Lus6K6k6K+G5LqGMTk45aSp5LqG44CC');
        echo '<br>';
        echo base64_decode($vs);
        echo '<br>';
//var_dump(md5('240610708') == md5('QNKCDZO'));
//var_dump(md5('aabg7XSs') == md5('aabC9RqS'));
//var_dump(sha1('aaroZmOk') == sha1('aaK1STfY'));
//var_dump(sha1('aaO8zKZF') == sha1('aa3OFF9m'));
//var_dump('0010e2' == '1e3');
//var_dump('0x1234Ab' == '1193131');
//var_dump('0xABCdef' == ' 0xABCdef');
//var_dump(0 == 'abcdefg');
//var_dump(1 == '1abcdef');
//        echo base64_decode('SUBnaXVlbS5jb20=');
//        return view('home');
    }


    public function demo()
    {

//代码作者：giuem
//更多源码请访问www.giuem.com
        $qq = "928240096";
        $sid = "";

        $url = "http://ish.z.qq.com/infocenter_v2.jsp?B_UID={$qq}&sid={$sid}&g_ut=1";
        $content = url_get($url);
        $zz = getmiddltxt($content, ']<a href="http://blog', '">赞');
        $a = count($zz);
        for ($i = 1; $i <= $a; $i++) {
            $url1 = $zz[$i - 1][0];
            $url2 = getmiddltxt($url1, ']<a href="', '">赞');
            file_get_contents(html_entity_decode($url2[0][1]));
            echo "成功";
            sleep(5);
        }
        if ($a == "0") {
            echo "none";
        }
    }

    function getmiddltxt($txt, $left, $right)
    {
        preg_match_all("{" . $left . "(.*?)" . $right . "}", $txt, $data, PREG_SET_ORDER);
        return $data;
    }

    function url_get($url, $POSTcontent = "", $cookie = "")
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($POSTcontent != "") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTcontent);
        }
        if ($cookie != "") {
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
