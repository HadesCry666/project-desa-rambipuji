@extends('admin.layout.main')

@section('title', 'Monitoring Pengaduan — Sekretaris Desa')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0,0,0,0.03) !important; background: #ffffff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 6px !important; }
    .table-modern thead th { background-color: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: 0.75rem !important; letter-spacing: 0.6px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 14px 16px !important; }
    .table-modern tbody tr { background-color: #ffffff !important; box-shadow: 0 2px 6px rgba(0,0,0,0.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 14px 16px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: 0.88rem !important; }
    .btn-rounded { border-radius: 30px !important; }
    .readonly-badge { background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; padding: 4px 12px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Monitoring Pengaduan Masyarakat</h1>
            <p class="text-muted small mb-0">
                Pantau laporan dan aspirasi warga desa.
                <span class="readonly-badge ms-2"><i class="bi bi-eye-fill me-1"></i>Mode: Hanya Lihat</span>
            </p>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-chat-quote-fill text-primary me-2"></i>Daftar Laporan Pengaduan</h4>
                <form class="d-flex" action="{{ route('sekdes.pengaduan.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari NIK / Pelapor / Kategori">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Pelapor</th>
                                <th>NIK</th>
                                <th>Kategori</th>
                                <th>Ulasan / Laporan</th>
                                <th>Feedback Admin</th>
                                <th class="text-center">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduan as $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ $row->penduduk->nama_lengkap ?? 'Warga' }}</td>
                                <td><code>{{ $row->nik }}</code></td>
                                <td><span class="badge bg-primary-subtle text-primary border border-primary fw-medium px-3 py-1 rounded-pill">{{ $row->kategori }}</span></td>
                                <td class="small">
                                    <span title="{{ $row->ulasan }}">{{ Str::limit($row->ulasan, 60) }}</span>
                                </td>
                                <td>
                                    @if($row->feedback)
                                        <span class="text-success small fw-semibold">
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            {{ Str::limit($row->feedback, 50) }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning fw-normal px-2 py-1">Belum Ditanggapi Admin</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted small">{{ $row->created_at ? $row->created_at->format('d/m/Y') : '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data laporan pengaduan masyarakat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $pengaduan->links() }}
                </div>
            </div>
        </div>

        {{-- Info read-only notice --}}
        <div class="alert alert-info border-0 rounded-3 mt-3 py-2 px-4 small">
            <i class="bi bi-info-circle-fill me-2"></i>
            <strong>Sekretaris Desa</strong> hanya dapat memantau pengaduan dan melihat feedback dari Admin Desa. Untuk memberikan tanggapan, silahkan hubungi Admin Desa.
        </div>
    </div>
</section>
@endsection
