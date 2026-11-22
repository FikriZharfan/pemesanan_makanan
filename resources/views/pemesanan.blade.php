@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h2 class="mb-6 text-light font-bold text-3xl text-blue-600">Daftar Pesanan</h2>
  <div class="row mb-4 align-items-end">
    <div class="col-md-8">
      <form action="{{ route('pemesanan.cetak') }}" method="GET" class="d-flex gap-2 align-items-end">
        <div>
          <label for="tanggal_awal" class="text-light form-label mb-1">Dari Tanggal</label>
          <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
        </div>
        <div>
          <label for="tanggal_akhir" class="text-light form-label mb-1">Sampai Tanggal</label>
          <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>
        <div>
          <button type="submit" class="btn btn-outline-light shadow rounded-3 mt-3">
            <i class="fa fa-print me-1"></i> Cetak Laporan
          </button>
        </div>
      </form>
    </div>
  </div>
  <div class="row g-4">
    @forelse($pesanans as $pesanan)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card border-0 shadow-lg rounded-4 h-100" style="background: linear-gradient(135deg,#ffffff 85%,#f1f5ff 100%); overflow: hidden;">
          <div class="d-flex">
            <div class="p-3 d-flex flex-column justify-content-center align-items-center" style="min-width:80px; gap:12px;">
              <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-warning d-inline-flex align-items-center justify-content-center" title="Edit" style="width:44px; height:44px; border-radius:8px; color:#111; font-weight:700;">
                <i class="fas fa-edit" aria-hidden="true"></i>
              </a>
              <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger d-inline-flex align-items-center justify-content-center" title="Hapus" onclick="return confirm('Yakin hapus pesanan ini?')" style="width:44px; height:44px; border-radius:8px; background:#dc3545; color:#fff; border:2px solid #dc3545;">
                  <i class="fas fa-trash" aria-hidden="true"></i>
                </button>
              </form>
            </div>
            <div class="card-body p-4 flex-grow-1">
              <div class="text-center mb-3">
                <h5 class="card-title mb-1 text-dark" style="font-weight:700;">{{ $pesanan->nama }}</h5>
                <div class="d-flex justify-content-center gap-2 mt-2">
                  <span class="badge bg-light text-dark" style="font-weight:700;">Bangku: {{ $pesanan->bangku }}</span>
                  <span class="badge bg-success text-white" style="font-weight:700;">{{ $pesanan->pembayaran }}</span>
                  <span class="badge bg-warning text-dark" style="font-weight:700;">{{ ucfirst($pesanan->status) }}</span>
                </div>
              </div>
              <ul class="list-unstyled mb-3">
                @foreach(json_decode($pesanan->items, true) as $item)
                  <li class="d-flex justify-content-between align-items-start py-1 border-bottom">
                    <div>
                      <div class="fw-semibold">{{ $item['name'] }}</div>
                      <small class="text-muted">x {{ $item['qty'] }}</small>
                    </div>
                    <div class="fw-bold">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                  </li>
                @endforeach
              </ul>
              <div class="d-flex justify-content-between align-items-center">
                <div class="fw-bold" style="font-size:1.05rem;">Total:</div>
                <div class="badge bg-light text-dark fs-5" style="font-weight:700;">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</div>
              </div>
              <div class="border-top pt-3 mt-3">
                <small class="text-muted d-block mb-2"><i class="fa fa-clock me-1"></i> {{ $pesanan->created_at->format('d-m-Y H:i') }}</small>
                <form action="{{ route('pesanan.status', $pesanan->id) }}" method="POST">
                  @csrf
                  <div class="d-flex gap-2 w-100" style="flex-wrap: wrap;">
                    <select name="status" class="form-select form-select-sm" style="flex: 1; min-width: 100px;">
                      <option value="baru" {{ $pesanan->status=='baru' ? 'selected' : '' }}>Baru</option>
                      <option value="diproses" {{ $pesanan->status=='diproses' ? 'selected' : '' }}>Diproses</option>
                      <option value="siap" {{ $pesanan->status=='siap' ? 'selected' : '' }}>Siap</option>
                      <option value="selesai" {{ $pesanan->status=='selesai' ? 'selected' : '' }}>Selesai</option>
                      <option value="dibatalkan" {{ $pesanan->status=='dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary" style="font-weight:700; background:#0d6efd; color:#fff; border:none;">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info text-center py-4 rounded-3 shadow-sm">Belum ada pesanan.</div>
      </div>
    @endforelse
  </div>
</div>
<style>
.card:hover {
  box-shadow: 0 8px 32px 0 rgba(60,72,180,0.15), 0 1.5px 6px 0 rgba(60,72,180,0.10);
  transform: translateY(-4px) scale(1.02);
  transition: all 0.2s;
}
</style>
@endsection