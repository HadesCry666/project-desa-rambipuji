@extends('admin.layout.main')
@section('title', 'Dashboard Kepala Dusun')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
.stat-card {
    border: 1px solid #e2e8f0; border-radius: 15px; padding: 20px 22px;
    background: #fff; transition: all .25s; box-shadow: 0 4px 14px rgba(0,0,0,.04);
}
.stat-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.08); transform: translateY(-2px); }
.stat-icon { width: 52px; height: 52px; border-radius: 13px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
.stat-label { font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: .6px; color: #94a3b8; }
.stat-value { font-size: 1.8rem; font-weight: 800; line-height: 1.1; color: #0f172a; }
.chart-card { border: 1px solid #e2e8f0; border-radius: 15px; background: #fff; box-shadow: 0 4px 14px rgba(0,0,0,.03); }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Dashboard Kepala Dusun 👋</h1>
            <p class="text-muted mb-0 small">Sistem Persuratan Desa Rambipuji — Pantau pengajuan surat warga wilayah Anda.</p>
        </div>
        <div class="badge bg-primary text-white px-3 py-2 rounded-pill fw-semibold shadow-sm d-none d-md-flex align-items-center gap-2">
            <i class="bi bi-calendar-event-fill" style="margin-right: 8px"></i>
            <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    {{-- 4 STAT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card d-flex align-items-center" style="gap:20px;">
                <div class="stat-icon" style="background:#e0f2fe;color:#0284c7;"><i class="bi bi-inbox-fill"></i></div>
                <div>
                    <div class="stat-label">Surat Masuk</div>
                    <div class="stat-value">{{ $suratMasuk }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card d-flex align-items-center" style="gap:20px;">
                <div class="stat-icon" style="background:#fff7ed;color:#ea580c;"><i class="bi bi-hourglass-split"></i></div>
                <div>
                    <div class="stat-label">Surat Diproses</div>
                    <div class="stat-value">{{ $diproses }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
          
            <div class="stat-card d-flex align-items-center" style="gap:20px;">
                <div class="stat-icon" style="background:#dcfce7;color:#16a34a;"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                    <div class="stat-label">Surat Selesai</div>
                    <div class="stat-value">{{ $selesai }}</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card d-flex align-items-center" style="gap:20px;">
                <div class="stat-icon" style="background:#fee2e2;color:#dc2626;"><i class="bi bi-x-circle-fill"></i></div>
                <div>
                    <div class="stat-label">Surat Ditolak</div>
                    <div class="stat-value">{{ $ditolak }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2 GRAFIK --}}
    <div class="row g-3">
        {{-- Grafik Bar: Surat Per Bulan --}}
        <div class="col-lg-7">
            <div class="chart-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-bar-chart-fill text-primary" style="margin-right: 10px;"></i>Surat Per Bulan</h5>
                    <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-1" style="font-size:11px;">Tahun 2026</span>
                </div>
                <div style="height:260px;"><canvas id="chartSuratBulan"></canvas></div>
            </div>
        </div>
        {{-- Grafik Doughnut: Distribusi Status --}}
        <div class="col-lg-5">
            <div class="chart-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-pie-chart-fill text-primary" style="margin-right: 10px;"></i>Status Surat</h5>
                    <span class="badge bg-success-subtle text-success fw-semibold px-3 py-1" style="font-size:11px;">Realtime</span>
                </div>
                <div style="height:260px;display:flex;align-items:center;justify-content:center;">
                    <canvas id="chartStatusSurat" style="max-height:240px;max-width:280px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // === GRAFIK BAR: SURAT PER BULAN ===
    const ctxBar = document.getElementById('chartSuratBulan');
    if (ctxBar) {
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
                datasets: [{
                    label: 'Surat Diajukan',
                    data: {!! json_encode($suratBulanDiajukan) !!},
                    backgroundColor: 'rgba(0,87,166,0.12)',
                    borderColor: '#0057A6',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                },{
                    label: 'Surat Selesai',
                    data: {!! json_encode($suratBulanSelesai) !!},
                    backgroundColor: 'rgba(22,163,74,0.12)',
                    borderColor: '#16a34a',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { position:'bottom', labels:{ font:{family:"'Poppins',sans-serif",size:12,weight:'600'}, padding:16 } } },
                scales: {
                    y: { beginAtZero:true, grid:{ color:'rgba(0,0,0,.04)' }, ticks:{ font:{family:"'Poppins',sans-serif"} } },
                    x: { grid:{ display:false }, ticks:{ font:{family:"'Poppins',sans-serif"} } }
                }
            }
        });
    }

    // === GRAFIK DOUGHNUT: STATUS SURAT ===
    const ctxDoughnut = document.getElementById('chartStatusSurat');
    if (ctxDoughnut) {
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Surat Masuk','Diproses','Selesai','Ditolak'],
                datasets: [{ data: [{{ $suratMasuk }}, {{ $diproses }}, {{ $selesai }}, {{ $ditolak }}], backgroundColor:['#3b82f6','#f59e0b','#22c55e','#ef4444'], borderWidth:3, borderColor:'#fff' }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '65%',
                plugins: { legend: { position:'bottom', labels:{ font:{family:"'Poppins',sans-serif",size:11,weight:'600'}, padding:12, boxWidth:12 } } }
            }
        });
    }
});
</script>
@endpush