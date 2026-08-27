@extends('admin.layout.main')

@section('title', 'Surat Masuk TTE Kepala Desa')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 16px !important; box-shadow: 0 4px 20px rgba(0,0,0,0.04) !important; background: #ffffff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 8px !important; }
    .table-modern thead th { background-color: #f1f5f9 !important; color: #334155 !important; font-weight: 700 !important; text-transform: uppercase !important; font-size: 0.82rem !important; letter-spacing: 0.5px !important; border-bottom: 2px solid #cbd5e1 !important; padding: 16px 18px !important; }
    .table-modern tbody tr { background-color: #ffffff !important; box-shadow: 0 2px 8px rgba(0,0,0,0.03); border-radius: 12px !important; transition: transform 0.2s ease; }
    .table-modern tbody tr:hover { transform: translateY(-1px); }
    .table-modern tbody td { padding: 16px 18px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: 0.95rem !important; }
    .btn-rounded { border-radius: 30px !important; }
    .badge-sekdes{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;font-weight:600;padding:5px 12px;border-radius:20px;font-size:.78rem}
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
                <h4 class="fw-bold text-dark m-0" style="font-size: 1.1rem;">Pengajuan Menunggu Pengesahan (Disetujui Sekretaris Desa)</h4>
                <form class="d-flex" action="{{ route('kades.suratmasuk.index') }}" method="get">
                    <input class="form-control me-2 rounded-pill px-3" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari NIK / Nama / Surat" style="font-size:0.9rem;">
                    <button class="btn btn-primary btn-rounded px-4 fw-semibold">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableSuratMasukKades">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Nama Pemohon</th>
                                <th class="text-center">Jenis Surat</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 270px;">Aksi TTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $row)
                            <tr>
                                <td class="text-center fw-bold text-muted" style="font-size:0.95rem;">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold text-dark mb-1" style="font-size: 0.98rem;">
                                        {{ $row->nama_lengkap ?? 'Warga' }}
                                    </div>
                                    <div>
                                        <code class="px-2.5 py-1 text-primary border rounded-3 fw-bold" style="background:#f0f7ff; border-color:#cce3fd !important; font-size:0.85rem;">{{ $row->nik }}</code>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge px-3 py-2 fw-semibold" style="background:#e0f2fe; color:#0369a1; border:1px solid #bae6fd; font-size:0.875rem; border-radius:10px;">
                                        <i class="bi bi-file-earmark-text me-1"></i>{{ $row->nama_surat ?? 'Surat Keterangan' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if(!empty($row->keterangan_admin))
                                        <span class="fw-bold text-dark d-inline-block text-truncate" style="max-width: 240px; font-size:0.92rem;" title="{{ $row->keterangan_admin }}">
                                            {{ $row->keterangan_admin }}
                                        </span>
                                    @else
                                        <span class="text-muted fw-medium">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge px-3 py-2 fw-bold" style="background:#dcfce7; color:#15803d; border:1px solid #bbf7d0; font-size:0.85rem; border-radius:30px;">
                                        <i class="bi bi-check-circle-fill me-1"></i>{{ $row->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info text-white rounded-3 px-3 py-2 me-1 fw-semibold shadow-sm" style="font-size:0.85rem;" data-bs-toggle="modal" data-bs-target="#modalDetailKades-{{ $row->id_pengajuan }}">
                                        <i class="bi bi-eye-fill me-1"></i>Detail
                                    </button>
                                    <button type="button" class="btn btn-sm btn-success text-white rounded-3 px-3 py-2 me-1 fw-bold shadow-sm" style="font-size:0.85rem;" data-bs-toggle="modal" data-bs-target="#modalSetujuKades-{{ $row->id_pengajuan }}">
                                        <i class="bi bi-pen-fill me-1"></i>Sahkan TTE
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-3 px-2.5 py-2 fw-semibold" style="font-size:0.85rem;" data-bs-toggle="modal" data-bs-target="#modalTolakKades-{{ $row->id_pengajuan }}">
                                        <i class="bi bi-x-lg me-1"></i>Tolak
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada pengajuan surat yang menunggu TTE Kepala Desa.</td>
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
@foreach($datapengajuan as $row)

{{-- MODAL DETAIL KADES --}}
<div class="modal fade" id="modalDetailKades-{{ $row->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" style="max-width: 960px !important; width: 95% !important;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header text-white py-3 px-4" style="background: linear-gradient(135deg, #0057A6 0%, #003B73 100%);">
                <h5 class="modal-title fw-bold d-flex align-items-center">
                    <i class="bi bi-file-earmark-text-fill me-2 fs-5"></i>
                    <span>Detail Pengajuan & Persetujuan — {{ $row->nama_surat }}</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-4">
                {{-- BARIS 1: Informasi Pemohon & Informasi Surat Sejajar --}}
                <div class="row g-3 mb-3">
                    {{-- Data Pemohon --}}
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white" style="border: 1px solid #e2e8f0 !important;">
                            <h6 class="fw-bold pb-2 mb-3 border-bottom d-flex align-items-center" style="color: #0057A6;">
                                <i class="bi bi-person-vcard-fill me-2 fs-5"></i>Data Pemohon
                            </h6>
                            <div class="mb-3">
                                <span class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Nama Lengkap Pemohon</span>
                                <strong class="text-dark fs-6 d-block">{{ $row->nama_lengkap }}</strong>
                            </div>
                            <div class="mb-3">
                                <span class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">NIK (Nomor Induk Kependudukan)</span>
                                <code class="px-2.5 py-1 bg-light text-primary border rounded-3 fw-bold d-inline-block" style="font-size: 0.9rem;">{{ $row->nik }}</code>
                            </div>
                            <div class="mb-0">
                                <span class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Alamat Domisili</span>
                                <span class="text-dark fw-medium d-block">{{ $row->alamat }} RT {{ $row->rt }} / RW {{ $row->rw }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Data Surat --}}
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white" style="border: 1px solid #e2e8f0 !important;">
                            <h6 class="fw-bold pb-2 mb-3 border-bottom d-flex align-items-center" style="color: #0057A6;">
                                <i class="bi bi-file-earmark-richtext-fill me-2 fs-5"></i>Data Surat
                            </h6>
                            <div class="mb-3">
                                <span class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Jenis Surat</span>
                                <div class="p-2 px-3 rounded-3 fw-bold text-wrap" style="background:#f0f9ff; color:#0369a1; border:1px solid #bae6fd; font-size:0.875rem; display:inline-block; max-width:100%; word-break:break-word;">
                                    <i class="bi bi-file-earmark-text me-1"></i>{{ $row->nama_surat }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <span class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Nomor Surat Keluar (Perkiraan)</span>
                                <div class="p-2 px-3 rounded-3 fw-bold text-wrap" style="background:#f0fdf4; color:#15803d; border:1px solid #bbf7d0; font-size:0.875rem; display:inline-block; max-width:100%; word-break:break-word;">
                                    <i class="bi bi-hash me-1"></i>{{ $row->nomor_surat_keluar ?? ($nomorSuratKeluarDefault . ' (Otomatis)') }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <span class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Keperluan</span>
                                <span class="text-dark fw-medium d-block">{{ $row->keperluan }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="text-muted d-block mb-1" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Tanggal Pengajuan</span>
                                <span class="fw-semibold text-dark d-block"><i class="bi bi-calendar-check text-primary me-1"></i>{{ $row->tanggal_diajukan ?? $row->created_at }}</span>
                            </div>
                            <div class="mb-0">
                                <span class="text-muted d-block mb-2" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Lampiran Foto Dokumen</span>
                                <div class="d-flex flex-wrap gap-1">
                                    @php $hasFoto = false; @endphp
                                    @for($f=1; $f<=8; $f++)
                                        @php $foto = 'foto'.$f; @endphp
                                        @if(!empty($row->$foto))
                                            @php $hasFoto = true; @endphp
                                            <a href="{{ asset($row->$foto) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-3 px-2 py-1" style="font-size:0.78rem;">
                                                <i class="bi bi-file-earmark-image me-1"></i>Foto {{ $f }}
                                            </a>
                                        @endif
                                    @endfor
                                    @if(!$hasFoto)
                                        <span class="text-muted small italic">Tidak ada lampiran foto.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- BARIS 2: Nomor Final Surat --}}
                    <div class="card border-0 shadow-sm rounded-3 p-3 mb-3">
                        <h6 class="fw-bold border-bottom pb-2 mb-3">
                            Nomor Final Surat
                        </h6>

<div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <span class="text-muted small d-block mb-1">
            Nomor Surat Keluar
        </span>
        <input
            type="text"
            id="nomor_surat_keluar"
            name="nomor_surat_keluar"
            class="form-control"
            value="{{ $row->nomor_surat_keluar ?? $nomorSuratKeluarDefault }}"
            readonly
        >
    </div>
</div>

                {{-- Keterangan Verifikasi Admin --}}
                <div class="card shadow-sm rounded-4 p-3 mb-3" style="background:#fffbebf5; border: 1px solid #fef08a; border-left: 5px solid #eab308;">
                    <h6 class="fw-bold text-dark mb-1 d-flex align-items-center">
                        <i class="bi bi-chat-quote-fill me-2 text-warning fs-5"></i>Catatan Verifikasi Admin
                    </h6>
                    <p class="mb-0 text-dark fw-medium small" style="margin-left: 28px;">
                        {{ $row->keterangan_admin ?? 'Berkas telah diverifikasi lengkap oleh Admin Desa.' }}
                    </p>
                </div>

                {{-- Riwayat Persetujuan Berantai --}}
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" style="border: 1px solid #e2e8f0 !important;">
                    <h6 class="fw-bold pb-2 mb-3 border-bottom d-flex align-items-center" style="color: #0057A6;">
                        <i class="bi bi-clock-history me-2 fs-5"></i>Riwayat Persetujuan Berantai
                    </h6>
                    <div class="position-relative ms-2" style="padding-left:28px; border-left:2px solid #cbd5e1;">
                        {{-- 1. Diajukan --}}
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-primary d-flex align-items-center justify-content-center shadow-sm" style="width:24px;height:24px;left:-41px;top:2px;">
                                <i class="bi bi-check-lg text-white" style="font-size:.75rem"></i>
                            </div>
                            <span class="fw-bold text-dark d-block mb-0">1. Diajukan oleh Warga</span>
                            <small class="text-muted"><i class="bi bi-calendar-event me-1"></i>{{ $row->tanggal_diajukan ?? $row->created_at }}</small>
                        </div>
                        {{-- 2. Disetujui Dusun --}}
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-info d-flex align-items-center justify-content-center shadow-sm" style="width:24px;height:24px;left:-41px;top:2px;">
                                <i class="bi bi-check-lg text-white" style="font-size:.75rem"></i>
                            </div>
                            <span class="fw-bold text-dark d-block mb-0">2. Disetujui Kepala Dusun</span>
                            <small class="text-muted"><i class="bi bi-check2-circle text-info me-1"></i>Berkas telah diverifikasi Kepala Dusun</small>
                        </div>
                        {{-- 3. Disetujui Admin --}}
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-success d-flex align-items-center justify-content-center shadow-sm" style="width:24px;height:24px;left:-41px;top:2px;">
                                <i class="bi bi-check-lg text-white" style="font-size:.75rem"></i>
                            </div>
                            <span class="fw-bold text-dark d-block mb-0">3. Disetujui & Diverifikasi Admin Desa</span>
                            <small class="text-muted"><i class="bi bi-chat-left-text me-1"></i>{{ $row->keterangan_admin ?? 'Verifikasi sesuai' }}</small>
                        </div>
                        {{-- 4. Disetujui Sekdes --}}
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-primary d-flex align-items-center justify-content-center shadow-sm" style="width:24px;height:24px;left:-41px;top:2px;">
                                <i class="bi bi-check-lg text-white" style="font-size:.75rem"></i>
                            </div>
                            <span class="fw-bold text-dark d-block mb-0">4. Disetujui Sekretaris Desa</span>
                            <small class="text-muted"><i class="bi bi-send me-1"></i>Diteruskan ke Kepala Desa untuk TTE</small>
                        </div>
                        {{-- 5. Pengesahan TTE Kades --}}
                        <div class="mb-1 position-relative">
                            <div class="position-absolute rounded-circle bg-warning d-flex align-items-center justify-content-center shadow-sm" style="width:24px;height:24px;left:-41px;top:2px;">
                                <i class="bi bi-hourglass-split text-white" style="font-size:.75rem"></i>
                            </div>
                            <span class="fw-bold text-warning-emphasis d-block mb-0">5. Pengesahan TTE Kepala Desa</span>
                            <small class="text-warning-emphasis fw-medium"><i class="bi bi-exclamation-circle me-1"></i>Menunggu pengesahan & tanda tangan digital Anda</small>
                        </div>
                    </div>

                {{-- BARIS 3: Lampiran Dokumen di Bawah --}}
                <div class="card border-0 shadow-sm rounded-3 p-3">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">
                        <i class="bi bi-paperclip me-2"></i>Lampiran Dokumen
                    </h6>
                    
                    <div class="row g-3">
                        @php $hasAttachment = false; @endphp
                        @for($f=1; $f<=8; $f++)
                            @php $foto = 'foto'.$f; @endphp
                            @if(!empty($row->$foto))
                                @php 
                                    $hasAttachment = true; 
                                    $filePath = public_path($row->$foto);
                                    $fileName = basename($row->$foto);
                                    $fileSize = file_exists($filePath) ? round(filesize($filePath) / 1024, 1) . ' KB' : null;
                                @endphp
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="card border rounded-3 overflow-hidden shadow-sm">
                                        <!-- Thumbnail 16:9 -->
                                        <div class="ratio ratio-16x9 bg-light border-bottom position-relative" style="aspect-ratio: 16/9;">
                                            <img src="{{ asset($row->$foto) }}" 
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
                                            <a href="{{ asset($row->$foto) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 py-1" style="font-size: 0.8rem;">
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
            <div class="modal-footer bg-white py-3 px-4 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalTolakKades-{{ $row->id_pengajuan }}">
                    <i class="bi bi-x-circle-fill me-1"></i>Tolak
                </button>
                <button type="button" class="btn btn-success btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalSetujuKades-{{ $row->id_pengajuan }}">
                    <i class="bi bi-pen-fill me-1"></i>Sahkan TTE Sekarang
                </button>
            </div>
        </div>
    </div>
</div>  

{{-- MODAL PENGESAHAN TTE & INPUT NOMOR SURAT KELUAR --}}
<div class="modal fade" id="modalSetujuKades-{{ $row->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form action="{{ route('kades.suratmasuk.setuju', $row->id_pengajuan) }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white py-3 px-4">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-pen-fill me-2"></i>Pengesahan TTE Kepala Desa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" style="background: #f8fafc;">
                    <div class="card border-0 shadow-sm rounded-3 p-3 mb-3 bg-white">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-file-earmark-text text-success fs-3 me-3"></i>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">{{ $row->nama_surat }}</h6>
                                <div class="text-muted small">Pemohon: <strong>{{ $row->nama_lengkap }}</strong> (<code>{{ $row->nik }}</code>)</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_surat_keluar-{{ $row->id_pengajuan }}" class="form-label fw-bold text-dark mb-1">
                            Nomor Surat Keluar <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted">
                                <i class="bi bi-hash"></i>
                            </span>
                            <input type="text" 
                                   id="nomor_surat_keluar-{{ $row->id_pengajuan }}"
                                   name="nomor_surat_keluar" 
                                   class="form-control border-start-0 ps-0 fw-semibold text-primary" 
                                   value="{{ $row->nomor_surat_keluar ?? $nomorSuratKeluarDefault }}" 
                                   required
                                   placeholder="Contoh: 511/1/35.09.13.2006/2026">
                        </div>
                        <small class="text-muted mt-2 d-block" style="font-size: 0.78rem;">
                            <i class="bi bi-info-circle me-1 text-info"></i>Nomor surat keluar telah di-generate otomatis. Anda dapat mengubah/menyesuaikannya jika diperlukan sebelum dokumen disahkan dengan TTE.
                        </small>
                    </div>
                </div>
                <div class="modal-footer bg-white py-3 px-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-rounded px-4">
                        <i class="bi bi-shield-check me-1"></i> Sahkan TTE Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODALS TOLAK --}}
<div class="modal fade" id="modalTolakKades{{ $row->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('kades.suratmasuk.tolak', $row->id_pengajuan) }}" method="POST">
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
                        <div class="mb-1"><span class="text-muted small d-block">Pemohon</span><strong>{{ $row->nama_lengkap }}</strong></div>
                        <div class="mb-1"><span class="text-muted small d-block">NIK</span><code style="font-size: 110%">{{ $row->nik }}</code></div>
                        <div><span class="text-muted small d-block mb-1">Jenis Surat</span><span class="badge bg-secondary">{{ $row->nama_surat }}</span></div>
                    </div>

                    <!-- Input Alasan Penolakan (Card dihapus agar tidak menambah ruang kosong) -->
                    <div class="mb-2">
                        <label for="keterangan_ditolak-{{ $row->id_pengajuan }}" class="fw-bold mb-1">
                            Alasan Penolakan <span class="text-danger">*</span>
                        </label>
                        <p class="text-muted small mb-2">Jelaskan alasan penolakan agar pemohon dapat mengetahuinya.</p>
                        <textarea class="form-control rounded-3" 
                                  id="keterangan_ditolak-{{ $row->id_pengajuan }}" 
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
@endforeach
@endsection
