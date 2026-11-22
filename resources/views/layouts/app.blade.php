<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dapur Bunda Bahagia</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Fallback CDN for Font Awesome (in case kit is blocked) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" referrerpolicy="no-referrer" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('template2/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('template2/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="{{ asset('template2/assets/css/argon-dashboard-tailwind.css?v=1.0.1')}}" rel="stylesheet" />
  </head>

  <body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-black dark:hidden min-h-75"></div>
    <!-- sidenav  -->
    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
      <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="#">
          <center>
            <img src="{{ asset('img/nako.png')}}" alt="" style="width: 100px; height:100px;">
          </center>
        </a>
      </div>
      <br><br>
      <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

      <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
          <li class="mt-0.5 w-full">
            <a class="py-2.7 bg-black/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('home') }}">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-sm leading-normal text-black ni ni-tv-2"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a class=" dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('pemesanan') }}">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Pesanan</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('produk.index') }}">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-credit-card"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Produk</span>
            </a>
          </li>

        </ul>
        
      </div>
    </aside>

    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
      <!-- Navbar -->
      <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
          <div class="d-flex justify-content-between align-items-center w-100">
            <nav>
              <!-- breadcrumb -->
              <h6 class="mb-0 font-bold text-white capitalize">Kopi Nako</h6>
            </nav>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
              <li class="flex items-center">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mb-0 ms-2">
                  @csrf
                  <button type="submit" class="btn btn-sm bg-red-500 text-white font-bold px-4 py-2 rounded hover:bg-red-600 transition-colors">
                    <i class="fa fa-sign-out-alt me-1"></i> Logout
                  </button>
                </form>
              </li>
              <li class="flex items-center d-md-none ms-3">
                <button class="btn btn-sm bg-black text-white font-bold px-3 py-2 rounded" type="button" onclick="document.querySelector('aside').classList.toggle('xl:translate-x-0');">
                  <i class="fa fa-bars"></i>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
  </body>
  <!-- plugin for charts  -->
  <script src="./assets/js/plugins/chartjs.min.js" async></script>
  <!-- plugin for scrollbar  -->
  <script src="./assets/js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- main script file  -->
  <script src="./assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
</html>
