<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use PDF;

class PenjualanController extends Controller
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
        $penjualans = Penjualan::LeftJoin("produks", function ($join) {
                      $join->on("produks.id", "=", "produk_id");
                      })->select('penjualans.*', 'produks.nama_produk', 'produks.no_produk')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return datatables()->of($penjualans)
                        ->addColumn('action', function($data){
                            $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('penjualan', ['produks' => $produks]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pimpinan(Request $request)
    {
        $produks = Produk::all();
        $penjualans = Penjualan::LeftJoin("produks", function ($join) {
                      $join->on("produks.id", "=", "produk_id");
                      })->select('penjualans.*', 'produks.nama_produk', 'produks.no_produk')->orderBy('created_at', 'desc')->get();
        if($request->ajax()){
            return datatables()->of($penjualans)
                        ->addColumn('action', function($data){
                            $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';     
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('pimpinan.penjualan', ['produks' => $produks]);
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
        
        $post   =   Penjualan::updateOrCreate(['id' => $id],
                    [
                        'produk_id' => $request->produk_id,
                        'kardus' => $request->kardus,
                    ]);
        // if (!empty($request->id)) {
            // $penjualan = Penjualan::findOrFail($request->id);
            // $produk = Produk::findOrFail($request->produk_id);
            // $selisih_kardus = $penjualan->kardus - $request->kardus;
            // $selisih_satuan = $penjualan->satuan - $request->satuan;
            // if ($selisih_kardus<0) {
            //     $produk->stok_kardus += $selisih_kardus;
            // }elseif($selisih_kardus>=0){
            //     $produk->stok_kardus -= $selisih_kardus;
            // }
            // if ($selisih_satuan<0) {
            //     $produk->stok_satuan += $selisih_satuan;
            // }elseif($selisih_satuan>=0){
            //     $produk->stok_satuan -= $selisih_satuan;
            // }
            // $produk->save();
        // }elseif (empty($request->id)) {
            $produk = Produk::findOrFail($request->produk_id);
            $produk->stok_kardus -= $request->kardus;
            $produk->terjual += $request->kardus;
            $produk->save();
        // }

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
        $post  = Penjualan::where($where)->first();
     
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
        $penjualan = Penjualan::findOrFail($id);
        $produk = Produk::findOrFail($penjualan->produk_id);
        $produk->stok_kardus += $penjualan->kardus;
        $produk->terjual -= $penjualan->kardus;
        $produk->save();
        
        $post = Penjualan::where('id',$id)->delete();
     
        return response()->json($post);
    }
    
    public function cetak_pdf()
    {
    	$penjualan = Penjualan::LeftJoin("produks", function ($join) {
            $join->on("produks.id", "=", "produk_id");
            })->select('penjualans.*', 'produks.nama_produk', 'produks.no_produk')->orderBy('created_at', 'desc')->get();

    	$pdf = PDF::loadview('cetakPenjualan',['penjualan'=>$penjualan]);
    	return $pdf->stream();
    }
}
