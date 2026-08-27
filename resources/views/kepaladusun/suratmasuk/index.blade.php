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
                                <th class="">Nama Pemohon</th>
                                {{-- <th class="text-center">NIK</th> --}}
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
                                <td class="">
                                    <div class="fw-semibold">
                                        {{ $r->nama_lengkap ?? 'Warga' }}
                                    </div>
                                    <div style="font-size:11px;color:#e83e8c;">
                                        {{ $r->nik }}
                                    </div>
                                </td>
                                {{-- <td class="text-center"><code style="font-size:.8rem">{{ $r->nik }}</code></td> --}}
                                <td class="text-center small-text"><span class="badge bg-light text-dark border fw-medium">{{ $r->nama_surat ?? 'Surat Keterangan' }}</span></td>
                                <td class="text-muted text-center">{{ $r->tanggal_diajukan ?? $r->created_at }}</td>
                                <td class="text-center"><span class="badge-diajukan">{{ $r->status }}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalDetailKadus{{ $r->id_pengajuan }}"><i class="bi bi-eye-fill"></i> </button>
                                    <form action="{{ route('kadus.suratmasuk.setuju', $r->id_pengajuan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success btn-rounded px-2 me-1"><i class="bi bi-check-lg"></i> </button>
                                    </form>
                                    <button class="btn btn-sm btn-danger btn-rounded px-2" data-bs-toggle="modal" data-bs-target="#modalTolakKadus{{ $r->id_pengajuan }}"><i class="bi bi-x-lg"></i> </button>
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

<div class="modal fade" id="modalDetailKadus{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-4">
                {{-- BARIS 1: Informasi Pemohon & Informasi Surat Sejajar --}}
                <div class="row g-3 mb-3">
                    <!-- 1. Informasi Pemohon (Kiri) -->
                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold border-bottom pb-2 mb-3">
                                Informasi Pemohon
                            </h6>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Nama Lengkap</span>
                                <strong>{{ $r->nama_lengkap }}</strong>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">NIK</span>
                                <code>{{ $r->nik }}</code>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Alamat</span>
                                <span>{{ $r->alamat }}, RT {{ $r->rt }} / RW {{ $r->rw }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Informasi Surat (Kanan) -->
                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold border-bottom pb-2 mb-3">
                                Informasi Surat
                            </h6>
                            <div class="mb-2">
                                <span class="text-muted small d-block mb-2">Jenis Surat</span>
                                <span class="badge bg-primary">{{ $r->nama_surat }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Keterangan Admin</span>
                                <span>{{ $r->keterangan_admin }}</span>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Tanggal Pengajuan</span>
                                <span class="fw-medium">
                                    <i class="bi bi-calendar-event-fill text-primary me-2"></i>
                                    @if (!empty($r->tanggal_diajukan))
                                        {{ \Carbon\Carbon::createFromFormat('d/m/Y', $r->tanggal_diajukan)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif (!empty($r->created_at))
                                        {{ \Carbon\Carbon::parse($r->created_at)->locale('id')->translatedFormat('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BARIS 2: Lampiran Dokumen di Bawah --}}
                <div class="card border-0 shadow-sm rounded-3 p-3">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">
                        <i class="bi bi-paperclip me-2"></i>Lampiran Dokumen
                    </h6>
                    
                    <div class="row g-3">
                        @php $hasAttachment = false; @endphp
                        @for($f=1; $f<=8; $f++)
                            @php $foto = 'foto'.$f; @endphp
                            @if(!empty($r->$foto))
                                @php 
                                    $hasAttachment = true; 
                                    $filePath = public_path($r->$foto);
                                    $fileName = basename($r->$foto);
                                    $fileSize = file_exists($filePath) ? round(filesize($filePath) / 1024, 1) . ' KB' : null;
                                @endphp
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="card border rounded-3 overflow-hidden shadow-sm">
                                        <!-- Thumbnail 16:9 -->
                                        <div class="ratio ratio-16x9 bg-light border-bottom position-relative" style="aspect-ratio: 16/9;">
                                            <img src="{{ asset($r->$foto) }}" 
                                                 class="w-100 h-100 position-absolute top-0 start-0" 
                                                 style="object-fit: cover;" 
                                                 alt="Lampiran {{ $f }}" 
                                                 onerror="this.onerror=null;this.parentElement.innerHTML='<div class=\'d-flex align-items-center justify-content-center h-100 text-muted\'><i class=\'bi bi-file-earmark-image fs-1\'></i></div>';">
                                        </div>
                                        
                                        <!-- Body Kartu -->
                                        <div class="p-2">
                                            <div class="mb-2">
                                                <small class="fw-bold text-truncate d-block text-dark" title="{{ $fileName }}">
                                                    {{ $fileName }}
                                                </small>
                                                @if($fileSize)
                                                    <small class="text-muted d-block" style="font-size: 0.75rem;">({{ $fileSize }})</small>
                                                @endif
                                            </div>
                                            <a href="{{ asset($r->$foto) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 py-1" style="font-size: 0.8rem;">
                                                Lihat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor

                        @if(!$hasAttachment)
                            <div class="col-12 text-center text-muted py-4">
                                <i class="bi bi-folder-x fs-2 d-block mb-1"></i>
                                <small>Tidak ada lampiran dokumen yang diunggah.</small>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalTolakKadus{{ $r->id_pengajuan }}">Tolak</button>
                <form action="{{ route('kadus.suratmasuk.setuju', $r->id_pengajuan) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-rounded px-4 me-1">Setuju </button>
                </form>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="modalTolakKadus{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('kadus.suratmasuk.tolak', $r->id_pengajuan) }}" method="POST">
                @csrf
                <!-- Header -->
                <div class="modal-header rounded-top-4 py-3 px-4">
                    <h5 class="modal-title fw-bold">Tolak Pengajuan Surat</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body dengan padding rapat (pb-2) -->
                <div class="modal-body px-4 pt-3 pb-2">
                    <!-- Ringkasan Data Pemohon -->
                    <div class="card border-0 bg-light rounded-3 p-3 mb-3">
                        <div class="mb-1"><span class="text-muted small d-block">Pemohon</span><strong>{{ $r->nama_lengkap }}</strong></div>
                        <div class="mb-1"><span class="text-muted small d-block">NIK</span><code style="font-size: 110%">{{ $r->nik }}</code></div>
                        <div><span class="text-muted small d-block mb-1">Jenis Surat</span><span class="badge bg-secondary">{{ $r->nama_surat }}</span></div>
                    </div>

                    <!-- Input Alasan Penolakan (Card dihapus agar tidak menambah ruang kosong) -->
                    <div class="mb-2">
                        <label for="keterangan_ditolak-{{ $r->id_pengajuan }}" class="fw-bold mb-1">
                            Alasan Penolakan <span class="text-danger">*</span>
                        </label>
                        <p class="text-muted small mb-2">Jelaskan alasan penolakan agar pemohon dapat mengetahuinya.</p>
                        <textarea class="form-control rounded-3" 
                                  id="keterangan_ditolak-{{ $r->id_pengajuan }}" 
                                  name="keterangan_ditolak" 
                                  rows="3" 
                                  placeholder="Tuliskan alasan penolakan secara jelas..." 
                                  required></textarea>
                    </div>
                </div>

                <!-- Footer Rapat (pt-1) -->
                <div class="modal-footer border-0 bg-white pt-1 pb-3 px-4 rounded-bottom-4">
                    <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-rounded px-4">
                       Tolak Pengajuan
                    </button>
                </div>
            </form>
        </div>
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
