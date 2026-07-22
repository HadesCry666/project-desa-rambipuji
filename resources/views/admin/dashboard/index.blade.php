@extends('admin.layout.main')
@section('title', 'Dashboard Admin')

@section('content')

<section class="section">

  {{-- HEADER DASHBOARD --}}
  <div class="section-header d-flex align-items-center justify-content-between">
    <div>
      <h1 class="mb-1">Selamat Datang, {{ auth()->user()->name ?? 'Admin Desa' }} Rambipuji 👋</h1>
      <p class="text-muted mb-0" style="font-size: 0.875rem;">
        Sistem Informasi Desa Rambipuji — Kelola data penduduk, kartu keluarga, dan layanan administrasi desa secara terintegrasi.
      </p>
    </div>
    <div class="badge bg-light text-primary border px-3 py-2 rounded-pill fw-semibold shadow-sm d-none d-md-flex align-items-center gap-2">
      <i class="far fa-calendar-alt"></i>
      <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
    </div>
  </div>

  {{-- STATISTIK UTAMA --}}
  <div class="row">

    {{-- KIRI: GRAFIK STATISTIK PENDUDUK --}}
    <div class="col-lg-7 mb-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="mb-0"><i class="fas fa-chart-pie text-primary me-2"></i>Statistik Gender Penduduk</h4>
          <span class="badge bg-primary-light text-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11px;">Data Realtime</span>
        </div>
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
          <div style="height:280px; width: 100%; max-width: 380px;" class="position-relative">
            <canvas id="chartPenduduk"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- KANAN: 6 KARTU STATISTIK MODERN --}}
    <div class="col-lg-5 mb-4">
      <div class="row g-3">

        {{-- Penduduk --}}
        <div class="col-6">
          <div class="card card-statistic-1 border-0 shadow-sm">
            <div class="card-icon" style="background: #e0f2fe; color: #0284c7;">
              <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Penduduk</h4></div>
              <div class="card-body">{{ number_format($jumlahPenduduk ?? 0) }}</div>
            </div>
          </div>
        </div>

        {{-- KK --}}
        <div class="col-6">
          <div class="card card-statistic-1 border-0 shadow-sm">
            <div class="card-icon" style="background: #e0e7ff; color: #4f46e5;">
              <i class="fas fa-home"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Kartu Keluarga</h4></div>
              <div class="card-body">{{ number_format($jumlahKK ?? 0) }}</div>
            </div>
          </div>
        </div>

        {{-- Pria --}}
        <div class="col-6">
          <div class="card card-statistic-1 border-0 shadow-sm">
            <div class="card-icon" style="background: #dcfce7; color: #16a34a;">
              <i class="fas fa-male"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Laki-Laki</h4></div>
              <div class="card-body">{{ number_format($jumlahLaki ?? 0) }}</div>
            </div>
          </div>
        </div>

        {{-- Wanita --}}
        <div class="col-6">
          <div class="card card-statistic-1 border-0 shadow-sm">
            <div class="card-icon" style="background: #fce7f3; color: #db2777;">
              <i class="fas fa-female"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Perempuan</h4></div>
              <div class="card-body">{{ number_format($jumlahPerempuan ?? 0) }}</div>
            </div>
          </div>
        </div>

        {{-- RT --}}
        <div class="col-6">
          <div class="card card-statistic-1 border-0 shadow-sm">
            <div class="card-icon" style="background: #fef3c7; color: #d97706;">
              <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Jumlah RT</h4></div>
              <div class="card-body">{{ number_format($jumlahRT ?? 0) }}</div>
            </div>
          </div>
        </div>

        {{-- RW --}}
        <div class="col-6">
          <div class="card card-statistic-1 border-0 shadow-sm">
            <div class="card-icon" style="background: #f3e8ff; color: #9333ea;">
              <i class="fas fa-sitemap"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Jumlah RW</h4></div>
              <div class="card-body">{{ number_format($jumlahRW ?? 0) }}</div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

</section>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('chartPenduduk');

    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-Laki', 'Perempuan'],
                datasets: [{
                    data: [
                        {{ $jumlahLaki ?? 0 }},
                        {{ $jumlahPerempuan ?? 0 }}
                    ],
                    backgroundColor: ['#0284c7', '#db2777'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                family: "'Plus Jakarta Sans', sans-serif",
                                size: 12,
                                weight: '600'
                            },
                            padding: 20
                        }
                    }
                },
                cutout: '68%'
            }
        });
    }
});
</script>
@endpush