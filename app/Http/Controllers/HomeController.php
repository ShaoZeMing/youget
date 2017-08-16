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

//        echo$v= base64_encode('每次给你发了微信后，你没有回我，我就像失去了整个世界，每次一听到微信的声音，我就立马激动的打开，失落的关上，我不知道这样会不会然你产生厌烦，我只知道，如果有好感就是喜欢，如果这种好感经得起考验，那就是爱。今天q好友185天,认识了206天。');
        echo$v= base64_encode('等哪天，我不喜欢你了，我就会来你空间把这些留言全部删除掉。如果你没有删除我的，我就会一直喜欢你。');
        echo '<br>';
        echo base64_decode('5LuK5aSp5L2g5bGF54S257uZ5oiR5Y+R56yR6K+d77yM5oiR5aW95byA5b+D44CC5oiR5LiA5aSp6YO95Zyo56yR77yM5Zug5Li65L2g6IO95YiG5Lqr5b+r5LmQ57uZ5oiR44CCcHM65L2g55qE56yR6K+d5LiN5aW956yR77yM5LiA55yL5L2g5bCx56yR54K55L2O77yM5LqM5aSp5oiR57uZ5L2g5Y+R56yR6K+d5LiN6IO95Y+R56yR54K56auY55qE5LqG77yM5a6z5oCV5L2g55yL5LiN5oeC77yM5oiW6ICF5Yiw5pe25YCZ56yR5YK75LqG5oCO5LmI5Yqe77yM5ZWm5ZWm5ZWm5ZWm5ZWm77yB44CC5ZOI5ZOI77yM6L+Y5pyJ77yM5LuK5aSp5oiR5a+55L2g5LiL5LqG5aWX77yM5LiN5ZGK6K+J5L2g5piv5LuA5LmI5aWXXCheb14pL37jgILku4rlpKlx5aW95Y+LMTgy5aSpLOiupOivhuS6hjIwM+WkqeS6huOAgg==
');
//        return view('home');
    }


    public function indexs()
    {

//        dd(explode(',','asa,ss,dd,ff,gg,hh,jj'));
//代码作者：giuem
//更多源码请访问www.giuem.com
        $qq = "928240096";
//        $sid = "AQVb5Hb8RaZygg7ZucuW5XGZ";
        $sid = "cdXqOisfZfPoxYwWsoDonNdtfwEjZeTD3753d1e00201%3D%3D";

//        $url = "http://ish.z.qq.com/infocenter_v2.jsp?B_UID={$qq}&sid={$sid}&g_ut=1";
        $url = "https://h5.qzone.qq.com/mqzone/index";
        $content = $this->url_get($url);
        $zz = $this->getmiddltxt($content, ']<a href="http://blog', '">赞');
        $a = count($zz);
        var_dump($content);
        for ($i = 1; $i <= $a; $i++) {
            $url1 = $zz[$i - 1][0];
            $url2 = $this->getmiddltxt($url1, ']<a href="', '">赞');
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
