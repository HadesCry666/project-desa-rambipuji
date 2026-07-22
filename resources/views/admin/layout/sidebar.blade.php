<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">

    <!-- Logo Desa Rambipuji (Normal) -->
    <div class="sidebar-brand normal-logo">
      <a href="{{ url('/admin/dashboard') }}" class="d-flex align-items-center justify-content-start text-decoration-none">
        <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa Rambipuji" class="sidebar-logo-img">
        <div class="d-flex flex-column text-start ms-2">
          <span class="brand-title">Desa Rambipuji</span>
          <span class="brand-subtitle">Kabupaten Jember</span>
        </div>
      </a>
    </div>

    <!-- Logo Desa Rambipuji (Collapsed) -->
    <div class="sidebar-brand sidebar-brand-sm collapsed-logo">
      <a href="{{ url('/admin/dashboard') }}" title="Desa Rambipuji">
        <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Rambipuji" class="sidebar-logo-sm">
      </a>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="menu-header">Menu Utama</li>

      <li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a href="{{ url('/admin/dashboard') }}" class="nav-link">
          <i class="fas fa-home"></i><span>Dashboard</span>
        </a>
      </li>

      <li class="{{ Request::is('admin/master_kartukeluarga*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/master_kartukeluarga') }}">
          <i class="fas fa-address-card"></i><span>Kartu Keluarga</span>
        </a>
      </li>

      <!-- Pengajuan Surat -->
      <li class="dropdown {{ Request::is('admin/suratmasuk*') || Request::is('admin/suratselesai*') || Request::is('admin/suratditolak*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-envelope"></i>
          <span>Pengajuan Surat</span>
        </a>
        <ul class="dropdown-menu">
          <li class="{{ Request::is('admin/suratmasuk*') ? 'active' : '' }}">
            <a href="{{ url('admin/suratmasuk') }}" class="nav-link">Surat Masuk</a>
          </li>
          <li class="{{ Request::is('admin/suratselesai*') ? 'active' : '' }}">
            <a href="{{ url('admin/suratselesai') }}" class="nav-link">Surat Selesai</a>
          </li>
          <li class="{{ Request::is('admin/suratditolak*') ? 'active' : '' }}">
            <a href="{{ url('admin/suratditolak') }}" class="nav-link">Surat Ditolak</a>
          </li>
        </ul>
      </li>

      <!-- Master Akun -->
      <li class="dropdown {{ Request::is('admin/akunrw*') || Request::is('admin/akunrt*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-users-cog"></i>
          <span>Master Akun</span>
        </a>
        <ul class="dropdown-menu">
          <li class="{{ Request::is('admin/akunrw*') ? 'active' : '' }}">
            <a href="{{ url('admin/akunrw') }}" class="nav-link">Akun RW</a>
          </li>
          <li class="{{ Request::is('admin/akunrt*') ? 'active' : '' }}">
            <a href="{{ url('admin/akunrt') }}" class="nav-link">Akun RT</a>
          </li>
        </ul>
      </li>

      <li class="{{ Request::is('admin/mastersurat*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/mastersurat') }}">
          <i class="fas fa-file-alt"></i><span>Master Surat</span>
        </a>
      </li>

      <li class="{{ Request::is('admin/pengaduan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/pengaduan') }}">
          <i class="fas fa-comment-dots"></i><span>Pengaduan Masyarakat</span>
        </a>
      </li>

      <li class="{{ Request::is('admin/landingpage*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/landingpage') }}">
          <i class="fas fa-globe"></i><span>Kelola Website</span>
        </a>
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
</style>
