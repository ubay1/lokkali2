<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPopuler;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DataTables;
use Redirect,Response;
use Config;

class BlogPopulerController extends Controller
{
    public function index() {
        if(Session::get('login')){
            if(request()->ajax()) {
                return Datatables::of(BlogPopuler::all())
                ->addColumn('gambar', function($blog){
                    $url=$blog->gambar;
                    return '<img src="'.$url.'" border="0" width="100" class="img-rounded" align="center" />';
                })
                ->addColumn('action', 'kelola_blog_populer/action_button')
                ->rawColumns(['gambar','action'])
                ->addIndexColumn()
                ->make(true);
            }
            return view('kelola_blog_populer/index');
        }
        else{
            return redirect('/admin/login')->with('alert','Kamu harus login dulu');
        }
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $user   =  new BlogPopuler();
        // $user->header = $request->teks_header;
        $images = $request->file('gambar');
            $ext = $images->getClientOriginalExtension();
            $image_name = rand(100000,1001238912).md5($images->getClientOriginalName()).'.'.$ext;
            $images->move('uploads/blog',$image_name);

        $user->gambar = Config('app.url').'uploads/blog/'.$image_name;
        $user->judul = $request->judul;
        $user->isi = $request->isi;
        $user->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $user->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $user->save();

        return Response::json($user);
    }

    public function show($id)
    {
        $where = array('id' => $id);
        $user  = BlogPopuler::where($where)->first();

        return Response::json($user);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = BlogPopuler::where($where)->first();

        return Response::json($user);
    }

    public function update(Request $request)
    {
        $picturebaru = $request->gambarlama;
        $images = $request->file('gambarbaru');

        if ($images != '') {
            $rules = array(
                'gambarbaru' => 'required',
                'judul2' => 'required',
                'isi2' => 'required'
            );

            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {
                return response()->json([
                    'error'=>$validator->errors()->all()
                ]);
            }

            $data2 = DB::table('blog_populer')
            ->where('id','=', $request->id)
            ->first();

            File::delete('uploads/blog/'.str_replace(config('app.url')."uploads/blog/",'',$data2->gambar));

            $ext = $images->getClientOriginalExtension();
            $image_name = rand(100000,1001238912).md5($images->getClientOriginalName()).'.'.$ext;
            $images->move('uploads/blog',$image_name);

            $form_data = array(
                'gambar' => Config('app.url').'uploads/blog/'.$image_name,
                'judul' => $request->judul2,
                'isi' => $request->isi2,
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            );
        }
        else{
            $rules = array(
                'judul2' => 'required',
                'isi2' => 'required'
            );

            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {
                return response()->json([
                    'error'=>$validator->errors()->all()
                ]);
            }

            $form_data = array(
                'judul' => $request->judul2,
                'isi' => $request->isi2,
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            );
        }

        BlogPopuler::where('id',$request->id)->update($form_data);

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
        $data2 = DB::table('blog_populer')
        ->where('id','=', $id)
        ->first();

        File::delete('uploads/blog/'.str_replace(config('app.url')."uploads/blog/",'',$data2->gambar));

        // $jabatan = Session::get('jabatan');
        $data2 = DB::table('blog_populer')
        ->where('id','=', $id)
        ->delete();

        $res['data']= array(
            'message'=>'success delete'
        );

        return response($res);
    }

    // for admin
    public function getallblogadmin(){
        $data = BLog::all();

        return $data;
    }

    // user
    public function getAllBLogPaginate(){
        $blog = BlogPopuler::orderBy('id','desc')->paginate(6);
        return $blog;
    }

    public function getAllBLogPaginateSearch(Request $request){
        $search = $request->search;
        $blog = BlogPopuler::orderBy('id','desc')->where('judul', 'like', '%'.$search.'%')->paginate(6);
        return $blog;
    }

    // public function getAllBLogPaginateSearch2(Request $request){
    //     $blog = BlogPopuler::orderBy('id','desc')->where('judul', 'like', '%'.$request->judul.'%')->paginate(6);
    //     return $blog;
    // }

    public function getAllBlog(){
        $data = BlogPopuler::orderBy('id','desc')->get();

        return response()->json([
            'message'=>'sukses load',
            'status'=>'ok',
            'articles'=>$data
        ]);
    }

    public function getAllBlogPopuler(){
        $data = BlogPopuler::first();

        return response()->json([
            'message'=>'sukses load',
            'status'=>'ok',
            'articles'=>$data
        ]);
    }
}
