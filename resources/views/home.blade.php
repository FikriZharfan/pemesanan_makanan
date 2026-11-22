@extends('layouts.app')
@section('content')
      <!-- end Navbar -->
      <!-- cards -->
      <div class="w-full px-6 py-6 mx-auto">
        <h2 class="mb-6 text-light font-bold text-3xl text-blue-600">Dashboard</h2>
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">

          <!-- card3: Total Uang Keseluruhan -->
          <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Total Uang Keseluruhan</p>
                      <h5 class="mb-2 font-bold dark:text-white">Rp {{ number_format($allTotal, 0, ',', '.') }}</h5>
                      <p class="mb-0 dark:text-white dark:opacity-60">
                        <span class="text-sm font-bold leading-normal text-blue-500">Total semua pesanan</span>
                      </p>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-green-500 to-blue-500">
                      <i class="ni leading-none ni-credit-card text-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- card4: Total Pesanan Keseluruhan -->
          <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Total Pesanan Keseluruhan</p>
                      <h5 class="mb-2 font-bold dark:text-white">{{ $allUsers }}</h5>
                      <p class="mb-0 dark:text-white dark:opacity-60">
                        <span class="text-sm font-bold leading-normal text-blue-500">Total semua pesanan</span>
                      </p>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-yellow-500 to-orange-500">
                      <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection