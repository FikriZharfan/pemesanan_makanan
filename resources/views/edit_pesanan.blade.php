@extends('layouts.app')
@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height:60vh;">
  <div class="card shadow-lg rounded-4 p-5 w-100" style="max-width:500px; background:rgba(255,255,255,0.95);">
    <h2 class="mb-4 font-bold text-2xl text-blue-700 text-center">Edit Pesanan</h2>
    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-4">
        <label for="nama" class="form-label fw-bold text-dark">Nama</label>
        <input type="text" class="form-control form-control-lg" id="nama" name="nama" value="{{ $pesanan->nama }}" required style="width:100%;">
      </div>
      <div class="mb-4">
        <label for="bangku" class="form-label fw-bold text-dark">Nomor Bangku</label>
        <input type="text" class="form-control form-control-lg" id="bangku" name="bangku" value="{{ $pesanan->bangku }}" required style="width:100%;">
      </div>
      <div class="mb-4">
        <label for="pembayaran" class="form-label fw-bold text-dark">Metode Pembayaran</label>
        <select class="form-select form-select-lg" id="pembayaran" name="pembayaran" required style="width:100%;">
          <option value="Kasir" @if($pesanan->pembayaran=='Kasir') selected @endif>Kasir</option>
          <option value="QRIS" @if($pesanan->pembayaran=='QRIS') selected @endif>QRIS</option>
        </select>
      </div>
      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-primary btn-lg px-4 d-flex align-items-center" style="background:#2563eb; color:#fff; font-weight:700; font-size:1.1rem; border:2px solid #2563eb;">
          <i class="fa fa-save me-2"></i> Simpan Perubahan
        </button>
        <a href="{{ route('pemesanan') }}" class="btn btn-secondary btn-lg px-4 d-flex align-items-center">
          <i class="fa fa-arrow-left me-2"></i> Batal
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
