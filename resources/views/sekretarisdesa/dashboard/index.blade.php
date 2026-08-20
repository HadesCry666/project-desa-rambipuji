@extends('admin.layout.main')
@section('title', 'Dashboard Sekretaris Desa')

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
a.text-decoration-none,
a.text-decoration-none:hover,
a.text-decoration-none:focus {
    color: inherit !important;
    text-decoration: none !important;
}
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Dashboard Sekretaris Desa 👋</h1>
            <p class="text-muted mb-0 small">Sistem Persuratan Desa Rambipuji — Verifikasi & persetujuan surat masuk tingkat Sekretaris Desa.</p>
        </div>
        <div class="badge bg-primary text-white px-3 py-2 rounded-pill fw-semibold shadow-sm d-none d-md-flex align-items-center gap-2">
            <i class="bi bi-calendar-event-fill" style="margin-right: 8px"></i>
            <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    {{-- 3 STAT CARDS SEKDES --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-4">
            <a href="{{ url('/sekretarisdesa/suratmasuk') }}" class="text-decoration-none">
            <div class="stat-card d-flex align-items-center" style="gap:20px;">
                <div class="stat-icon" style="background:#fff7ed;color:#ea580c;"><i class="bi bi-hourglass-split"></i></div>
                <div>
                    <div class="stat-label">Menunggu Persetujuan</div>
                    <div class="stat-value">{{ $menunggu }}</div>
                    {{-- <div class="text-muted" style="font-size:0.72rem;">Status: Disetujui Admin</div> --}}
                </div>
            </div>
            </a>
        </div>
        <div class="col-12 col-lg-4">
            <a href="{{ url('/sekretarisdesa/suratselesai') }}" class="text-decoration-none">
            <div class="stat-card d-flex align-items-center" style="gap:20px;">
                <div class="stat-icon" style="background:#dcfce7;color:#16a34a;"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                    <div class="stat-label">Surat Selesai</div>
                    <div class="stat-value">{{ $selesai }}</div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-12 col-lg-4">
            <a href="{{ url('/sekretarisdesa/suratditolak') }}" class="text-decoration-none">
            <div class="stat-card d-flex align-items-center" style="gap:20px;">
                <div class="stat-icon" style="background:#fee2e2;color:#dc2626;"><i class="bi bi-x-circle-fill"></i></div>
                <div>
                    <div class="stat-label">Surat Ditolak</div>
                    <div class="stat-value">{{ $ditolak }}</div>
                </div>
            </div>
            </a>
        </div>
    </div>

    {{-- 2 GRAFIK --}}
    <div class="row g-3">
        <div class="col-lg-7">
            <div class="chart-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-bar-chart-fill text-primary" style="margin-right: 10px;"></i>Surat Per Bulan</h5>
                    <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-1" style="font-size:11px;">Tahun 2026</span>
                </div>
                <div style="height:260px;"><canvas id="chartSuratSekdes"></canvas></div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="chart-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-pie-chart-fill text-primary" style="margin-right: 10px;"></i>Status Surat</h5>
                    <span class="badge bg-success-subtle text-success fw-semibold px-3 py-1" style="font-size:11px;">Realtime</span>
                </div>
                <div style="height:260px;display:flex;align-items:center;justify-content:center;">
                    <canvas id="chartStatusSekdes" style="max-height:240px;max-width:280px;"></canvas>
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
    const ctxBar = document.getElementById('chartSuratSekdes');
    if (ctxBar) {
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
                datasets: [{
                    label: 'Surat Masuk Sekdes',
                    data: {!! json_encode($suratBulanMasuk) !!},
                    backgroundColor: 'rgba(0,87,166,0.12)', borderColor: '#0057A6', borderWidth: 2, borderRadius: 8, borderSkipped: false,
                },{
                    label: 'Disetujui Sekdes',
                    data: {!! json_encode($suratBulanDisetujui) !!},
                    backgroundColor: 'rgba(22,163,74,0.12)', borderColor: '#16a34a', borderWidth: 2, borderRadius: 8, borderSkipped: false,
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
    const ctxD = document.getElementById('chartStatusSekdes');
    if (ctxD) {
        new Chart(ctxD, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu Persetujuan','Selesai','Ditolak'],
                datasets: [{ data: [{{ $menunggu }}, {{ $selesai }}, {{ $ditolak }}], backgroundColor:['#3b82f6','#22c55e','#ef4444'], borderWidth:3, borderColor:'#fff' }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: { legend: { position:'bottom', labels:{ font:{family:"'Poppins',sans-serif",size:11,weight:'600'}, padding:12, boxWidth:12 } } }
            }
        });
    }
});
</script>
@endpush
