<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Pemesanan</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #ffffff; }
        .category-card { transition: transform 0.3s, box-shadow 0.3s; border-radius: 1rem; overflow: hidden; }
        .category-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); }
        .category-title { font-weight: 700; }
        .category-badge { background-color: #FBBF24; color: white; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 600; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#000000" fill-opacity="1" d="M0,224L480,32L960,96L1440,96L1440,0L960,0L480,0L0,0Z"></path>
</svg>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8" style="margin-top: -200px">
        <center>
    <img src="{{ asset('img/nako.png')}}" alt="" style="width: 200px">
    </center>
        <h1 class="text-4xl font-bold text-center mb-12 text-gray-800" style="color: #000000">Menu Pemesanan</h1>
        <div id="bangkuBadge" style="display:none; text-align:center; margin-bottom:20px;">
            <div class="alert alert-info" role="alert">
                <strong>Nomor Bangku:</strong> <span id="bangkuDisplay" style="font-size: 1.3em; font-weight: bold;"></span>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Makanan Berat -->
            <div class="category-card bg-white shadow-lg">
                <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=600&q=80" class="w-full h-48 object-cover" alt="Makanan Berat">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="category-title text-2xl text-gray-800">Makanan Berat</h2>
                        <span class="category-badge">Main Course</span>
                    </div>
                    <p class="text-gray-600 mb-4">Nasi Jinggo, Nasi Rawon, dan masakan berat.</p>
                    <a href="{{ route('makanan_berat') }}" class="inline-block px-5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 makanan-link" data-category="makanan_berat">Lihat Menu</a>
                </div>
            </div>

            <!-- Minuman -->
            <div class="category-card bg-white shadow-lg">
                <img src="{{ asset('img/menunako.png')}}" class="w-full h-48 object-cover" alt="Minuman">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="category-title text-2xl text-gray-800">Minuman</h2>
                        <span class="category-badge">Drinks</span>
                    </div>
                    <p class="text-gray-600 mb-4">Teh, Kopi, dan minuman segar lainnya.</p>
                    <a href="{{ route('minuman') }}" class="inline-block px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 makanan-link" data-category="minuman">Lihat Menu</a>
                </div>
            </div>

            <!-- Makanan Kecil -->
            <div class="category-card bg-white shadow-lg">
                <img src="https://ds393qgzrxwzn.cloudfront.net/resize/m600x500/cat1/img/images/0/Jj2vRKuorg.jpg" class="w-full h-48 object-cover" alt="Makanan Kecil">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="category-title text-2xl text-gray-800">Makanan Kecil</h2>
                        <span class="category-badge">Snacks</span>
                    </div>
                    <p class="text-gray-600 mb-4">Gorengan, dan cemilan.</p>
                    <a href="{{ route('makanan_kecil') }}" class="inline-block px-5 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 makanan-link" data-category="makanan_kecil">Lihat Menu</a>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center text-gray-500" style="margin-bottom: -100px">
            &copy; {{ date('Y') }} Menu Pemesanan Kopi Nako Semua hak dilindungi.
            <br>
            <br>
            <a class="btn btn-outline-dark" href="/login">Login Admin</a>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#000000" fill-opacity="1" d="M0,128L480,288L960,160L1440,192L1440,320L960,320L480,320L0,320Z"></path>
</svg>
<script>
(function() {
  const params = new URLSearchParams(window.location.search);
  const bangku = params.get('bangku');
  
  if (bangku) {
    // Show bangku badge
    document.getElementById('bangkuDisplay').textContent = bangku;
    document.getElementById('bangkuBadge').style.display = 'block';
    
    // Add bangku param to all category links
    document.querySelectorAll('.makanan-link').forEach(link => {
      const url = new URL(link.href);
      url.searchParams.set('bangku', bangku);
      link.href = url.toString();
    });
  }
})();
</script>
</body>
</html>
