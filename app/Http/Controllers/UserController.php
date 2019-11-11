<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisiMisi;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Hashids\Hashids;
use DataTables;
use Redirect,Response;

class UserController extends Controller
{
    public function index(Request $request){
        // return view('home');
        if(Session::get('login')){
            if(request()->ajax()) {
                return Datatables::of(VisiMIsi::all())
                ->addColumn('gambar', function($visimisi){
                    $url=$visimisi->gambar;
                    return '<img src="'.$url.'" border="0" width="100" class="img-rounded" align="center" />';
                })
                ->addColumn('action', 'kelola_visimisi/action_button')
                ->rawColumns(['gambar','action'])
                ->addIndexColumn()
                ->make(true);
            }
            return view('home');
        }
        else{
            return redirect('/admin/login')->with('alert','Kamu harus login dulu');
        }
    }
}
