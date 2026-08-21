<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">

    <!-- Logo Desa Rambipuji (Normal) -->
    <div class="sidebar-brand normal-logo">
      <a href="{{ url('/kepaladusun/dashboard') }}" class="d-flex align-items-center justify-content-start text-decoration-none">
        <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa Rambipuji" class="sidebar-logo-img">
        <div class="d-flex flex-column text-start ms-2">
          <span class="brand-title">Desa Rambipuji</span>
          <span class="brand-subtitle">Kabupaten Jember</span>
        </div>
      </a>
    </div>

    <!-- Logo Desa Rambipuji (Collapsed) -->
    <div class="sidebar-brand sidebar-brand-sm collapsed-logo">
      <a href="{{ url('/kepaladusun/dashboard') }}" title="Desa Rambipuji">
        <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Rambipuji" class="sidebar-logo-sm">
      </a>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="menu-header">Menu Utama</li>

      <li class="{{ Request::is('kepaladusun/dashboard*') ? 'active' : '' }}">
        <a href="{{ url('/kepaladusun/dashboard') }}" class="nav-link">
          <i class="fas fa-home"></i><span>Dashboard</span>
        </a>
      </li>

      <!-- Pengajuan Surat -->
      <li class="dropdown {{ Request::is('kepaladusun/suratmasuk*') || Request::is('kepaladusun/tambah-pengajuan*') || Request::is('kepaladusun/suratselesai*') || Request::is('kepaladusun/suratditolak*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-envelope"></i>
          <span>Pengajuan Surat</span>
        </a>
        <ul class="dropdown-menu">
          <li class="{{ Request::is('kepaladusun/tambah-pengajuan*') ? 'active' : '' }}">
            <a href="{{ url('/kepaladusun/tambah-pengajuan') }}" class="nav-link">
              <i class="fas fa-plus-circle me-1 text-success"></i> Tambah Pengajuan
            </a>
          </li>
          <li class="{{ Request::is('kepaladusun/suratmasuk*') ? 'active' : '' }}">
            <a href="{{ url('/kepaladusun/suratmasuk') }}" class="nav-link">Surat Masuk</a>
          </li>
          <li class="{{ Request::is('kepaladusun/suratselesai*') ? 'active' : '' }}">
            <a href="{{ url('/kepaladusun/suratselesai') }}" class="nav-link">Surat Selesai</a>
          </li>
          <li class="{{ Request::is('kepaladusun/suratditolak*') ? 'active' : '' }}">
            <a href="{{ url('/kepaladusun/suratditolak') }}" class="nav-link">Surat Ditolak</a>
          </li>
        </ul>
      </li>
    </ul>

  </aside>
</div>

<style>
  /* Brand Typography & Styles */
  .sidebar-logo-img {
    height: 42px;
    width: auto;
    object-fit: contain;
  }
  .sidebar-logo-sm {
    height: 36px;
    width: auto;
    object-fit: contain;
  }
  .brand-title {
    font-weight: 700 !important;
    font-size: 15px !important;
    color: #0057A6 !important;
    letter-spacing: -0.3px;
    line-height: 1.2;
  }
  .brand-subtitle {
    font-size: 10px !important;
    font-weight: 600 !important;
    color: #64748b !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1.2;
  }
  .menu-header {
    font-size: 10px !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #94a3b8 !important;
    padding: 15px 20px 8px 20px !important;
  }
  .main-sidebar,
.main-sidebar #sidebar-wrapper {
    overflow-x: hidden !important;
}

/* Logo */
.sidebar-brand {
    max-width: 100% !important;
    overflow: hidden !important;
}

.sidebar-brand a {
    min-width: 0 !important;
    max-width: 100% !important;
    overflow: hidden !important;
}



</style>
