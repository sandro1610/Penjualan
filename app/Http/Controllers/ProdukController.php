<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Jenis;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
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
        $jeniss = Jenis::all();
        $produks = Produk::LeftJoin("jenis", function ($join) {
            $join->on("jenis.id", "=", "id_jenis");
            })->select('produks.*', 'jenis.nama_jenis')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return datatables()->of($produks)
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

        return view('produk',['jeniss'=>$jeniss]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pimpinan(Request $request)
    {
        $jeniss = Jenis::all();
        $produks = Produk::LeftJoin("jenis", function ($join) {
            $join->on("jenis.id", "=", "id_jenis");
            })->select('produks.*', 'jenis.nama_jenis')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return datatables()->of($produks)
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

        return view('pimpinan.produk',['jeniss'=>$jeniss]);

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
        
        $post   =   Produk::updateOrCreate(['id' => $id],
                    [
                        'no_produk' => $request->no_produk,
                        'id_jenis' => $request->id_jenis,
                        'nama_produk' => $request->nama_produk,
                        'stok_kardus' => $request->stok_kardus,
                        'stok_awal' => $request->stok_kardus,
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
        $post  = Produk::where($where)->first();
     
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
        $post = Produk::where('id',$id)->delete();
     
        return response()->json($post);
    }

    public function cetak_pdf()
    {
        
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $tampil_produk = Produk::whereMonth('created_at', $month)->get();

    	$pdf = PDF::loadview('cetakProduk',['tampil_produk'=>$tampil_produk]);
    	return $pdf->stream();
        
    }
}
