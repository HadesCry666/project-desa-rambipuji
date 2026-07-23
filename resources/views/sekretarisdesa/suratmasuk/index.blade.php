@extends('admin.layout.main')

@section('title', 'Surat Masuk Sekretaris Desa')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0,0,0,0.03) !important; background: #fff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 6px !important; }
    .table-modern thead th { background-color: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: 0.75rem !important; letter-spacing: 0.6px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 14px 16px !important; }
    .table-modern tbody tr { background-color: #fff !important; box-shadow: 0 2px 6px rgba(0,0,0,0.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 14px 16px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: 0.88rem !important; }
    .btn-rounded { border-radius: 30px !important; }
    .badge-admin { background: #e0e7ff; color: #3730a3; font-weight: 600; padding: 6px 12px; border-radius: 20px; font-size: 0.78rem; display: inline-flex; align-items: center; gap: 4px; }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Surat Masuk — Sekretaris Desa</h1>
            <p class="text-muted small mb-0">Verifikasi dan periksa keabsahan dokumen pengajuan surat warga sebelum disahkan Kepala Desa.</p>
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
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-inbox-fill text-primary me-2"></i>Daftar Surat Menunggu Verifikasi</h4>
                <form class="d-flex" action="{{ route('sekdes.suratmasuk.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari NIK / Nama / Surat">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableSuratSekdes">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th>ID Pengajuan</th>
                                <th>Nama Warga</th>
                                <th>NIK</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:210px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td><span class="fw-bold text-primary" style="font-size:.82rem">#{{ $r->id_pengajuan }}</span></td>
                                <td class="fw-semibold text-dark">{{ $r->nama_lengkap ?? 'Warga' }}</td>
                                <td><code style="font-size:.8rem">{{ $r->nik }}</code></td>
                                <td><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $r->nama_surat ?? 'Surat Keterangan' }}</span></td>
                                <td class="text-muted">{{ $r->tanggal_diajukan ? \Carbon\Carbon::parse($r->tanggal_diajukan)->translatedFormat('d M Y') : '-' }}</td>
                                <td class="text-center"><span class="badge-admin">✓ {{ $r->status }}</span></td>
                                <td class="text-center">
                                    <form action="{{ route('sekdes.suratmasuk.setuju', $r->id_pengajuan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success btn-rounded px-3 me-1"><i class="bi bi-check-lg"></i> Setujui</button>
                                    </form>
                                    <button class="btn btn-sm btn-danger btn-rounded px-3" data-bs-toggle="modal" data-bs-target="#modalTolakSekdes-{{ $r->id_pengajuan }}"><i class="bi bi-x-lg"></i> Tolak</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Tidak ada surat masuk yang menunggu verifikasi Sekretaris Desa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $datapengajuan->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MODALS TOLAK --}}
@foreach($datapengajuan as $r)
<div class="modal fade" id="modalTolakSekdes-{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <form action="{{ route('sekdes.suratmasuk.tolak', $r->id_pengajuan) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger"><i class="bi bi-x-circle-fill me-2"></i>Tolak Pengajuan Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <p class="text-muted small">Berikan alasan penolakan pengajuan surat <strong>{{ $r->nama_surat }}</strong> atas nama <strong>{{ $r->nama_lengkap }}</strong>:</p>
                    <div class="mb-3">
                        <textarea class="form-control rounded-3" name="keterangan_ditolak" rows="3" required placeholder="Contoh: Lampiran foto KTP/KK kurang jelas..."></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-rounded px-4">Tolak Pengajuan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
