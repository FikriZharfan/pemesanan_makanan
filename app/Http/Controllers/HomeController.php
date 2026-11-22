<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    $todayTotal = \App\Models\Pemesanan::whereDate('created_at', now()->toDateString())->sum('total');
    $todayUsers = \App\Models\Pemesanan::whereDate('created_at', now()->toDateString())->count();
    $allTotal = \App\Models\Pemesanan::sum('total');
    $allUsers = \App\Models\Pemesanan::count();
    return view('home', compact('todayTotal', 'todayUsers', 'allTotal', 'allUsers'));
    }
}
