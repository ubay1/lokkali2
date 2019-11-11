<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisiMisi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DataTables;
use Redirect,Response;

class VisiMisiController extends Controller
{
    public function index()
    {
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
            return view('kelola_visimisi/index');
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

    }

    public function store(Request $request)
    {
        $rules = array(
            'gambar' => 'required',
            'isi' => 'required'
        );

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()->all()
            ]);
        }

        // $save_visimisi = new VisiMisi();
        $images = $request->file('gambar');
        $ext = $images->getClientOriginalExtension();
        $image_name = rand(100000,1001238912).md5($images->getClientOriginalName()).'.'.$ext;
        $images->move('uploads/visimisi/',$image_name);

        $form_data = array(
            'gambar' => config('app.url')."uploads/visimisi/".$image_name,
            'isi'    => $request->isi,
            'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
        );

        VisiMisi::insert($form_data);

        return response()->json([
                'data'=>[
                'success' => true,
                'statuscode' =>2001,
                'message' => 'Data sukses disimpan',
                'data' => $form_data,
                ]
        ]);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $user  = VisiMIsi::where($where)->first();

        return Response::json($user);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = VisiMIsi::where($where)->first();

        return Response::json($user);
    }

    public function update(Request $request)
    {
        $picturebaru = $request->gambarlama;
        $images = $request->file('gambarbaru');

        if ($images != '') {
            $rules = array(
                'gambarbaru' => 'required',
                'isi2' => 'required'
            );

            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {
                return response()->json([
                    'error'=>$validator->errors()->all()
                ]);
            }

            $data2 = DB::table('visimisi_design')
            ->where('id','=', $request->id)
            ->first();

            File::delete('uploads/visimisi/'.str_replace(config('app.url')."uploads/visimisi/",'',$data2->gambar));

            $ext = $images->getClientOriginalExtension();
            $image_name = rand(100000,1001238912).md5($images->getClientOriginalName()).'.'.$ext;
            $images->move('uploads/visimisi/',$image_name);

            $form_data = array(
                'gambar' => config('app.url')."uploads/visimisi/".$image_name,
                'isi'    => $request->isi2,
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            );
        }
        else{
            $rules = array(
                'isi2' => 'required'
            );

            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {
                return response()->json([
                    'error'=>$validator->errors()->all()
                ]);
            }

            $form_data = array(
                'isi' => $request->isi2,
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            );
        }

        VisiMisi::where('id',$request->id)->update($form_data);

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
        $data2 = DB::table('visimisi_design')
        ->where('id','=', $id)
        ->first();

        File::delete('uploads/visimisi/'.str_replace(config('app.url')."uploads/visimisi/",'',$data2->gambar));

        // $jabatan = Session::get('jabatan');
        $data2 = DB::table('visimisi_design')
        ->where('id','=', $id)
        ->delete();

        $res['data']= array(
            'message'=>'success delete'
        );

        return response($res);
    }

    public function getAllVisimisi(){
        $data = VisiMisi::all();

        return response()->json($data, 200);
    }
}
