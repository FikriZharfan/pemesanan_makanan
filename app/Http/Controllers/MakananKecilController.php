<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class MakananKecilController extends Controller
{
    public function index()
    {
        $produks = Produk::where('kategori', 'makanan_kecil')->get();
        return view('makanan_kecil', compact('produks'));
    }
}