<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $error;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $error)
    {
        //
        $this->error = $error ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

            \Illuminate\Support\Facades\Mail::to('shao19920426@163.com')->send(new \App\Mail\OrderShipped( $this->error));
            $res = \Illuminate\Support\Facades\Mail::failures();
    }
}
