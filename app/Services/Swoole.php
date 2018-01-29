<?php
/**
 *  MerchantAccountService.php
 *
 * @author gengzhiguo@xiongmaojinfu.com
 * $Id: MerchantAccountService.php 2017-06-21 下午2:35 $
 */


namespace App\Services;

use Illuminate\Support\Facades\Log;
use Payment\Common\PayException;
use Payment\Client\Charge;
use Payment\Config;


class Swoole
{

    public $server;
    public function __construct() {
        $this->server = new swoole_websocket_server("0.0.0.0", 9501);
        $this->server->on('open', function (swoole_websocket_server $server, $request) {
            echo "server: handshake success with fd{$request->fd}\n";
        });
        $this->server->on('message', function (swoole_websocket_server $server, $frame) {
            echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
            $server->push($frame->fd, "this is server");
        });
        $this->server->on('close', function ($ser, $fd) {
            echo "client {$fd} closed\n";
        });
        $this->server->on('request', function ($request, $response) {
            // 接收http请求从get获取message参数的值，给用户推送
            // $this->server->connections 遍历所有websocket连接用户的fd，给所有用户推送
            foreach ($this->server->connections as $fd) {
                $this->server->push($fd, $request->get['message']);
            }
        });
        $this->server->start();
    }



}
