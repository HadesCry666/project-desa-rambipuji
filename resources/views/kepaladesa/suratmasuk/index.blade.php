@extends('admin.layout.main')

@section('title', 'Surat Masuk TTE Kepala Desa')

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
            <h1 class="fw-bold text-dark mb-1">Persetujuan Surat (TTE) — Kepala Desa</h1>
            <p class="text-muted small mb-0">Verifikasi akhir dan sahkan dokumen pengajuan surat warga menggunakan Tanda Tangan Elektronik.</p>
        </div>
        <div>
            <span class="badge bg-danger rounded-pill px-3 py-2">
                <i class="bi bi-shield-lock-fill me-1"></i> Hak Akses Pengesahan TTE
            </span>
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
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-file-earmark-arrow-up-fill text-primary me-2"></i>Pengajuan Menunggu Pengesahan</h4>
                <form class="d-flex" action="{{ route('kades.suratmasuk.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari NIK / Nama / Surat">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableSuratMasukKades">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>ID Pengajuan</th>
                                <th>Nama Pemohon</th>
                                <th>NIK</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Masuk</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 210px;">Aksi TTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td><span class="fw-bold text-primary">#{{ $row->id_pengajuan }}</span></td>
                                <td class="fw-semibold text-dark">{{ $row->nama_lengkap ?? 'Warga' }}</td>
                                <td><code>{{ $row->nik }}</code></td>
                                <td><span class="badge bg-light text-dark border">{{ $row->nama_surat ?? 'Surat Keterangan' }}</span></td>
                                <td class="text-muted">{{ $row->tanggal_diajukan ? \Carbon\Carbon::parse($row->tanggal_diajukan)->translatedFormat('d M Y') : '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-warning-subtle text-warning border border-warning fw-semibold px-3 py-1 rounded-pill">
                                        {{ $row->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('kades.suratmasuk.setuju', $row->id_pengajuan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success btn-rounded px-3 me-1"><i class="bi bi-pen-fill me-1"></i> Sahkan TTE</button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-danger btn-rounded px-3" data-bs-toggle="modal" data-bs-target="#modalTolakKades-{{ $row->id_pengajuan }}"><i class="bi bi-x-lg"></i> Tolak</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Belum ada pengajuan surat yang menunggu TTE Kepala Desa.</td>
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
@foreach($datapengajuan as $row)
<div class="modal fade" id="modalTolakKades-{{ $row->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <form action="{{ route('kades.suratmasuk.tolak', $row->id_pengajuan) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger"><i class="bi bi-x-circle-fill me-2"></i>Tolak Pengajuan Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <p class="text-muted small">Berikan alasan penolakan pengajuan surat <strong>{{ $row->nama_surat }}</strong> atas nama <strong>{{ $row->nama_lengkap }}</strong>:</p>
                    <div class="mb-3">
                        <textarea class="form-control rounded-3" name="keterangan_ditolak" rows="3" required placeholder="Tuliskan catatan perbaikan atau alasan penolakan..."></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-rounded px-4">Tolak Surat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
