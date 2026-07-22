<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Admin Panel') - Desa Rambipuji</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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

  <!-- Custom Modern White Admin Theme Stylesheet -->
  <style>
    :root {
      --primary: #0057A6;
      --primary-hover: #004080;
      --primary-light: #f0f7ff;
      --bg-main: #f8fafc;
      --card-bg: #ffffff;
      --border-color: #e2e8f0;
      --text-dark: #0f172a;
      --text-muted: #64748b;
    }

    body {
      font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif !important;
      background-color: var(--bg-main) !important;
      color: var(--text-dark) !important;
    }

    /* ===== NAVBAR STYLING ===== */
    .navbar-bg {
      background-color: #ffffff !important;
      height: 70px !important;
      border-bottom: 1px solid var(--border-color) !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02) !important;
    }

    .main-navbar {
      height: 70px !important;
      left: 250px;
      right: 0;
      background: transparent !important;
      transition: left 0.3s ease, width 0.3s ease;
    }

    .main-navbar .nav-link {
      color: var(--text-dark) !important;
    }

    .main-navbar .nav-link:hover {
      color: var(--primary) !important;
    }

    /* ===== SIDEBAR NORMAL STATE (Desktop) ===== */
    body:not(.sidebar-mini) .main-sidebar {
      width: 250px !important;
      background-color: #ffffff !important;
      border-right: 1px solid var(--border-color) !important;
      box-shadow: 2px 0 12px rgba(0, 0, 0, 0.02) !important;
    }

    body:not(.sidebar-mini) .main-sidebar .sidebar-menu > li > a {
      color: #475569 !important;
      font-weight: 600 !important;
      border-radius: 12px !important;
      margin: 3px 12px !important;
      padding: 10px 14px !important;
      font-size: 13.5px !important;
      transition: all 0.2s ease !important;
      display: flex;
      align-items: center;
    }

    body:not(.sidebar-mini) .main-sidebar .sidebar-menu > li > a i {
      font-size: 16px !important;
      width: 24px !important;
      margin-right: 10px !important;
      color: #64748b !important;
      transition: color 0.2s ease !important;
    }

    body:not(.sidebar-mini) .main-sidebar .sidebar-menu > li > a:hover {
      background-color: var(--primary-light) !important;
      color: var(--primary) !important;
    }

    body:not(.sidebar-mini) .main-sidebar .sidebar-menu > li > a:hover i {
      color: var(--primary) !important;
    }

    body:not(.sidebar-mini) .main-sidebar .sidebar-menu > li.active > a {
      background: linear-gradient(135deg, #0057A6 0%, #004080 100%) !important;
      color: #ffffff !important;
      box-shadow: 0 4px 14px rgba(0, 87, 166, 0.22) !important;
    }

    body:not(.sidebar-mini) .main-sidebar .sidebar-menu > li.active > a i {
      color: #ffffff !important;
    }

    body:not(.sidebar-mini) .normal-logo {
      display: flex !important;
      align-items: center;
      padding: 12px 18px !important;
      height: 70px !important;
      border-bottom: 1px solid var(--border-color);
    }

    body:not(.sidebar-mini) .collapsed-logo {
      display: none !important;
    }

    body:not(.sidebar-mini) .main-content {
      padding-left: 275px !important;
      padding-top: 90px !important;
      padding-right: 25px !important;
      padding-bottom: 40px !important;
      background-color: var(--bg-main) !important;
      min-height: 100vh;
      transition: padding-left 0.3s ease;
    }

    /* ===== SIDEBAR MINI / COLLAPSED STATE ===== */
    body.sidebar-mini .main-sidebar {
      width: 65px !important;
      background-color: #ffffff !important;
      border-right: 1px solid var(--border-color) !important;
      box-shadow: 2px 0 12px rgba(0, 0, 0, 0.02) !important;
      overflow: visible !important;
    }

    body.sidebar-mini .main-sidebar #sidebar-wrapper {
      width: 65px !important;
    }

    body.sidebar-mini .main-navbar {
      left: 65px !important;
    }

    body.sidebar-mini .main-content {
      padding-left: 90px !important;
      padding-top: 90px !important;
      padding-right: 25px !important;
      padding-bottom: 40px !important;
      transition: padding-left 0.3s ease;
    }

    body.sidebar-mini .normal-logo {
      display: none !important;
    }

    body.sidebar-mini .collapsed-logo {
      display: flex !important;
      align-items: center;
      justify-content: center;
      height: 70px !important;
      width: 65px !important;
      padding: 0 !important;
      margin: 0 !important;
      border-bottom: 1px solid var(--border-color);
    }

    body.sidebar-mini .collapsed-logo img {
      height: 38px !important;
      width: 38px !important;
      object-fit: contain;
    }

    body.sidebar-mini .main-sidebar .sidebar-menu > li.menu-header {
      display: none !important;
    }

    body.sidebar-mini .main-sidebar .sidebar-menu > li > a {
      width: 44px !important;
      height: 44px !important;
      margin: 6px auto !important;
      padding: 0 !important;
      border-radius: 12px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      text-align: center !important;
      color: #475569 !important;
      transition: all 0.2s ease !important;
    }

    body.sidebar-mini .main-sidebar .sidebar-menu > li > a span {
      display: none !important;
    }

    body.sidebar-mini .main-sidebar .sidebar-menu > li > a i {
      margin-right: 0 !important;
      font-size: 18px !important;
      width: auto !important;
      color: #64748b !important;
    }

    body.sidebar-mini .main-sidebar .sidebar-menu > li > a:hover {
      background-color: var(--primary-light) !important;
      color: var(--primary) !important;
    }

    body.sidebar-mini .main-sidebar .sidebar-menu > li > a:hover i {
      color: var(--primary) !important;
    }

    body.sidebar-mini .main-sidebar .sidebar-menu > li.active > a {
      background: linear-gradient(135deg, #0057A6 0%, #004080 100%) !important;
      color: #ffffff !important;
      box-shadow: 0 4px 12px rgba(0, 87, 166, 0.25) !important;
    }

    body.sidebar-mini .main-sidebar .sidebar-menu > li.active > a i {
      color: #ffffff !important;
    }

    /* Submenu dropdown positioning in sidebar-mini */
    body.sidebar-mini .main-sidebar .sidebar-menu li.dropdown .dropdown-menu {
      background-color: #ffffff !important;
      border: 1px solid var(--border-color) !important;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08) !important;
      border-radius: 12px !important;
    }

    /* Section Header Modern White */
    .section-header {
      background: #ffffff !important;
      border-radius: 16px !important;
      border: 1px solid var(--border-color) !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02) !important;
      padding: 20px 24px !important;
      margin-bottom: 24px !important;
    }

    .section-header h1 {
      font-family: 'Poppins', sans-serif !important;
      font-size: 1.35rem !important;
      font-weight: 700 !important;
      color: var(--text-dark) !important;
    }

    /* Modern Card White Theme */
    .card {
      background: #ffffff !important;
      border: 1px solid var(--border-color) !important;
      border-radius: 16px !important;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02) !important;
      margin-bottom: 24px !important;
    }

    .card .card-header {
      background-color: #ffffff !important;
      border-bottom: 1px solid #f1f5f9 !important;
      border-radius: 16px 16px 0 0 !important;
      padding: 18px 24px !important;
    }

    .card .card-header h4 {
      font-family: 'Poppins', sans-serif !important;
      font-size: 1rem !important;
      font-weight: 700 !important;
      color: var(--text-dark) !important;
    }

    .card .card-body {
      padding: 20px 24px !important;
    }

    /* Modern Card Statistic Cards */
    .card-statistic-1 {
      display: flex !important;
      align-items: center !important;
      padding: 16px !important;
      border-radius: 16px !important;
    }

    .card-statistic-1 .card-icon {
      width: 52px !important;
      height: 52px !important;
      line-height: 52px !important;
      border-radius: 14px !important;
      font-size: 20px !important;
      margin-right: 14px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
    }

    .card-statistic-1 .card-wrap {
      flex: 1 !important;
    }

    .card-statistic-1 .card-header {
      padding: 0 !important;
      border: none !important;
      background: transparent !important;
    }

    .card-statistic-1 .card-header h4 {
      font-size: 0.8rem !important;
      font-weight: 600 !important;
      color: var(--text-muted) !important;
      text-transform: uppercase !important;
      letter-spacing: 0.5px !important;
      margin-bottom: 2px !important;
    }

    .card-statistic-1 .card-body {
      padding: 0 !important;
      font-size: 1.4rem !important;
      font-weight: 800 !important;
      color: var(--text-dark) !important;
    }

    @media (max-width: 1024px) {
      .main-sidebar {
        left: -250px;
      }
      body.sidebar-show .main-sidebar {
        left: 0 !important;
        width: 250px !important;
      }
      .main-navbar {
        left: 0 !important;
        width: 100% !important;
      }
      .main-content {
        padding-left: 20px !important;
        padding-right: 20px !important;
      }
    }
  </style>

  @stack('head')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">

      @include('admin.layout.alerts')
      
      {{-- Navbar --}}
      @include('admin.layout.navbar')

      {{-- Sidebar --}}
      @include('admin.layout.sidebar')

      {{-- Main Content --}}
      <div class="main-content">
        @yield('content')
      </div>

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

  <script src="{{ asset('assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}" ></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  {{-- JS Libraries (per halaman) --}}
  @stack('js-lib')

  {{-- Page Specific JS --}}
  @stack('page-js')

  {{-- Template JS --}}
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @stack('scripts')
</body>
</html>
