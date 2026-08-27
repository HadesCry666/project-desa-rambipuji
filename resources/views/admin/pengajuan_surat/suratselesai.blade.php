@extends('admin.layout.main')
@section('title', 'Surat Selesai')

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
.badge-kadus{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;font-weight:600;padding:5px 12px;border-radius:20px;font-size:.78rem}
.badge-diajukan{background:#fef3c7;color:#d97706;border:1px solid #fde68a;font-weight:600;padding:5px 12px;border-radius:20px;font-size:.78rem}
.keterangan-preset {cursor:pointer;transition:all .15s;}
.keterangan-preset:hover{background-color:#dbeafe!important;border-color:#3b82f6!important;}
</style>
@endpush

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="section">
    <div class="section-header">
        <h1>Surat Selesai</h1>
    </div>
 
    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    {{-- Form Search --}}
                    <div class="card-header d-flex justify-content-between">
                        <form class="d-flex" action="{{ route('suratselesai.index') }}" method="get">
                            <input class="form-control me-1" type="search" name="katakunci"
                                   value="{{ Request::get('katakunci') }}"
                                   placeholder="Cari">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </form>
                    </div>

                    {{-- Table --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-modern w100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px">No</th>
                                        <th>Nama Pemohon</th>
                                        <th class="text-center">Jenis Surat</th>
                                        <th class="text-center">Tanggal Pengajuan</th>
                                        <th class="text-center">RW</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @forelse ($datapengajuan as $a)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-semibold">
                                                {{ $a->nama_lengkap ?? 'Warga' }}
                                            </div>
                                            <div style="font-size:11px;color:#e83e8c;">
                                                {{ $a->nik }}
                                            </div>
                                        </td>
                                        <td class="text-center"><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $a->nama_surat }}</span></td>
                                        <td class="text-muted text-center">{{ $a->tanggal_diajukan }}</td>
                                        <td class="text-center"><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $a->rw }}</span></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalDetailAdmin-{{ $a->id_pengajuan }}" title="Lihat Detail"><i class="bi bi-eye-fill"></i></button>
                                            <a href="{{ route('suratselesai.cetak', $a->id_pengajuan) }}"
                                                class="btn btn-sm btn-danger btn-rounded px-2"
                                                title="Cetak Surat PDF">
                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Belum ada pengajuan surat selesai.</td>
                                    </tr>
                                @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>


{{-- ========================= --}}
{{-- MODAL DI LUAR SECTION --}}
{{-- ========================= --}}

@foreach ($datapengajuan as $a)
{{-- MODAL DETAIL ADMIN --}}
<div class="modal fade" id="modalDetailAdmin-{{ $a->id_pengajuan }}" tabindex="-1" aria-hidden="true">
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
                                <strong>{{ $a->nama_lengkap }}</strong>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">NIK</span>
                                <code>{{ $a->nik }}</code>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Alamat</span>
                                <span>{{ $a->alamat }}, RT {{ $a->rt }} / RW {{ $a->rw }}</span>
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
                                <span class="badge bg-primary">{{ $a->nama_surat }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Keterangan Admin</span>
                                <span>{{ $a->keterangan_admin }}</span>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Tanggal Pengajuan</span>
                                <span class="fw-medium">
                                    <i class="bi bi-calendar-event-fill text-primary me-2"></i>
                                    @if (!empty($a->tanggal_diajukan))
                                        {{ \Carbon\Carbon::createFromFormat('d/m/Y', $a->tanggal_diajukan)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif (!empty($a->created_at))
                                        {{ \Carbon\Carbon::parse($a->created_at)->locale('id')->translatedFormat('d F Y') }}
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
                            @if(!empty($a->$foto))
                                @php 
                                    $hasAttachment = true; 
                                    $filePath = public_path($a->$foto);
                                    $fileName = basename($a->$foto);
                                    $fileSize = file_exists($filePath) ? round(filesize($filePath) / 1024, 1) . ' KB' : null;
                                @endphp
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="card border rounded-3 overflow-hidden shadow-sm">
                                        <!-- Thumbnail 16:9 -->
                                        <div class="ratio ratio-16x9 bg-light border-bottom position-relative" style="aspect-ratio: 16/9;">
                                            <img src="{{ asset($a->$foto) }}" 
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
                                            <a href="{{ asset($a->$foto) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 py-1" style="font-size: 0.8rem;">
                                                <i class="bi bi-eye me-1"></i>Lihat
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
        </div>
    </div>
</div>  
@endforeach
@endsection