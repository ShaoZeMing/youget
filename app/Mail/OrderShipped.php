<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderShipped extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $_err;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\Exception $e,$title='恭喜你出bug了')
    {

        $data = [
            'msg' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ];
        Log::info('错误对象',[$e,__METHOD__]);
        Log::info('错误对象',[$data,__METHOD__]);


        $this->_err = $data;
        $this->subject = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mail.test', $this->_err);
    }
}
