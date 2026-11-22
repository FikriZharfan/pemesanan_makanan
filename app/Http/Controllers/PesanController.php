<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PesanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'bangku' => 'required|string|max:10',
            'pembayaran' => 'required|string|in:Kasir,QRIS',
            'cart' => 'required|array',
        ]);
        $total = collect($validated['cart'])->sum(function($i) {
            return $i['price'] * $i['qty'];
        });
        Pemesanan::create([
            'nama' => $validated['nama'],
            'bangku' => $validated['bangku'],
            'pembayaran' => $validated['pembayaran'],
            'items' => json_encode($validated['cart']),
            'total' => $total
            ,'status' => 'baru'
        ]);
        return response()->json(['success' => true]);
    }

    public function changeStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:baru,diproses,siap,selesai,dibatalkan'
        ]);
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->update(['status' => $validated['status']]);
        return redirect()->route('pemesanan')->with('success', 'Status pesanan diperbarui');
    }

    public function edit($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        return view('edit_pesanan', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'bangku' => 'required|string|max:10',
            'pembayaran' => 'required|string|in:Kasir,QRIS',
        ]);
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->update($validated);
        return redirect()->route('pemesanan')->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pesanan = Pemesanan::findOrFail($id);
        $pesanan->delete();
        return redirect()->route('pemesanan')->with('success', 'Pesanan berhasil dihapus');
    }

    public function cetak(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $query = \App\Models\Pemesanan::query();
        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('created_at', [
                $tanggal_awal . ' 00:00:00',
                $tanggal_akhir . ' 23:59:59'
            ]);
        } elseif ($tanggal_awal) {
            $query->whereDate('created_at', $tanggal_awal);
        } elseif ($tanggal_akhir) {
            $query->whereDate('created_at', $tanggal_akhir);
        }
        $pemesanans = $query->latest()->get();
        $pdf = \PDF::loadView('laporan_pemesanan_pdf', [
            'pemesanans' => $pemesanans,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'pdfMode' => true
        ]);
        return $pdf->download('laporan_pemesanan.pdf');
    }
}
