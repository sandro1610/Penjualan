<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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

    public function index(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $produk_jeniss = DB::table('produks')
                        ->whereMonth('created_at', $month)
                        ->groupBy('id_jenis')
                        ->selectRaw('id_jenis, sum(stok_awal) as sum_stok_awal, sum(terjual) as sum_terjual, sum(stok_kardus) as sum_stok_kardus')
                        ->get();
        $penjualans = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->selectRaw('sum(terjual) as sum_terjual')
                    ->get();
        $produks = Produk::whereMonth('created_at', $month)->get();
        $jml_produk = $produks->count();
        $cen_awal = Produk::whereMonth('created_at', $month)->whereIn('id', [$request->c1, $request->c2])->get();
        $jml_cen_awal = $cen_awal->count();
        if ($request->has('c1') && $request->has('c2')) {
            $jrk_awal=[];
            for ($i=0; $i < $jml_produk; $i++) { 
                $jrk_awal[$i]=array();
                $stok_awal = $produks[$i]->stok_awal;
                $terjual = $produks[$i]->terjual;
                $stok_akhir = $produks[$i]->stok_kardus;
                for ($c=0; $c < $jml_cen_awal; $c++) { 
                    $x = $stok_awal-$cen_awal[$c]->stok_awal;
                    $y = $terjual-$cen_awal[$c]->terjual;
                    $z = $stok_akhir-$cen_awal[$c]->stok_kardus;

                    $jrk_awal[$i][$c] = sqrt(($x*$x)+($y*$y)+($z*$z));
                    
                }
                if ($jrk_awal[$i][0]<$jrk_awal[$i][1]) {
                    $clus = 'C1';
                } else {
                    $clus = 'C2';
                }
                $produk = Produk::find($produks[$i]->id);
                $produk->cluster = $clus;
                $produk->save();
            }
            $cen = DB::table('produks')
                        ->whereMonth('created_at', $month)
                        ->groupBy('cluster')
                        ->selectRaw('avg(stok_awal) as avg_stok_awal, avg(terjual) as avg_terjual, avg(stok_kardus) as avg_stok_kardus')
                        ->get();
            $jml_cen = 2;
            $status = false;

            while ($status==false){
                $jrk=[];
                for ($i=0; $i < $jml_produk; $i++) { 
                    $jrk[$i]=array();
                    $stok_awal = $produks[$i]->stok_awal;
                    $terjual = $produks[$i]->terjual;
                    $stok_akhir = $produks[$i]->stok_kardus;
                    for ($c=0; $c < $jml_cen; $c++) { 
                        $x = $stok_awal-$cen[$c]->avg_stok_awal;
                        $y = $terjual-$cen[$c]->avg_terjual;
                        $z = $stok_akhir-$cen[$c]->avg_stok_kardus;
                        $jrk[$i][$c] = sqrt(($x*$x)+($y*$y)+($z*$z));
                    }
                    if ($jrk[$i][0]<$jrk[$i][1]) {
                        $clus = 'C1';
                    } else {
                        $clus = 'C2';
                    }
                    $produk = Produk::find($produks[$i]->id);
                    if ($clus == $produk->cluster) {
                        $status = true;
                    }else{
                        $status = false;
                    }
                    $produk->cluster = $clus;
                    $produk->save();
                }
            }
        }

        $collection_tinggi = Produk::whereMonth('created_at', $month)->where('cluster', 'C1')->get();
        $collection_rendah = Produk::whereMonth('created_at', $month)->where('cluster', 'C2')->get();
        $tampil_produk_tinggi = collect($collection_tinggi)->sortByDesc('terjual')->take(5);
        $tampil_produk_rendah = collect($collection_rendah)->sortBy('terjual')->take(5);
        return view('dashboard',['penjualans' => $penjualans,
                                 'tampil_produk_tinggi' => $tampil_produk_tinggi,
                                 'tampil_produk_rendah' => $tampil_produk_rendah,
                                 'produk_jeniss' => $produk_jeniss,
                                 'produks' => $produks]);
    }

}
