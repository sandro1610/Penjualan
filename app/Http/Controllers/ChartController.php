<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
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

    public function chart1C1(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','1')
                    ->where('cluster','=','C1')
                    ->get();
        return response()->json($result);
    }
    
    public function chart1C2(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','1')
                    ->where('cluster','=','C2')
                    ->get();
        return response()->json($result);
    }

    public function chart2C1(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','2')
                    ->where('cluster','=','C1')
                    ->get();
        return response()->json($result);
    }
    
    public function chart2C2(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','2')
                    ->where('cluster','=','C2')
                    ->get();
        return response()->json($result);
    }
    public function chart3C1(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','3')
                    ->where('cluster','=','C1')
                    ->get();
        return response()->json($result);
    }
    public function chart3C2(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','3')
                    ->where('cluster','=','C2')
                    ->get();
        return response()->json($result);
    }
    public function chart4C1(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','4')
                    ->where('cluster','=','C1')
                    ->get();
        return response()->json($result);
    }
    public function chart4C2(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','4')
                    ->where('cluster','=','C2')
                    ->get();
        return response()->json($result);
    }
    public function chart5C1(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','5')
                    ->where('cluster','=','C1')
                    ->get();
        return response()->json($result);
    }
    public function chart5C2(Request $request)
    {
        $currentTime = Carbon::now();
        $month = $currentTime->month;
        $result = DB::table('produks')
                    ->whereMonth('created_at', $month)
                    ->where('id_jenis','=','5')
                    ->where('cluster','=','C2')
                    ->get();
        return response()->json($result);
    }
}
