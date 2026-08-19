@extends('admin.layout.main')

@section('title', 'Surat Ditolak Sekretaris Desa')

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
            <h1 class="fw-bold text-dark mb-1">Arsip Surat Ditolak — Sekretaris Desa</h1>
            <p class="text-muted small mb-0">Daftar surat pengajuan yang tidak disetujui beserta alasan penolakannya.</p>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"></i>Data Pengajuan Ditolak</h4>
                <form class="d-flex" action="{{ route('sekdes.suratditolak.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari NIK / Nama / Surat">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableSuratDitolakSekdes">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>ID Pengajuan</th>
                                <th>Nama Pemohon</th>
                                <th class="text-center">Jenis Surat</th>
                                <th class="text-center">Keterangan Penolakan</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td><span class="fw-bold text-primary">#{{ $row->id_pengajuan }}</span></td>
                                <td class="">
                                    <div class="fw-semibold">
                                        {{ $row->nama_lengkap ?? 'Warga' }}
                                    </div>
                                    <div style="font-size:11px;color:#e83e8c;">
                                        {{ $row->nik }}
                                    </div>
                                </td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $row->nama_surat ?? 'Surat Keterangan' }}</span></td>
                                <td class="text-danger small fw-medium">{{ $row->keterangan_ditolak ?? 'Berkas tidak memenuhi syarat' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-danger text-white fw-bold px-3 py-1 rounded-pill">
                                        {{ $row->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data pengajuan surat yang ditolak.</td>
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
@endsection
