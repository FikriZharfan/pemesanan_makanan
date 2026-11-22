@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h2 class="mb-4 text-light font-bold text-2xl">Daftar Produk Makanan</h2>
  <a href="{{ route('produk.create') }}" class="btn btn-outline-light mb-3">Tambah Produk</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($produks as $produk)
      <tr>
        <td>{{ $produk->nama }}</td>
        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
        <td>{{ $produk->stok }}</td>
        <td>
          <img src="{{ asset('img/' . $produk->gambar) }}" alt="{{ $produk->nama }}" style="width:60px; height:60px; object-fit:cover; border-radius:8px; margin-bottom:6px; display:block;">
        </td>
        <td>
          <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm me-1"><i class="fa fa-edit"></i> Edit</a>
          <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm d-inline-flex align-items-center" style="vertical-align:middle; background:#dc3545; color:#fff; border:1px solid #dc3545; font-weight:bold;"> 
              <i class="fa fa-trash me-1"></i> Hapus
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
