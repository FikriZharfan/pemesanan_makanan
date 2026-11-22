<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class MinumanController extends Controller
{
    public function index()
    {
        $produks = Produk::where('kategori', 'minuman')->get();
        return view('minuman', compact('produks'));
    }
}