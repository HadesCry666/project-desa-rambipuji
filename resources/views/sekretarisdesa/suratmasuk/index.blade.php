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
            <p class="text-muted small mb-0">Verifikasi dan periksa keabsahan dokumen serta Keterangan Admin sebelum diteruskan ke Kepala Desa.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0">Daftar Surat Menunggu Verifikasi (Disetujui Admin)</h4>
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
                                <th>Nama Warga</th>
                                <th class="text-center">Jenis Surat</th>
                                <th class="text-center">Keterangan Admin</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:230px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="">
                                    <div class="fw-semibold">
                                        {{ $r->nama_lengkap ?? 'Warga' }}
                                    </div>
                                    <div style="font-size:11px;color:#e83e8c;">
                                        {{ $r->nik }}
                                    </div>
                                </td>
                                <td class="text-center"><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $r->nama_surat ?? 'Surat Keterangan' }}</span></td>
                                <td class="text-center">
                                    @if(!empty($r->keterangan_admin))
                                        <span class="text-dark small d-inline-block text-truncate" style="max-width:200px;" title="{{ $r->keterangan_admin }}">
                                            <i class="bi bi-chat-quote-fill text-warning me-1"></i>{{ $r->keterangan_admin }}
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-center"><span class="badge-admin">✓ {{ $r->status }}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalDetailSekdes-{{ $r->id_pengajuan }}"><i class="bi bi-eye-fill"></i> </button>
                                    <form action="{{ route('sekdes.suratmasuk.setuju', $r->id_pengajuan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success btn-rounded px-2 me-1"><i class="bi bi-check-lg"></i> </button>
                                    </form>
                                    <button class="btn btn-sm btn-danger btn-rounded px-2" data-bs-toggle="modal" data-bs-target="#modalTolakSekdes-{{ $r->id_pengajuan }}"><i class="bi bi-x-lg"></i> </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Tidak ada surat masuk yang menunggu verifikasi Sekretaris Desa.</td>
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

{{-- MODALS --}}
@foreach($datapengajuan as $r)

{{-- MODAL DETAIL SEKDES --}}
<div class="modal fade" id="modalDetailSekdes-{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-text-fill me-2"></i>Detail Pengajuan — {{ $r->nama_surat }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background:#f8fafc">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-person-badge-fill me-2"></i>Data Pemohon</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Nama Lengkap</span><strong>{{ $r->nama_lengkap }}</strong></div>
                            <div class="mb-2"><span class="text-muted small d-block">NIK</span><code>{{ $r->nik }}</code></div>
                            <div class="mb-2"><span class="text-muted small d-block">Alamat</span><span>{{ $r->alamat }} RT {{ $r->rt }} / RW {{ $r->rw }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-file-earmark-richtext-fill me-2"></i>Data Surat</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Jenis Surat</span><span class="badge bg-primary">{{ $r->nama_surat }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Keperluan</span><span>{{ $r->keperluan }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Tanggal Pengajuan</span><span class="fw-medium"><i class="bi bi-calendar-event text-primary me-1"></i>{{ $r->tanggal_diajukan ?? $r->created_at }}</span></div>
                            <div><span class="text-muted small d-block mb-1">Lampiran Foto</span>
                                @for($f=1; $f<=8; $f++)
                                    @php $foto = 'foto'.$f; @endphp
                                    @if(!empty($r->$foto))
                                        <a href="{{ asset($r->$foto) }}" target="_blank" class="badge bg-light text-dark border me-1 mb-1 text-decoration-none">
                                            <i class="bi bi-image me-1"></i>Foto {{ $f }}
                                        </a>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keterangan Admin --}}
                <div class="card border-warning shadow-sm rounded-3 p-3 mb-3" style="background:#fffef3">
                    <h6 class="fw-bold text-warning border-bottom pb-2 mb-2"><i class="bi bi-chat-square-quote-fill me-2"></i>Keterangan Verifikasi Admin</h6>
                    <p class="mb-0 text-dark fw-medium">{{ $r->keterangan_admin ?? 'Berkas telah diverifikasi Admin.' }}</p>
                </div>

                {{-- Riwayat Timeline --}}
                <div class="card border-0 shadow-sm rounded-3 p-3">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-clock-history me-2"></i>Riwayat Persetujuan</h6>
                    <div class="position-relative" style="padding-left:28px;border-left:2px solid #e2e8f0">
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">Diajukan</span>
                            <small class="text-muted">{{ $r->tanggal_diajukan ?? $r->created_at }}</small>
                        </div>
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-info d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">Disetujui Kepala Dusun</span>
                        </div>
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-success d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">Disetujui Admin</span>
                            <small class="text-muted">{{ $r->keterangan_admin }}</small>
                        </div>
                        <div class="mb-1 position-relative opacity-50">
                            <div class="position-absolute rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-dash-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-muted d-block">Verifikasi Sekretaris Desa</span>
                            <small class="text-muted">Menunggu tindakan Anda</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalTolakSekdes-{{ $r->id_pengajuan }}"><i class="bi bi-x-circle-fill me-1"></i>Tolak</button>
                <form action="{{ route('sekdes.suratmasuk.setuju', $r->id_pengajuan) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-rounded px-4"><i class="bi bi-check-circle-fill me-1"></i>Setujui & Teruskan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TOLAK SEKDES --}}
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
                        <textarea class="form-control rounded-3" name="keterangan_ditolak" rows="3" required placeholder="Contoh: Lampiran berkas kurang jelas..."></textarea>
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
