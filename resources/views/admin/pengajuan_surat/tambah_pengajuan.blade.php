@extends('admin.layout.main')
@section('title', 'Tambah Pengajuan Surat')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1 class="mb-0 text-primary fw-bold">{{-- <i class="fas fa-paper-plane me-2"></i> --}}Tambah Pengajuan Surat</h1>
            <p class="text-muted mb-0 mt-1" style="font-size: 13.5px;">Buat pengajuan surat baru secara langsung atas nama warga/penduduk desa.</p>
        </div>
        <div>
            <a href="{{ url('admin/suratmasuk') }}" class="btn btn-outline-secondary btn-sm px-3 shadow-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Surat Masuk
            </a>
        </div>
    </div>

    @if(session('success'))
    <div id="alertPopup" class="alert alert-success alert-floating shadow-lg border-0 rounded-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle fa-2x me-3 text-success"></i>
            <div>
                <h6 class="mb-0 fw-bold">Berhasil!</h6>
                <small>{{ session('success') }}</small>
            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-exclamation-triangle me-2 fa-lg"></i>
            <strong>Terdapat kesalahan dalam pengisian form:</strong>
        </div>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <form action="{{ route('pengajuan.tambah.store') }}" method="POST" enctype="multipart/form-data" id="formTambahPengajuan">
                    @csrf

                    <!-- STEP 1: Data Penduduk & Jenis Surat -->
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <span class="fw-bold text-dark fs-6 d-flex align-items-center">
                                <span class="badge bg-primary rounded-circle me-2 p-2" style="width:28px; height:28px; display:inline-flex; align-items:center; justify-content:center;">1</span>
                                Data Penduduk & Jenis Surat
                            </span>
                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">Langkah 1 dari 2</span>
                        </div>

                        <div class="card-body p-4">
                            <div class="row g-4">
                                {{-- NIK / NAMA PENDUDUK --}}
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold text-dark mb-2">
                                        <i class="fas fa-id-card text-primary me-1"></i> NIK & Nama Penduduk <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control select2 w-100" name="nik" id="selectNik" required style="width: 100% !important;">
                                        <option value="">-- Pilih NIK / Nama Penduduk --</option>
                                        @foreach($datapenduduk as $p)
                                            <option value="{{ $p->nik }}" {{ old('nik') == $p->nik ? 'selected' : '' }}>
                                                {{ $p->nik }} - {{ $p->nama_lengkap }} (RW {{ $p->rw ?? '-' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Ketik NIK atau Nama warga untuk memfilter secara otomatis.</small>
                                </div>

                                {{-- JENIS SURAT --}}
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold text-dark mb-2">
                                        <i class="fas fa-file-alt text-primary me-1"></i> Jenis Surat <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control select2 w-100" name="id_surat" id="selectSurat" required style="width: 100% !important;">
                                        <option value="">-- Pilih Jenis Surat --</option>
                                        @foreach($datasurat as $s)
                                            <option value="{{ $s->id_surat }}" {{ old('id_surat') == $s->id_surat ? 'selected' : '' }}>
                                                {{ $s->nama_surat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Pilih jenis surat permohonan yang diajukan.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 2: Detail Pengajuan & Lampiran -->
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <span class="fw-bold text-dark fs-6 d-flex align-items-center">
                                <span class="badge bg-primary rounded-circle me-2 p-2" style="width:28px; height:28px; display:inline-flex; align-items:center; justify-content:center;">2</span>
                                Detail Pengajuan & Lampiran
                            </span>
                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">Langkah 2 dari 2</span>
                        </div>

                        <div class="card-body p-4">
                            <div class="row g-4">
                                {{-- KEPERLUAN --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark mb-1">Keperluan Pengajuan</label>
                                    <textarea class="form-control rounded-3" name="keperluan" rows="3"
                                        placeholder="Contoh: Untuk persyaratan pembuatan SKCK di Polres Jember / Pengurusan Beasiswa">{{ old('keperluan') }}</textarea>
                                </div>

                                {{-- STATUS AWAL (RADIO CARD SELECTION) --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark mb-2">Status Awal Pengajuan <span class="text-danger">*</span></label>
                                    
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <div class="status-option-card p-3 rounded-4 border position-relative active-card" id="cardStatusRw">
                                                <div class="form-check d-flex align-items-start">
                                                    <input class="form-check-input mt-1 me-3" type="radio" name="status" id="statusRw" value="Disetujui RW" {{ old('status', 'Disetujui RW') == 'Disetujui RW' ? 'checked' : '' }}>
                                                    <div>
                                                        <label class="form-check-label fw-bold text-dark cursor-pointer" for="statusRw">
                                                            <i class="fas fa-check-double text-success me-1"></i> Disetujui RW (Langsung Siap Diproses)
                                                        </label>
                                                        <p class="text-muted mb-0 small mt-1">Pengajuan akan langsung masuk ke daftar <strong>Surat Masuk Admin</strong> untuk segera dicetak PDF-nya.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="status-option-card p-3 rounded-4 border position-relative" id="cardStatusRt">
                                                <div class="form-check d-flex align-items-start">
                                                    <input class="form-check-input mt-1 me-3" type="radio" name="status" id="statusRt" value="Menunggu RT" {{ old('status') == 'Menunggu RT' ? 'checked' : '' }}>
                                                    <div>
                                                        <label class="form-check-label fw-bold text-dark cursor-pointer" for="statusRt">
                                                            <i class="fas fa-clock text-warning me-1"></i> Menunggu RT (Alur Bertahap)
                                                        </label>
                                                        <p class="text-muted mb-0 small mt-1">Pengajuan harus disetujui bertahap oleh Ketua RT dan Ketua RW terlebih dahulu.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- UPLOAD FOTO BUKTI / LAMPIRAN (DRAG & DROP STYLE BOX) --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark mb-1">
                                        Lampiran / Dokumen Pendukung <span class="text-muted fw-normal">(Opsional, Maks. 8 Gambar)</span>
                                    </label>

                                    <div class="upload-dropzone p-4 rounded-4 border-2 border-dashed text-center position-relative bg-light">
                                        <input type="file" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer" name="foto[]" id="inputFoto" multiple accept="image/*" style="z-index: 10;">
                                        <div class="dropzone-content pointer-events-none">
                                            <div class="icon-circle bg-primary-subtle text-primary mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                                                <i class="fas fa-cloud-upload-alt fa-2x"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark mb-1">Klik atau seret file ke area ini untuk mengupload</h6>
                                            <p class="text-muted small mb-0">Format yang didukung: <strong>JPG, JPEG, PNG</strong> (Maksimal 2MB per file)</p>
                                        </div>
                                    </div>

                                    {{-- PREVIEW CONTAINER --}}
                                    <div id="previewContainer" class="row mt-3 g-3"></div>
                                </div>
                            </div>
                        </div>

                        {{-- FOOTER ACTION --}}
                        <div class="card-footer bg-light py-3 px-4 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ url('admin/suratmasuk') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm" id="btnSubmit">
                                <i class="fas fa-paper-plane me-2"></i> Simpan & Ajukan Surat
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
/* Floating Alert */
.alert-floating {
    position: fixed;
    top: 25px;
    right: -450px;
    z-index: 9999;
    min-width: 350px;
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.alert-floating.show {
    right: 25px;
}

/* Select2 Custom Fixes */
.select2-container {
    width: 100% !important;
    display: block !important;
}
.select2-container--default .select2-selection--single {
    height: 44px !important;
    border-radius: 10px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 6px 12px !important;
    background-color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 28px !important;
    color: #0f172a !important;
    font-weight: 500 !important;
    padding-left: 0 !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 42px !important;
    right: 10px !important;
}

/* Card Option Styling */
.status-option-card {
    transition: all 0.25s ease-in-out;
    background-color: #ffffff;
    cursor: pointer;
}
.status-option-card:hover {
    border-color: #0057A6 !important;
    background-color: #f8fafc;
}
.status-option-card.active-card {
    border-color: #0057A6 !important;
    background-color: #f0f7ff;
    box-shadow: 0 4px 12px rgba(0, 87, 166, 0.08);
}

/* Upload Dropzone Styling */
.border-dashed {
    border-style: dashed !important;
    border-color: #cbd5e1 !important;
}
.upload-dropzone {
    transition: all 0.25s ease;
}
.upload-dropzone:hover {
    border-color: #0057A6 !important;
    background-color: #f1f5f9 !important;
}
.cursor-pointer {
    cursor: pointer;
}

/* Preview Image Grid */
.preview-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    background: #fff;
}
.preview-card img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}
.preview-card .badge-index {
    position: absolute;
    top: 6px;
    left: 6px;
    background: rgba(0,0,0,0.65);
    color: #fff;
    font-size: 10px;
    padding: 3px 7px;
    border-radius: 20px;
}
</style>

@push('scripts')
<script>
$(document).ready(function () {
    // Initialize Select2 safely
    if ($.fn.select2) {
        $('.select2').select2({
            width: '100%',
            placeholder: '-- Pilih --'
        });
    }

    // Alert auto dismissal
    const alertBox = document.getElementById('alertPopup');
    if (alertBox) {
        setTimeout(() => alertBox.classList.add('show'), 100);
        setTimeout(() => alertBox.classList.remove('show'), 4000);
    }

    // Radio Card highlight sync
    const radRw = document.getElementById('statusRw');
    const radRt = document.getElementById('statusRt');
    const cardRw = document.getElementById('cardStatusRw');
    const cardRt = document.getElementById('cardStatusRt');

    function syncStatusCard() {
        if (radRw && radRt && cardRw && cardRt) {
            if (radRw.checked) {
                cardRw.classList.add('active-card');
                cardRt.classList.remove('active-card');
            } else {
                cardRt.classList.add('active-card');
                cardRw.classList.remove('active-card');
            }
        }
    }

    if (radRw && radRt) {
        radRw.addEventListener('change', syncStatusCard);
        radRt.addEventListener('change', syncStatusCard);
        cardRw.addEventListener('click', function() { radRw.checked = true; syncStatusCard(); });
        cardRt.addEventListener('click', function() { radRt.checked = true; syncStatusCard(); });
        syncStatusCard();
    }

    // Image Upload Live Preview
    const inputFoto = document.getElementById('inputFoto');
    const previewContainer = document.getElementById('previewContainer');

    if (inputFoto && previewContainer) {
        inputFoto.addEventListener('change', function () {
            previewContainer.innerHTML = '';
            if (this.files && this.files.length > 0) {
                const files = Array.from(this.files).slice(0, 8);
                files.forEach((file, idx) => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-sm-4 col-md-3';
                        col.innerHTML = `
                            <div class="preview-card">
                                <span class="badge-index">Foto ${idx + 1}</span>
                                <img src="${e.target.result}" alt="Preview Foto ${idx + 1}">
                                <div class="p-2 text-truncate small text-muted text-center bg-white border-top">${file.name}</div>
                            </div>
                        `;
                        previewContainer.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    }
});
</script>
@endpush

@endsection
