@extends('admin.layout.main')
@section('title', 'Surat Masuk Kepala Dusun')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body,.main-content{font-family:'Poppins','Plus Jakarta Sans',sans-serif!important}
.card-modern{border:1px solid #e2e8f0;border-radius:15px;box-shadow:0 4px 16px rgba(0,0,0,.03);background:#fff}
.table-modern{border-collapse:separate!important;border-spacing:0 5px!important}
.table-modern thead th{background:#f8fafc!important;color:#475569!important;font-weight:600!important;font-size:.74rem!important;text-transform:uppercase!important;letter-spacing:.6px!important;border-bottom:2px solid #e2e8f0!important;padding:13px 16px!important}
.table-modern tbody tr{background:#fff!important;transition:background .15s}
.table-modern tbody tr:hover{background:#f0f7ff!important}
.table-modern tbody td{padding:13px 16px!important;vertical-align:middle!important;border-top:1px solid #f1f5f9!important;font-size:.875rem!important}
.btn-rounded{border-radius:30px!important}
.badge-diajukan{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;font-weight:600;padding:5px 12px;border-radius:20px;font-size:.78rem}
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Surat Masuk Kepala Dusun</h1>
            <p class="text-muted small mb-0">Daftar pengajuan surat warga yang menunggu persetujuan Anda.</p>
        </div>
        <a href="{{ route('kadus.tambahpengajuan.index') }}" class="btn btn-primary btn-rounded px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Ajukan Surat untuk Warga
        </a>
    </div>

    @if(session('success'))
    <div id="alertPopup" class="alert alert-success alert-floating">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"></i>Pengajuan Masuk — Status: Diajukan</h4>
                <form class="d-flex" action="{{ route('kadus.suratmasuk.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari NIK / Nama / Surat">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableKadus">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th class="text-center">Nama Pemohon</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">Jenis Surat</th>
                                <th class="text-center">Tanggal Pengajuan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:230px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark text-center">{{ $r->nama_lengkap ?? 'Warga' }}</td>
                                <td class="text-center"><code style="font-size:.8rem">{{ $r->nik }}</code></td>
                                <td class="text-center"><span class="badge bg-light text-dark border fw-medium">{{ $r->nama_surat ?? 'Surat Keterangan' }}</span></td>
                                <td class="text-muted text-center">{{ $r->tanggal_diajukan ?? $r->created_at }}</td>
                                <td class="text-center"><span class="badge-diajukan">{{ $r->status }}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $r->id_pengajuan }}"><i class="bi bi-eye-fill"></i> </button>
                                    <form action="{{ route('kadus.suratmasuk.setuju', $r->id_pengajuan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success btn-rounded px-2 me-1"><i class="bi bi-check-lg"></i> </button>
                                    </form>
                                    <button class="btn btn-sm btn-danger btn-rounded px-2" data-bs-toggle="modal" data-bs-target="#modalTolak-{{ $r->id_pengajuan }}"><i class="bi bi-x-lg"></i> </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada pengajuan surat masuk untuk Kepala Dusun.</td>
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

{{-- ============ MODALS ============ --}}
@foreach($datapengajuan as $r)

{{-- MODAL DETAIL --}}
{{-- MODAL DETAIL --}}
<div class="modal fade" id="modalDetail-{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">

            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-primary">
                    <i class="bi bi-file-earmark-text-fill me-2"></i>
                    Detail Pengajuan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Pemohon</label>
                    <div class="form-control bg-light">{{ $r->nama_lengkap }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIK</label>
                    <div class="form-control bg-light">{{ $r->nik }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Surat</label>
                    <div class="form-control bg-light">{{ $r->nama_surat }}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keperluan</label>
                    <div class="form-control bg-light" style="min-height:80px">
                        {{ $r->keperluan }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Lampiran</label>

                    @php
                        $adaLampiran = false;
                    @endphp

                    <div class="d-flex flex-wrap gap-2">
                        @for($f=1;$f<=8;$f++)
                            @php $foto='foto'.$f; @endphp

                            @if(!empty($r->$foto))
                                @php $adaLampiran = true; @endphp

                                <div class="d-flex flex-wrap gap-3">
                                @for($f=1;$f<=8;$f++)
                                    @php $foto = 'foto'.$f; @endphp

                                    @if(!empty($r->$foto))
                                        <a href="{{ asset($r->$foto) }}" target="_blank">
                                            <img
                                                src="{{ asset($r->$foto) }}"
                                                class="img-thumbnail"
                                                style="width:100%;height:100%;object-fit:cover;">
                                        </a>
                                    @endif
                                @endfor
                                </div>
                            @endif
                        @endfor

                        @if(!$adaLampiran)
                            <span class="text-muted">Tidak ada lampiran.</span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="modal-footer border-0">

                <button type="button"
                        class="btn btn-secondary btn-rounded px-4"
                        data-bs-dismiss="modal">
                    Tutup
                </button>

                <button type="button"
                        class="btn btn-danger btn-rounded px-4"
                        data-bs-dismiss="modal"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTolak-{{ $r->id_pengajuan }}">
                    <i class="bi bi-x-lg me-1"></i>
                    Tolak
                </button>

                <form action="{{ route('kadus.suratmasuk.setuju', $r->id_pengajuan) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-rounded px-4">
                        <i class="bi bi-check-lg me-1"></i>
                        Setujui
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div class="modal fade" id="modalTolak-{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <form action="{{ route('kadus.suratmasuk.tolak', $r->id_pengajuan) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger"><i class="bi bi-x-circle-fill me-2"></i>Tolak Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <p class="text-muted small mb-3">Pemohon: <strong>{{ $r->nama_lengkap }}</strong> ({{ $r->nama_surat }})</p>
                    <label class="form-label fw-semibold">Alasan Penolakan <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-3" name="keterangan_ditolak" rows="4" placeholder="Masukkan alasan penolakan yang jelas..." required></textarea>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-rounded px-4">
                            <i class="bi bi-x-lg me-1"></i>Tolak Pengajuan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $('#tableKadus').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
        pageLength: 10, responsive: true,
        columnDefs: [{ orderable: false, targets: 6 }]
    });
});
</script>
@endpush
@endsection
