<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class MakananBeratController extends Controller
{
    public function index()
    {
        $produks = Produk::where('kategori', 'makanan_berat')->get();
        return view('makanan_berat', compact('produks'));
    }
}