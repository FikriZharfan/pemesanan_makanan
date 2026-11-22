<?php
namespace App\Observers;

use App\Models\Pemesanan;
use App\Models\Produk;

class PemesananObserver
{
    public function created(Pemesanan $pemesanan)
    {
        $items = json_decode($pemesanan->items, true);
        foreach ($items as $item) {
            if (isset($item['id'])) {
                $produk = Produk::find($item['id']);
            } else {
                $produk = Produk::where('nama', $item['name'])->first();
            }
            if ($produk) {
                $produk->decrement('stok', $item['qty']);
                \Log::info('Stok dikurangi', [
                    'produk_id' => $produk->id,
                    'nama' => $produk->nama,
                    'qty' => $item['qty'],
                    'stok_sisa' => $produk->stok
                ]);
            } else {
                \Log::warning('Produk tidak ditemukan saat pengurangan stok', [
                    'id_cart' => $item['id'] ?? null,
                    'nama_cart' => $item['name']
                ]);
            }
        }
    }
}
