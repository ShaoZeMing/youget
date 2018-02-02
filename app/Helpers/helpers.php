<?php

if (!function_exists('sendErrorMail')) {
    function sendErrorMail(\Exception $e,$title='恭喜你出了一个bug')
    {
        try{
            \Illuminate\Support\Facades\Mail::to(config('mail.err_to_mail'))->send(new \App\Mail\OrderShipped($e,$title));
        }catch (\Exception $e){
            \Illuminate\Support\Facades\Log::error('发送错误邮件失败');
        }

    }
}