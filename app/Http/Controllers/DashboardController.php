<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penjualan;
use Illuminate\Http\Request;

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

    public function index()
    {
    $currentTime = Carbon::now();
    $month = $currentTime->month;
    $penjualans = Penjualan::whereMonth('created_at', $month)->count();
    
    return view('dashboard',['penjualans' => $penjualans, 'month' => $month]);
    }
}
