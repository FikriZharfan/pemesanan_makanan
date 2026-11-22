@extends('layouts.app')
@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow rounded-4">
        <div class="card-header bg-warning text-white rounded-top-4 text-center">
          <h2 class="mb-0 font-bold">Tambah Produk Makanan</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Produk</label>
              <input type="text" name="nama" id="nama" class="form-control rounded-3" required>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" name="harga" id="harga" class="form-control rounded-3" required>
            </div>
            <div class="mb-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="number" name="stok" id="stok" class="form-control rounded-3" required min="0">
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <select name="kategori" id="kategori" class="form-select rounded-3" required>
                <option value="makanan_berat">Makanan Berat</option>
                <option value="makanan_kecil">Makanan Kecil</option>
                <option value="minuman">Minuman</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="gambar" class="form-label">Gambar Produk</label>
              <input type="file" name="gambar" id="gambar" class="form-control rounded-3" accept="image/*">
            </div>
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-success btn-sm rounded-3" style="z-index:2; position:relative; font-size:1rem; font-weight:bold; background:#198754; color:#fff; border:2px solid #198754;">Simpan</button>
              <a href="{{ route('produk.index') }}" class="btn btn-secondary px-4 py-2 rounded-3 w-50 text-center" style="font-size:1.2rem; font-weight:bold;">Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
