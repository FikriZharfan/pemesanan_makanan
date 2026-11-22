<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Minuman</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
      <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <style>
        body { font-family: 'Nunito', sans-serif; background-color: #ffffff; }
        .category-card { transition: transform 0.3s, box-shadow 0.3s; border-radius: 1rem; overflow: hidden; }
        .category-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); }
        .category-title { font-weight: 700; }
        .category-badge { background-color: #FBBF24; color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 600; }
    </style>
</head>
<body>
<div style="padding-top: 50px">
<h1 class="text-4xl font-bold text-center mb-12 text-gray-800">Minuman</h1>
</div>
<!-- Tombol buka offcanvas -->
<center>
  <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
    <a href="{{ route('welcome') }}" id="backButton" class="btn btn-secondary" style="height:50px; border-radius:50px; display:flex; align-items:center; justify-content:center;">
      <i class="bi bi-arrow-left"></i> Kembali
    </a>
    <button class="btn btn-primary rounded-circle" type="button" style="width:50px; height:50px;" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
      <i class="bi bi-cart"></i>
    </button>
  </div>
</center>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="cartOffcanvasLabel">Keranjang Pesanan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form id="orderForm">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" required>
      </div>
      <div class="mb-3">
        <label for="bangku" class="form-label">Nomor Bangku</label>
        <input type="text" class="form-control" id="bangku" required>
      </div>
      <div class="mb-3">
        <label for="pembayaran" class="form-label">Metode Pembayaran</label>
        <select class="form-select" id="pembayaran" required>
          <option value="Kasir">Kasir</option>
          <option value="QRIS">QRIS</option>
        </select>
      </div>
      <hr>
      <div id="cartItems"></div>
      <p>Total: <span id="cartTotal">Rp 0</span></p>
      <button type="submit" class="btn btn-success">Pesan</button>
    </form>
  </div>
</div>

<div class="container" style="padding-top: 50px">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($produks as $produk)
    <div class="col">
      <div class="card">
        <img src="{{ asset('img/' . $produk->gambar) }}" class="card-img-top {{ $produk->stok < 1 ? 'grayscale' : '' }}" alt="{{ $produk->nama }}" style="width: 100%; height:200px; object-fit:cover; filter: {{ $produk->stok < 1 ? 'grayscale(1) brightness(0.7)' : 'none' }};">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <span>{{ $produk->nama }}</span>
            <p>Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <span class="badge bg-info">Stok: {{ $produk->stok }}</span>
            <button class="btn btn-warning rounded-circle add-to-cart" data-id="{{ $produk->id }}" data-nama="{{ $produk->nama }}" data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}" style="width:40px; height:40px;" {{ $produk->stok < 1 ? 'disabled' : '' }}>
              <i class="bi bi-cart-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<br>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const items = Array.from(document.querySelectorAll('.add-to-cart')).map(btn => ({
  id: btn.getAttribute('data-id'),
  name: btn.getAttribute('data-nama'),
  price: parseInt(btn.getAttribute('data-harga'))
}));
let cart = [];
if (localStorage.getItem('cart_all')) {
  try {
    cart = JSON.parse(localStorage.getItem('cart_all')) || [];
  } catch(e) {
    cart = [];
  }
}

function removeFromCart(idx) {
  cart.splice(idx, 1);
  localStorage.setItem('cart_minuman', JSON.stringify(cart));
  renderCart();
}

document.querySelectorAll('.bi-cart-plus').forEach((btn, idx) => {
  btn.parentElement.addEventListener('click', () => {
    const item = items[idx];
    const found = cart.find(i => i.id === item.id);
    if (found) found.qty += 1;
    else cart.push({ ...item, qty: 1 });
    localStorage.setItem('cart_all', JSON.stringify(cart));
    renderCart();
  });
});

function renderCart() {
  const cartItems = document.getElementById('cartItems');
  cartItems.innerHTML = cart.length ? cart.map((i, idx) =>
    `<div class="d-flex justify-content-between align-items-center mb-2">
      <span>${i.name} x ${i.qty} = Rp ${i.price * i.qty}</span>
      <button type="button" class="btn btn-sm btn-danger btn-remove-item" data-idx="${idx}">
        <i class="bi bi-trash"></i>
      </button>
    </div>`
  ).join('') : '<p>Belum ada item di keranjang</p>';
  const total = cart.reduce((sum, i) => sum + i.price * i.qty, 0);
  document.getElementById('cartTotal').textContent = 'Rp ' + total.toLocaleString();
  localStorage.setItem('cart_all', JSON.stringify(cart));
}

document.getElementById('cartItems').addEventListener('click', function(e) {
  if (e.target.closest('.btn-remove-item')) {
    const idx = e.target.closest('.btn-remove-item').getAttribute('data-idx');
    cart.splice(idx, 1);
    localStorage.setItem('cart_all', JSON.stringify(cart));
    renderCart();
  }
});

document.getElementById('orderForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const nama = document.getElementById('nama').value;
  const bangku = document.getElementById('bangku').value;
  const pembayaran = document.getElementById('pembayaran').value;
  if (!cart.length) return Swal.fire({title:'Keranjang Kosong!',text:'Tambahkan item ke keranjang terlebih dahulu.',icon:'warning',confirmButtonColor:'#3085d6'});
  fetch("{{ route('pesan.store') }}", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ nama, bangku, pembayaran, cart })
  })
  .then(res => res.json())
  .then(data => {
    Swal.fire({title:'Pesanan Berhasil!',text:'Pesanan Anda telah diterima.',icon:'success',confirmButtonColor:'#28a745'});
    cart = [];
    localStorage.removeItem('cart_all');
    renderCart();
    document.getElementById('orderForm').reset();
  });
});

// Persist selected bangku across pages: read URL -> set localStorage, else read localStorage -> fill input; update localStorage on input change
(function setSeatFromUrlOrSession() {
  try {
    const params = new URLSearchParams(window.location.search);
    const seatParam = params.get('bangku') || params.get('seat');
    const serverBangku = @json(session('selected_bangku'));
    const seat = seatParam || serverBangku;
    if (seat) {
      const el = document.getElementById('bangku');
      if (el) {
        el.value = seat;
        el.readOnly = true; // prevent user editing; seat is controlled by URL or server session
      }
      // Add bangku param to back button
      const backBtn = document.getElementById('backButton');
      if (backBtn) {
        const url = new URL(backBtn.href);
        url.searchParams.set('bangku', seat);
        backBtn.href = url.toString();
      }
    }
  } catch (e) {
    // ignore
  }
})();

renderCart();
</script>
</html>