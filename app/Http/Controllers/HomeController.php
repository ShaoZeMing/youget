<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

//    /**
//     * Show the application dashboard.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//
////        echo$v= base64_encode('每次给你发了微信后，你没有回我，我就像失去了整个世界，每次一听到微信的声音，我就立马激动的打开，失落的关上，我不知道这样会不会然你产生厌烦，我只知道，如果有好感就是喜欢，如果这种好感经得起考验，那就是爱。今天q好友185天,认识了206天。');
//        echo$v= base64_encode('等哪天，我不喜欢你了，我就会来你空间把这些留言全部删除掉。如果你没有删除我的，我就会一直喜欢你。');
//        echo '<br>';
//        echo base64_decode('5LuK5aSp5L2g5bGF54S257uZ5oiR5Y+R56yR6K+d77yM5oiR5aW95byA5b+D44CC5oiR5LiA5aSp6YO95Zyo56yR77yM5Zug5Li65L2g6IO95YiG5Lqr5b+r5LmQ57uZ5oiR44CCcHM65L2g55qE56yR6K+d5LiN5aW956yR77yM5LiA55yL5L2g5bCx56yR54K55L2O77yM5LqM5aSp5oiR57uZ5L2g5Y+R56yR6K+d5LiN6IO95Y+R56yR54K56auY55qE5LqG77yM5a6z5oCV5L2g55yL5LiN5oeC77yM5oiW6ICF5Yiw5pe25YCZ56yR5YK75LqG5oCO5LmI5Yqe77yM5ZWm5ZWm5ZWm5ZWm5ZWm77yB44CC5ZOI5ZOI77yM6L+Y5pyJ77yM5LuK5aSp5oiR5a+55L2g5LiL5LqG5aWX77yM5LiN5ZGK6K+J5L2g5piv5LuA5LmI5aWXXCheb14pL37jgILku4rlpKlx5aW95Y+LMTgy5aSpLOiupOivhuS6hjIwM+WkqeS6huOAgg==
//');
////        return view('home');
//    }


    public function index()
    {
        return view('pay.index');
    }


    public function push( )
    {

//        $deviceId = request()->get('device_id',$deviceId);
//
//        $data = [
//            'type' => 9,
//            'title' => $title,
//            'content' => $content,
//            'device_id'=> $deviceId,
//        ];
//
//        $push = app('PushManager')->driver('ge_tui');
//        $getuiResponse =  $push->pushOne($data);
//        $pushs =json_encode($push);
//        $res =json_encode($getuiResponse);
//        echo '<br>';
//        echo $pushs;
//        echo '<br>';
//        echo $res;
        echo "发送push 中";
        try{
            Log::info('testPush',[__METHOD__]);
            $deviceId='b2e5b64931f06f617e363b74c8057cf6';
            $title = 'getui test';
            $content = '123123,test 您负责的的工单已经追加元';

            $title = request()->get('title',$title);
            $content = request()->get('content',$content);
            $transContentArr = [
                'title' => $title,
                'content' => $content,
            ];

            $transContent = json_encode($transContentArr);
            $getuiResponse = app('GeTuiService')->pushToSignal($deviceId, $transContent, $content, $title);
            $res =json_encode($getuiResponse);
            Log::info($res, [__METHOD__]);
        }catch (\Exception $e){
            echo "Error : 错误".$e->getMessage();
        }

    }
}
