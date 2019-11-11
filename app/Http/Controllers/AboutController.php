<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutDesign;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DataTables;
use Redirect,Response;
use config;

class AboutController extends Controller
{
    public function index()
    {
        if(Session::get('login')){
            if(request()->ajax()) {
                return Datatables::of(AboutDesign::all())
                ->addColumn('gambar', function($about){
                    $url=$about->gambar;
                    return '<img src="'.$url.'" border="0" width="100" class="img-rounded" align="center" />';
                })
                ->addColumn('action', 'kelola_about/action_button')
                ->rawColumns(['gambar','action'])
                ->addIndexColumn()
                ->make(true);
            }
            return view('kelola_about/index');
        }
        else{
            return redirect('/admin/login')->with('alert','Kamu harus login dulu');
        }
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
        $user   =  new Teknisi();
        $user->id = $request->user_id;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $user->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $user->save();

        return Response::json($user);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $user  = AboutDesign::where($where)->first();

        return Response::json($user);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = AboutDesign::where($where)->first();

        return Response::json($user);
    }

    public function update(Request $request)
    {
        $picturebaru = $request->gambarlama;
        $images = $request->file('gambarbaru');

        if ($images != '') {
            $rules = array(
                'gambarbaru' => 'required',
                'judul' => 'required',
                'isi' => 'required'
            );

            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {
                return response()->json([
                    'error'=>$validator->errors()->all()
                ]);
            }

            $data2 = DB::table('about_design')
            ->where('id','=', $request->id)
            ->first();

            File::delete('uploads/about/'.str_replace(config('app.url')."uploads/about/",'',$data2->gambar));

            $ext = $images->getClientOriginalExtension();
            $image_name = rand(100000,1001238912).md5($images->getClientOriginalName()).'.'.$ext;
            $images->move('uploads/about/',$image_name);

            $form_data = array(
                'gambar' => config('app.url')."uploads/about/".$image_name,
                "judul"  => $request->judul,
                "isi"    => $request->isi,
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            );
        }
        else{
            $rules = array(
                'judul' => 'required',
                'isi' => 'required'
            );

            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {
                return response()->json([
                    'error'=>$validator->errors()->all()
                ]);
            }

            $form_data = array(
                "judul"  => $request->judul,
                "isi"    => $request->isi,
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            );
        }

        AboutDesign::where('id',$request->id)->update($form_data);

            return response()->json([
                'data'=>[
                'success' => true,
                'statuscode' =>2001,
                'message' => 'Data sukses diupdate',
                'data' => $form_data,
                ]
            ]);
    }

    public function destroy($id)
    {
        $data = AboutDesign::where('id', $id)->delete();

        return response()->json($data, 200);
    }

    public function getAllAbout(){
        $data = AboutDesign::all();

        return response()->json($data, 200);
    }
}
