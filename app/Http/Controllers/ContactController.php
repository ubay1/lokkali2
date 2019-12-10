<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Mail\SendEmailContact;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ServiceNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Images;
use Validator;
use App\User;
use Carbon\Carbon;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'file'=>'required|mimes:pdf,jpeg,jpg,png,docx,doc|max:10000'
        ]);

        if($validator->fails()){
            if ($validator->errors()->first('name')) {
                return response()->json([
                    'message'    => $validator->errors()->first('name'),
                    'success'    => false,
                    'status_code' => 4001,
                    'error'      => $validator->errors()->first('name'),
                    'data'       => null,
                ]);
            }elseif ($validator->errors()->first('email')) {
                return response()->json([
                    'message'    => $validator->errors()->first('email'),
                    'success'    => false,
                    'status_code' => 4001,
                    'error'      => $validator->errors()->first('email'),
                    'data'       => null,
                ]);
            }elseif ($validator->errors()->first('subject')) {
                return response()->json([
                    'message'    => $validator->errors()->first('subject'),
                    'success'    => false,
                    'status_code' => 4001,
                    'error'      => $validator->errors()->first('subject'),
                    'data'       => null,
                ]);
            }elseif ($validator->errors()->first('message')) {
                return response()->json([
                    'message'    => $validator->errors()->first('message'),
                    'success'    => false,
                    'status_code' => 4001,
                    'error'      => $validator->errors()->first('message'),
                    'data'       => null,
                ]);
            } elseif ($validator->errors()->first('file')) {
                return response()->json([
                    'message'    => $validator->errors()->first('file'),
                    'success'    => false,
                    'status_code' => 4001,
                    'error'      => $validator->errors()->first('file'),
                    'data'       => null,
                ]);
            }
        }else{
            $name = $request->name;
            $email = $request->email;
            $subject = $request->subject;
            $message = $request->message;
            $file    = $request->file('file');

            // $ext = $file->getClientOriginalExtension();
            // $name = $file->getClientOriginalName();
            // $newName = md5(Carbon::now('Asia/Jakarta')->toDateTimeString()).'_'.$name;
            // $file->move('uploads/pdf',$newName);

            // $file = Storage::files('uploads/pdf/'.$newName);

	        $objDemo = new \stdClass();
            $objDemo->name =  $name;
            $objDemo->email =  $email;
            $objDemo->subject =  $subject;
            $objDemo->message =  $message;
            $objDemo->file    =  $file;

            Mail::to("info@lokkali.co.id")->send(new SendEmailContact($objDemo));

            return response()->json([
                'message'    => 'terima kasih atas partisipasinya',
                'success'    => true,
                'status_code' => 200,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
