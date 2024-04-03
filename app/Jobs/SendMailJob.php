<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail_to;
    protected $title;
    protected $data;
    protected $view;


    public function __construct($mail_to, $title, $view, $data)
    {
        $this->mail_to = $mail_to;
        $this->title = $title;
        $this->data = $data;
        $this->view = $view;

    }


    public function handle(): void
    {
        Mail::to($this->mail_to)->send(new SendMail($this->title, $this->view, $this->data));
    }
}
