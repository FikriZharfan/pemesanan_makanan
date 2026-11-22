<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemesanan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Pemesanan</h2>
    @if(!isset($pdfMode) || !$pdfMode)
      <form method="GET" action="{{ route('pemesanan.cetak') }}" class="mb-4 d-flex gap-2 align-items-center">
        <label for="tanggal" class="form-label mb-0">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}" required>
        <button type="submit" class="btn btn-primary">Cetak PDF</button>
      </form>
    @endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No Bangku</th>
                <th>Menu</th>
                <th>Total</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemesanans as $index => $pemesanan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pemesanan->nama }}</td>
                <td>{{ $pemesanan->no_bangku ?? $pemesanan->bangku ?? '-' }}</td>
                <td>
                  @php
                    $items = isset($pemesanan->items) ? json_decode($pemesanan->items, true) : [];
                  @endphp
                  @if($items)
                    @foreach($items as $item)
                      {{ $item['name'] }} x{{ $item['qty'] }}<br>
                    @endforeach
                  @else
                    {{ $pemesanan->menu ?? '-' }}
                  @endif
                </td>
                <td>Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</td>
                <td>{{ $pemesanan->metode_pembayaran ?? $pemesanan->pembayaran ?? '-' }}</td>
                <td>{{ $pemesanan->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="text-align:right;">Dicetak pada: {{ date('d-m-Y H:i') }}</p>
</body>
</html>
