@extends('admin.layout.main')

@section('title', 'Pengaduan Masyarakat Sekretaris Desa')

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
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Pengaduan Masyarakat — Sekretaris Desa</h1>
            <p class="text-muted small mb-0">Pantau dan berikan feedback atas laporan atau aspirasi warga desa.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

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
                    <table class="table table-modern w-100" id="tablePengaduanSekdes">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Pelapor</th>
                                <th>NIK</th>
                                <th>Kategori</th>
                                <th>Ulasan / Laporan</th>
                                <th>Feedback / Tanggapan</th>
                                <th class="text-center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduan as $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ $row->penduduk->nama_lengkap ?? 'Warga' }}</td>
                                <td><code>{{ $row->nik }}</code></td>
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
                                    <button type="button" class="btn btn-sm btn-info btn-rounded px-3" data-bs-toggle="modal" data-bs-target="#modalFeedbackSekdes-{{ $row->id }}">
                                        <i class="bi bi-reply-fill me-1"></i> Tanggapi
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

{{-- MODAL FEEDBACK SEKDES --}}
@foreach($pengaduan as $row)
<div class="modal fade" id="modalFeedbackSekdes-{{ $row->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <form action="{{ route('sekdes.pengaduan.feedback', $row->id) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary"><i class="bi bi-reply-fill me-2"></i>Tanggapan Pengaduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="mb-3">
                        <label class="form-label text-muted small mb-1">Laporan dari {{ $row->penduduk->nama_lengkap ?? 'Warga' }} ({{ $row->kategori }})</label>
                        <div class="p-3 bg-light rounded-3 small text-dark border">{{ $row->ulasan }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggapan / Feedback Desa</label>
                        <textarea class="form-control rounded-3" name="feedback" rows="4" required placeholder="Tuliskan tindak lanjut atau tanggapan resmi desa...">{{ $row->feedback }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-rounded px-4">Kirim Tanggapan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
