<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Default title')</title>

  {{-- General CSS Files --}}
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}" >
  {{-- CSS Libraries (per halaman) --}}
  @stack('css-lib')



  {{-- Template CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  <style>
    .sidebar-overlay {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(15, 23, 42, 0.45);
      backdrop-filter: blur(3px);
      z-index: 1040;
      opacity: 0; visibility: hidden;
      transition: all 0.3s ease;
    }
    body.sidebar-show .sidebar-overlay { opacity: 1; visibility: visible; }
    @media (max-width: 1024px) {
      .main-sidebar { left: -260px !important; position: fixed !important; top: 0 !important; height: 100vh !important; z-index: 1050 !important; transition: left 0.3s ease !important; }
      body.sidebar-show .main-sidebar { left: 0 !important; width: 260px !important; box-shadow: 4px 0 25px rgba(0,0,0,0.15) !important; }
      .main-navbar { left: 0 !important; width: 100% !important; position: fixed !important; top: 0 !important; z-index: 1030 !important; }
      .main-content { padding-left: 16px !important; padding-right: 16px !important; padding-top: 85px !important; }
      .card-header { padding: 14px 16px !important; flex-direction: column !important; align-items: stretch !important; gap: 12px !important; }
      .table-responsive { border-radius: 12px !important; border: 1px solid #e2e8f0 !important; -webkit-overflow-scrolling: touch; }
      .table td, .table th { white-space: nowrap !important; }
    }
  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="sidebar-overlay"></div>

      @include('RW.layout.alerts')
      
      {{-- Navbar --}}
      @include('RW.layout.navbar')

      {{-- Sidebar --}}
      @include('RW.layout.sidebar')

      {{-- Main Content --}}
      <div class="main-content">
        @yield('content')
      </div>

      {{-- Footer (opsional) --}}
      {{-- @includeWhen(View::exists('layouts.footer'), 'layouts.footer') --}}

    </div>
  </div>

  {{-- General JS Scripts --}}
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <!-- Bootstrap 4 / 5 JS Compatibility Polyfill -->
  <script>
    (function($) {
      if (typeof window.bootstrap === 'undefined') {
        window.bootstrap = {};
      }
      window.bootstrap.Modal = window.bootstrap.Modal || class {
        constructor(el) {
          this.el = typeof el === 'string' ? document.querySelector(el) : el;
        }
        show() { if (this.el) $(this.el).modal('show'); }
        hide() { if (this.el) $(this.el).modal('hide'); }
        toggle() { if (this.el) $(this.el).modal('toggle'); }
        static getInstance(el) { return new window.bootstrap.Modal(el); }
        static getOrCreateInstance(el) { return new window.bootstrap.Modal(el); }
      };

      $(document).ready(function() {
        $(document).on('click', '[data-bs-dismiss="modal"]', function(e) {
          e.preventDefault();
          $(this).closest('.modal').modal('hide');
        });
        $(document).on('click', '[data-bs-toggle="modal"]', function(e) {
          e.preventDefault();
          var target = $(this).attr('data-bs-target') || $(this).attr('href');
          if (target) $(target).modal('show');
        });
        $(document).on('click', '[data-bs-toggle="dropdown"]', function(e) {
          e.preventDefault();
          $(this).dropdown('toggle');
        });
        $(document).on('click', '[data-toggle="sidebar"], .sidebar-overlay', function(e) {
          e.preventDefault();
          $('body').toggleClass('sidebar-show');
        });
      });
    })(jQuery);
  </script>

  <script src="{{ asset('assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}" ></script>
  
  {{-- JS Libraries (per halaman) --}}
  @stack('js-lib')

  {{-- Page Specific JS --}}
  @stack('page-js')

  {{-- Template JS --}}
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
@keyframes slideInRight {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}
</style>
  @stack('scripts')
</body>
</html>
