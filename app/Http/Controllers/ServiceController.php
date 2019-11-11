<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ServiceNotification;
use Illuminate\Notifications\Notifiable;
use Validator;
use App\User;


class ServiceController extends Controller
{
    use Notifiable;

    public function index()
    {
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'industry' => 'required',
            'message' => 'required',
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
            }elseif ($validator->errors()->first('industry')) {
                return response()->json([
                    'message'    => $validator->errors()->first('industry'),
                    'success'    => false,
                    'status_code' => 4001,
                    'error'      => $validator->errors()->first('industry'),
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
            }
        }else{
            $name = $request->name;
            $email = $request->email;
            $industry = $request->industry;
            $picked = $request->picked;
            $message = $request->message;

            // return $picked;

	        $objDemo = new \stdClass();
            $objDemo->name =  $name;
            $objDemo->email =  $email;
            $objDemo->industry =  $industry;
            $objDemo->picked =  $picked;
            $objDemo->message =  $message;

            Mail::to("lokkaliindo@gmail.com")->send(new SendEmail($objDemo));

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
