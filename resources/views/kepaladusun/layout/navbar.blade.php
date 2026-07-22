<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li>
        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg sidebar-toggle-btn" aria-label="Toggle Sidebar">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>
  </form>

  <ul class="navbar-nav navbar-right">
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="user-avatar-badge">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="d-none d-md-inline-block fw-bold text-dark ms-2">
          Hi, {{ auth()->user()->name ?? session('nama') ?? 'Kepala Dusun' }}
        </div>
      </a>
      
      <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 rounded-4">
        <div class="dropdown-title">Kepala Dusun</div>
        <a href="{{ url('/') }}" class="dropdown-item has-icon" target="_blank">
          <i class="fas fa-external-link-alt text-info"></i> Lihat Website
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item has-icon text-danger"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Keluar
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
  </ul>
</nav>

<style>
  .user-avatar-badge {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #e0f2fe;
    color: #0057A6;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
  }
  .sidebar-toggle-btn {
    color: #334155 !important;
    transition: color 0.2s;
  }
  .sidebar-toggle-btn:hover {
    color: #0057A6 !important;
  }
</style>