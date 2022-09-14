<?php

namespace App\Http\Controllers;

use App\Models\Retur;
use App\Models\Produk;
use Illuminate\Http\Request;

class ReturController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $produks = Produk::all();
        $returs = Retur::LeftJoin("produks", function ($join) {
                  $join->on("produks.id", "=", "produk_id");
                  })->select('returs.*', 'produks.nama_produk', 'produks.no_produk')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return datatables()->of($returs)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post">Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('retur', ['produks' => $produks]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pimpinan(Request $request)
    {   
        $produks = Produk::all();
        $returs = Retur::LeftJoin("produks", function ($join) {
                  $join->on("produks.id", "=", "produk_id");
                  })->select('returs.*', 'produks.nama_produk', 'produks.no_produk')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return datatables()->of($returs)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post">Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('pimpinan.retur', ['produks' => $produks]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        
        $post   =   Retur::updateOrCreate(['id' => $id],
                    [
                        'produk_id' => $request->produk_id,
                        'kardus' => $request->kardus,
                    ]); 

        return response()->json($post);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Retur::where($where)->first();
     
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Retur::where('id',$id)->delete();
     
        return response()->json($post);
    }
}
