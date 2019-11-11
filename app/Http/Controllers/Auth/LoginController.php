<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Hashids\Hashids;

class LoginController extends Controller
{
    public function login(){
        if(Session::get('email')){
            return redirect('/admin')->with('alert-sukses','Kamu sudah ada akses');
        }
        else{
            return view('login');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('admin/login')->with('alert-success','Kamu sudah logout');
    }

    public function loginpost(Request $request){
            $pesan = [
                "required"=>":attribute wajib diisi"
            ];

            $validator = Validator::make($request->all(), [
                'email'=>'required',
                'password'=>'required'
            ], $pesan);

            if ($validator->fails()) {
                if ($validator->errors()->first('email')) {
                    return response()->json([
                        'success'       => false,
                        'statuscode'    => 4001,
                        'message'       => $validator->errors()->first('email'),
                        'error'         => $validator->errors()->first('email'),
                        'data'          => null,
                    ]);
                } elseif ($validator->errors()->first('password')) {
                    return response()->json([
                        'success'       => false,
                        'statuscode'    => 4002,
                        'message'       => $validator->errors()->first('password'),
                        'error'         => $validator->errors()->first('password'),
                        'data'          => null,
                    ]);
                }
            }

            $Hashids  = new Hashids('',6);
            $email    = $request->input('email');
            $password = $request->input('password');
            $password = $Hashids->encode($password);

            $admin = Admin::all()->where('email', $email);

            if (sizeof($admin) <= 0 ) {
                return redirect('admin/login')->with('alert','data yang anda masukan tidak terdaftar !');
                // return response()->json([
                //     'data'=>[
                //         'success' => false,
                //         'statuscode' => 4002,
                //         'message' => 'data yang anda masukan tidak terdaftar'
                //     ]
                // ]);
            }else{
                if ($password != $admin[0]->password) {
                    return redirect('admin/login')->with('alert','password yang and masukan tidak sesuai !');
                    // return response()->json([
                    //     'data'=>[
                    //         'success' => false,
                    //         'statuscode' => 4001,
                    //         'message' => 'Password yang anda masukan salah'
                    //     ]
                    // ]);
                }else{
                    Session::put('id',$admin[0]->id);
                    Session::put('nama',$admin[0]->nama);
                    Session::put('email',$admin[0]->email);
                    Session::put('login','TRUE');
                    return redirect('/admin');
                    // return response()->json([
                    //     'data'=>[
                    //         'success' => true,
                    //         'statuscode' => 2001,
                    //         'message' => 'Selamat anda berhasil masuk',
                    //     ]
                    // ]);
                }
            }

    }
}
