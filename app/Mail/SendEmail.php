<?php

namespace App\Mail;


use Config;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $demo;

    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    public function build(Request $request)
    {
        return $this->from($request->email, $request->name)
                    ->subject('Service Email')
                    ->view('email_service.information');
    }
}
