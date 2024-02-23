<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sambut Caleg - Cari Tau Calon Wakil Rakyat Terpilih</title>
	<link rel="icon" type="image/png" href="{{ URL::to('/') }}/sambutcaleg.png" />
    <!-- CSS files -->
    <link href="{{ URL::to('/') }}/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    @yield('css')
  </head>
  <body >
    <script src="{{ URL::to('/') }}/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="." class="row">
              <img src="{{ URL::to('/') }}/sambutcaleg.png" width="110" height="32" alt="Tabler" class="col-4 navbar-brand-image">
              <h2 class='col-4 mt-1'>Sambut Caleg</h2>
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
                <a href="{{ URL::to('/') }}/tos" class="btn" rel="noreferrer">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler text-warning icon-tabler-alert-square-rounded" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                Terms Of Services
                </a>
              </div>
            </div>
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
                <a href="{{ URL::to('/') }}/donate" class="btn" rel="noreferrer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                  Donasi
                </a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item @if($menu=='pusat') active @endif">
                  <a class="nav-link" href="{{ URL::to('/') }}/" >
                    <span class="nav-link-title">
                      DPR RI
                    </span>
                  </a>
                </li>
                <li class="nav-item @if($menu=='provinsi') active @endif">
                  <a class="nav-link" href="{{ URL::to('/') }}/dpr/provinsi" >
                    <span class="nav-link-title">
                      DPR Provinsi
                    </span>
                  </a>
                </li>
                <li class="nav-item @if($menu=='daerah') active @endif">
                  <a class="nav-link" href="{{ URL::to('/') }}/dpr/daerah" >
                    <span class="nav-link-title">
                      DPR Kota/Kabupaten
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>
      <div class="page-wrapper">
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  {{ $title }}
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            @yield('konten')
        </div>

        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    <a href="{{ URL::to('/') }}/donate" class="link-secondary" rel="noopener">
                      <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                      Donasi
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2024
                    <a href="." class="link-secondary">Aruna Media Kreasi</a>.
                    All rights reserved.
                  </li>
                  <li class="list-inline-item">
                    Theme By
                    <a href="https://tabler.io/" target="_blank" class="link-secondary">Tabler</a>.
                    All rights reserved.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ URL::to('/') }}/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
    <script src="{{ URL::to('/') }}/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062" defer></script>
    <script src="{{ URL::to('/') }}/dist/libs/jsvectormap/dist/maps/world.js?1684106062" defer></script>
    <script src="{{ URL::to('/') }}/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062" defer></script>
    <!-- Tabler Core -->
    <script src="{{ URL::to('/') }}/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="{{ URL::to('/') }}/dist/js/demo.min.js?1684106062" defer></script>
    <script src="{{ URL::to('/') }}/sainteLague.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
  </body>
    @yield('script')
</html>
