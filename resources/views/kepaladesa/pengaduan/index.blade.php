@extends('admin.layout.main')

@section('title', 'Master Pengaduan Kepala Desa')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03) !important; background: #ffffff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 6px !important; }
    .table-modern thead th { background-color: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: 0.75rem !important; letter-spacing: 0.6px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 14px 16px !important; }
    .table-modern tbody tr { background-color: #ffffff !important; box-shadow: 0 2px 6px rgba(0,0,0,0.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 14px 16px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: 0.88rem !important; }
    .btn-rounded { border-radius: 30px !important; }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Master Pengaduan — Kepala Desa</h1>
            <p class="text-muted small mb-0">Monitor laporan pengaduan & aspirasi warga Desa Rambipuji.</p>
        </div>
        <div>
            <span class="badge bg-danger rounded-pill px-3 py-2">
                <i class="bi bi-megaphone-fill me-1"></i> Pengawasan Pengaduan
            </span>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-chat-left-dots-fill text-primary me-2"></i>Laporan Masuk Dari Warga</h4>
                <form class="d-flex" action="{{ route('kades.pengaduan.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari Pelapor / NIK / Kategori">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tablePengaduanKades">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Tanggal</th>
                                <th>Pelapor / NIK</th>
                                <th>Kategori</th>
                                <th>Ulasan / Laporan</th>
                                <th>Feedback Desa</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduan as $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="small text-muted">{{ $row->created_at ? $row->created_at->translatedFormat('d M Y') : '-' }}</td>
                                <td>
                                    <strong class="d-block text-dark">{{ $row->penduduk->nama_lengkap ?? 'Warga' }}</strong>
                                    <small class="text-muted"><code>{{ $row->nik }}</code></small>
                                </td>
                                <td><span class="badge bg-primary-subtle text-primary border border-primary fw-medium px-3 py-1 rounded-pill">{{ $row->kategori }}</span></td>
                                <td class="small">{{ Str::limit($row->ulasan, 60) }}</td>
                                <td>
                                    @if($row->feedback)
                                        <span class="text-success small fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> {{ Str::limit($row->feedback, 50) }}</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning fw-normal px-2 py-1">Belum Ditanggapi</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info btn-rounded px-3 me-1" data-bs-toggle="modal" data-bs-target="#modalDetailPengaduanKades-{{ $row->id }}">
                                        <i class="bi bi-eye-fill me-1"></i> Detail
                                    </button>
                                </td>
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
    </div>
</section>

@foreach($pengaduan as $row)
<div class="modal fade" id="modalDetailPengaduanKades-{{ $row->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-megaphone-fill me-2"></i>Detail Pengaduan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8fafc;">
                <div class="card card-modern p-3 mb-3">
                    <h6 class="fw-bold text-primary mb-2">Kategori: {{ $row->kategori }}</h6>
                    <div class="small text-muted mb-3"><i class="bi bi-person me-1"></i>{{ $row->penduduk->nama_lengkap ?? 'Warga' }} ({{ $row->nik }})</div>
                    <p class="text-dark bg-light p-3 rounded-3 border mb-0">{{ $row->ulasan }}</p>
                </div>
                @if($row->feedback)
                <div class="alert alert-success border mb-0">
                    <strong><i class="bi bi-reply-fill me-1"></i> Feedback Desa:</strong>
                    <p class="mb-0 mt-1 small">{{ $row->feedback }}</p>
                </div>
                @endif
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
