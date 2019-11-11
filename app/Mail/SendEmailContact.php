<?php

namespace App\Mail;


use Config;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Factory;
use Images;
use Carbon\Carbon;

class SendEmailContact extends Mailable
{
    use Queueable, SerializesModels;

    public $demo;

    public function __construct($demo)
    {
        $this->demo = $demo;
    }

    public function build(Request $request)
    {
        $file    = $request->file('file');

        $ext = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        $newName = md5(Carbon::now('Asia/Jakarta')->toDateTimeString()).'_'.$name;
        $file->move(storage_path('app/public/uploads/pdf/'),$newName);

        // folder storage
        $file = storage_path('app/public/uploads/pdf/'.$newName);

        return $this->from($request->email, $request->name)
                    ->subject('Contact Email')
                    ->attach($file, [
                        'as' => 'CV '.$request->name,
                        'mime' => 'application/pdf',
                    ])
                    ->view('email_contact.information');
    }
}
