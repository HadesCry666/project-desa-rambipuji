<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">

    @php
      $isSekdes = Request::is('sekretarisdesa*');
      $isKades  = Request::is('kepaladesa*');
      $isKadus  = Request::is('kepaladusun*');
      $isAdmin  = !$isSekdes && !$isKades && !$isKadus;

      if ($isSekdes) {
          $homeUrl = url('/sekretarisdesa/dashboard');
          $roleTitle = 'Sekretaris Desa';
      } elseif ($isKades) {
          $homeUrl = url('/kepaladesa/dashboard');
          $roleTitle = 'Kepala Desa';
      } elseif ($isKadus) {
          $homeUrl = url('/kepaladusun/dashboard');
          $roleTitle = 'Kepala Dusun';
      } else {
          $homeUrl = url('/admin/dashboard');
          $roleTitle = 'Admin Desa';
      }
    @endphp

    <!-- Logo Desa Rambipuji (Normal) -->
    <div class="sidebar-brand normal-logo">
      <a href="{{ $homeUrl }}" class="d-flex align-items-center justify-content-start text-decoration-none">
        <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa Rambipuji" class="sidebar-logo-img">
        <div class="d-flex flex-column text-start ms-2">
          <span class="brand-title">Desa Rambipuji</span>
          <span class="brand-subtitle">{{ $roleTitle }}</span>
        </div>
      </a>
    </div>

    <!-- Logo Desa Rambipuji (Collapsed) -->
    <div class="sidebar-brand sidebar-brand-sm collapsed-logo">
      <a href="{{ $homeUrl }}" title="Desa Rambipuji — {{ $roleTitle }}">
        <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Rambipuji" class="sidebar-logo-sm">
      </a>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li classmenu-header class="menu-header">Menu Utama</li>

      {{-- ==================== SIDEBAR SEKRETARIS DESA ==================== --}}
      @if($isSekdes)
        <li class="{{ Request::is('sekretarisdesa/dashboard*') ? 'active' : '' }}">
          <a href="{{ url('/sekretarisdesa/dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
        </li>
        <li class="dropdown {{ Request::is('sekretarisdesa/surat*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i><span>Persuratan Desa</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::is('sekretarisdesa/suratmasuk*') ? 'active' : '' }}">
              <a href="{{ url('/sekretarisdesa/suratmasuk') }}" class="nav-link">Surat Masuk</a>
            </li>
            <li class="{{ Request::is('sekretarisdesa/suratselesai*') ? 'active' : '' }}">
              <a href="{{ url('/sekretarisdesa/suratselesai') }}" class="nav-link">Surat Selesai</a>
            </li>
            <li class="{{ Request::is('sekretarisdesa/suratditolak*') ? 'active' : '' }}">
              <a href="{{ url('/sekretarisdesa/suratditolak') }}" class="nav-link">Surat Ditolak</a>
            </li>
          </ul>
        </li>
        <li class="{{ Request::is('sekretarisdesa/kartukeluarga*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/sekretarisdesa/kartukeluarga') }}"><i class="fas fa-address-card"></i><span>Kartu Keluarga</span></a>
        </li>
        <li class="{{ Request::is('sekretarisdesa/pengaduan*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/sekretarisdesa/pengaduan') }}"><i class="fas fa-comment-dots"></i><span>Pengaduan Masyarakat</span></a>
        </li>

      {{-- ==================== SIDEBAR KEPALA DESA ==================== --}}
      @elseif($isKades)
        <li class="{{ Request::is('kepaladesa/dashboard*') ? 'active' : '' }}">
          <a href="{{ url('/kepaladesa/dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard Eksekutif</span></a>
        </li>
        <li class="dropdown {{ Request::is('kepaladesa/surat*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope-open-text"></i><span>Persetujuan Surat (TTE)</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::is('kepaladesa/suratmasuk*') ? 'active' : '' }}">
              <a href="{{ url('/kepaladesa/suratmasuk') }}" class="nav-link">Surat Masuk</a>
            </li>
            <li class="{{ Request::is('kepaladesa/suratselesai*') ? 'active' : '' }}">
              <a href="{{ url('/kepaladesa/suratselesai') }}" class="nav-link">Surat Selesai (TTE)</a>
            </li>
          </ul>
        </li>
        <li class="{{ Request::is('kepaladesa/kartukeluarga*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/kepaladesa/kartukeluarga') }}"><i class="fas fa-address-card"></i><span>Data Kartu Keluarga</span></a>
        </li>
        <li class="{{ Request::is('kepaladesa/pengaduan*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/kepaladesa/pengaduan') }}"><i class="fas fa-comment-dots"></i><span>Pengaduan Masyarakat</span></a>
        </li>

      {{-- ==================== SIDEBAR KEPALA DUSUN ==================== --}}
      @elseif($isKadus)
        <li class="{{ Request::is('kepaladusun/dashboard*') ? 'active' : '' }}">
          <a href="{{ url('/kepaladusun/dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
        </li>
        <li class="dropdown {{ Request::is('kepaladusun/surat*') || Request::is('kepaladusun/tambah*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i><span>Pengajuan Surat</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::is('kepaladusun/tambah-pengajuan*') ? 'active' : '' }}">
              <a href="{{ url('/kepaladusun/tambah-pengajuan') }}" class="nav-link">Tambah Pengajuan</a>
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

      {{-- ==================== SIDEBAR ADMIN (DEFAULT) ==================== --}}
      @else
        <li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
          <a href="{{ url('/admin/dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
        </li>

        <li class="{{ Request::is('admin/master_kartukeluarga*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/admin/master_kartukeluarga') }}"><i class="fas fa-address-card"></i><span>Kartu Keluarga</span></a>
        </li>

        <li class="dropdown {{ Request::is('admin/suratmasuk*') || Request::is('admin/suratselesai*') || Request::is('admin/suratditolak*') || Request::is('admin/tambah-pengajuan*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i><span>Pengajuan Surat</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::is('admin/tambah-pengajuan*') ? 'active' : '' }}">
              <a href="{{ url('admin/tambah-pengajuan') }}" class="nav-link">Tambah Pengajuan</a>
            </li>
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

        <li class="dropdown {{ Request::is('admin/akunrw*') || Request::is('admin/akunrt*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i><span>Master Akun</span></a>
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
          <a class="nav-link" href="{{ url('admin/mastersurat') }}"><i class="fas fa-file-alt"></i><span>Master Surat</span></a>
        </li>

        <li class="{{ Request::is('admin/pengaduan*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('admin/pengaduan') }}"><i class="fas fa-comment-dots"></i><span>Pengaduan Masyarakat</span></a>
        </li>

        <li class="{{ Request::is('admin/landingpage*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('admin/landingpage') }}"><i class="fas fa-globe"></i><span>Kelola Website</span></a>
        </li>
      @endif
    </ul>

  </aside>
</div>

<style>
  .sidebar-logo-img { height: 42px; width: auto; object-fit: contain; }
  .sidebar-logo-sm { height: 36px; width: auto; object-fit: contain; }
  .brand-title { font-weight: 700 !important; font-size: 15px !important; color: #0057A6 !important; letter-spacing: -0.3px; line-height: 1.2; }
  .brand-subtitle { font-size: 10px !important; font-weight: 600 !important; color: #64748b !important; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1.2; }
  .menu-header { font-size: 10px !important; font-weight: 700 !important; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8 !important; padding: 15px 20px 8px 20px !important; }
</style>
