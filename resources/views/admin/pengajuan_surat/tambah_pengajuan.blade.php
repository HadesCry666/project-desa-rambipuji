@extends('admin.layout.main')
@section('title', 'Tambah Pengajuan Surat')
@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body,.main-content{font-family:'Poppins','Plus Jakarta Sans',sans-serif!important}
.card-modern{border:1px solid #e2e8f0;border-radius:15px;box-shadow:0 4px 16px rgba(0,0,0,.03);background:#fff}
.btn-rounded{border-radius:30px!important}
.form-control,.form-select{border-radius:10px!important;border-color:#e2e8f0!important;font-size:.9rem!important}
.form-control:focus,.form-select:focus{border-color:#0057A6!important;box-shadow:0 0 0 3px rgba(0,87,166,.12)!important}
.form-label{font-weight:600;font-size:.85rem;color:#374151}
.step-badge{display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;background:#0057A6;color:#fff;border-radius:50%;font-size:.8rem;font-weight:700;flex-shrink:0}
.info-readonly{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:.88rem;color:#374151;min-height:38px}
</style>
@endpush
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1 class="mb-0 text-primary fw-bold">{{-- <i class="fas fa-paper-plane me-2"></i> --}}Tambah Pengajuan Surat</h1>
            <p class="text-muted small mb-0 mt-1">Buat pengajuan surat baru secara langsung atas nama warga/penduduk desa.</p>
        </div>
        
    </div>

    @if(session('success'))
    <div id="alertPopup" class="alert alert-success alert-floating">
        {{ session('success') }}
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
            <div class="col-12">
                <form action="{{ route('pengajuan.tambah.store') }}" method="POST" enctype="multipart/form-data" id="formTambahPengajuan">
                    @csrf
                    <div class="mb-3">
                            <div class="alert alert-info border-0 shadow-sm rounded-4 p-3 d-flex align-items-center mb-0">
                                <i class="bi bi-info-circle-fill fa-3x" style="margin-right: 13px"></i>
                                <div>
                                    <div>
                                            <strong class="text-dark">Alur Tanda Tangan Fisik (Basah) RT/RW & Kepala Dusun:</strong>
                                            <p class="mb-0 small">Ketua RT & Ketua RW telah menandatangani berkas secara fisik (basah). Pengajuan ini otomatis berstatus <strong>Disetujui Admin</strong></p>
                                        </div>
                                </div>
                            </div>
                        </div>

                    <!-- STEP 1: Data Penduduk & Jenis Surat -->
                        <div class="card card-modern p-4 mb-4">

                            <h5 class="fw-bold text-primary mb-4">
                                <span class="step-badge me-2">1</span>
                                Data Penduduk & Jenis Surat
                            </h5>

                            <div class="row g-3">

                                {{-- NIK / NAMA PENDUDUK --}}
                                <div class="col-md-8">
                                    <label class="form-label">
                                        <i class="fas fa-id-card text-primary me-1"></i>
                                        NIK & Nama Penduduk
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select
                                        class="form-control select2 w-100"
                                        name="nik"
                                        id="nik"
                                        required
                                    >
                                        <option value="">
                                            -- Pilih NIK / Nama Penduduk --
                                        </option>

                                        @foreach($datapenduduk as $p)
                                            <option
                                                value="{{ $p->nik }}"
                                                {{ old('nik') == $p->nik ? 'selected' : '' }}
                                            >
                                                {{ $p->nik }} - {{ $p->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Ketik NIK atau Nama warga untuk memfilter secara otomatis.
                                    </small>
                                </div>


                                {{-- JENIS SURAT --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark mb-2">
                                        <i class="fas fa-file-alt text-primary me-1"></i>
                                        Jenis Surat
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select
                                        class="form-control select2"
                                        id="id_surat"
                                        name="id_surat"
                                        required
                                    >
                                        <option value="">
                                            -- Pilih Jenis Surat --
                                        </option>

                                        @foreach($datasurat as $s)
                                            <option
                                                value="{{ $s->id_surat }}"
                                                {{ old('id_surat') == $s->id_surat ? 'selected' : '' }}
                                            >
                                                {{ $s->nama_surat }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Pilih jenis surat permohonan yang diajukan.
                                    </small>
                                </div>

                            </div>
                        </div>


                        <!-- STEP 2: Detail Pengajuan -->
                        <div class="card card-modern p-4 mb-4">

                            <h5 class="fw-bold text-primary mb-4">
                                <span class="step-badge me-2">2</span>
                                Detail Pengajuan
                            </h5>

                            <div class="row g-3">

                                {{-- NOMOR REGISTRASI --}}
                                <div class="col-12">

                                    <label class="form-label fw-bold text-dark">
                                        <i class="fas fa-bookmark text-primary me-1"></i>
                                        Nomor Registrasi Kepala Dusun
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control rounded-3"
                                        id="no_registrasi"
                                        name="no_registrasi"
                                        value="{{ $noRegistrasi }}"
                                        readonly
                                    >

                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Nomor registrasi akan dibuat otomatis berdasarkan
                                        nomor urut, dusun, bulan, dan tahun.
                                    </small>

                                </div>


                                {{-- KEPERLUAN --}}
                                <div class="col-12 mt-3">

                                    <label
                                        for="keperluan"
                                        id="labelKeperluan"
                                        class="form-label fw-semibold"
                                    >
                                        Keperluan
                                    </label>

                                    <textarea
                                        name="keperluan"
                                        id="keperluan"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Masukkan keperluan surat"
                                    >{{ old('keperluan') }}</textarea>

                                    <small class="text-muted mt-1 d-block">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Isi keterangan atau keperluan pengajuan surat.
                                    </small>

                                </div>

                            </div>
                        </div>


                        <!-- STEP 3: Lampiran -->
                        <div class="card card-modern p-4 mb-4">

                            <h5 class="fw-bold text-primary mb-4">
                                <span class="step-badge me-2">3</span>
                                Lampiran Berkas / Dokumen Pendukung
                            </h5>

                            <div class="row g-3">

                                <div class="col-12">

                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-paperclip text-primary me-1"></i>
                                        Upload Berkas Pendukung

                                        <span class="text-muted fw-normal">
                                            (Opsional, maks. 8 file, JPG/PNG, max 2MB/file)
                                        </span>
                                    </label>


                                    {{-- INPUT FILE --}}
                                    <input
                                        type="file"
                                        class="form-control"
                                        name="foto[]"
                                        id="inputFoto"
                                        multiple
                                        accept=".jpg,.jpeg,.png"
                                    >


                                    <div class="form-text text-muted mt-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Anda dapat memilih beberapa file sekaligus.
                                        Contoh: Foto KTP, KK, Surat Pengantar RT/RW, dsb.
                                    </div>


                                    {{-- PREVIEW --}}
                                    <div
                                        id="previewContainer"
                                        class="row mt-3 g-3"
                                    ></div>

                                </div>

                            </div>
                        </div>

                        {{-- FOOTER ACTION --}}
                        <div class="card-footer py-3 px-4 border-top d-flex justify-content-between align-items-center">
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
.select2-container {
    width: 100% !important;
}

.select2-container--default .select2-selection--single {
    height: 52px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 12px !important;
    background: #fff !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 50px !important;
    padding-left: 16px !important;
    color: #6b7280 !important;
    font-size: 15px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 50px !important;
    right: 12px !important;
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
    const inputFoto = document.getElementById('inputFoto');
        const previewContainer = document.getElementById('previewContainer');

        let selectedFiles = [];

        // ===============================
        // PILIH FILE
        // ===============================
        inputFoto.addEventListener('change', function () {

            const newFiles = Array.from(this.files);

            newFiles.forEach(file => {

                // Cek file duplikat
                const alreadyExists = selectedFiles.some(existingFile =>
                    existingFile.name === file.name &&
                    existingFile.size === file.size &&
                    existingFile.lastModified === file.lastModified
                );

                // Maksimal 8 file
                if (!alreadyExists && selectedFiles.length < 8) {
                    selectedFiles.push(file);
                }

            });

            // Update input file
            updateFileInput();

            // Tampilkan preview
            renderPreview();
        });


        // ===============================
        // UPDATE INPUT FILE
        // ===============================
        function updateFileInput() {

            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            inputFoto.files = dataTransfer.files;
        }


        // ===============================
        // PREVIEW
        // ===============================
        function renderPreview() {

            previewContainer.innerHTML = '';

            selectedFiles.forEach((file, index) => {

                const reader = new FileReader();

                reader.onload = function (e) {

                    const col = document.createElement('div');

                    col.className = 'col-6 col-sm-4 col-md-3';

                    col.innerHTML = `
                        <div class="preview-card position-relative">

                            <span class="badge-index">
                                Foto ${index + 1}
                            </span>

                            <button
                                type="button"
                                class="btn btn-danger btn-sm btn-remove-foto"
                                data-index="${index}"
                                style="
                                    position:absolute;
                                    top:6px;
                                    right:6px;
                                    width:28px;
                                    height:28px;
                                    padding:0;
                                    border-radius:50%;
                                    z-index:10;
                                "
                                title="Hapus foto">

                                <i class="bi bi-x"></i>

                            </button>

                            <img
                                src="${e.target.result}"
                                alt="Preview Foto ${index + 1}"
                                class="img-fluid"
                            >

                            <div class="p-2 text-truncate small text-muted text-center bg-white border-top">
                                ${file.name}
                            </div>

                        </div>
                    `;

                    previewContainer.appendChild(col);
                };

                reader.readAsDataURL(file);
            });
        }


        // ===============================
        // HAPUS FOTO
        // ===============================
        previewContainer.addEventListener('click', function (e) {

            const button = e.target.closest('.btn-remove-foto');

            if (!button) {
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            const index = parseInt(button.dataset.index);

            // Hapus dari array
            selectedFiles.splice(index, 1);

            // Update input
            updateFileInput();

            // Render ulang preview
            renderPreview();
        });


        // ===============================
        // CEK SEBELUM SUBMIT
        // ===============================
        document.querySelector('form').addEventListener('submit', function () {

            // Pastikan input berisi semua file terakhir
            updateFileInput();

        });

$('#id_surat').on('change', function () {
    const namaSurat = $('#id_surat option:selected')
        .text()
        .trim()
        .toLowerCase();

    if (namaSurat.includes('surat keterangan kematian')) {
        $('#labelKeperluan').text('Nama Almarhum');
        $('#keperluan').attr('placeholder', 'Masukkan nama almarhum');
    } else {
        $('#labelKeperluan').text('Keperluan');
        $('#keperluan').attr('placeholder', 'Masukkan keperluan surat');
    }
});

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
});
// =====================================================

$('#nik').on('change', function () {
    console.log('================================');
    console.log('CHANGE NIK BERHASIL');
    console.log('NIK:', $(this).val());
    console.log('================================');

    const nik = $(this).val();

    console.log('NIK dipilih:', nik);

    if (!nik) {
        return;
    }

    let url = "{{ route('pengajuan.tambah.dusun', ':nik') }}";
    url = url.replace(':nik', encodeURIComponent(nik));

    console.log('URL AJAX:', url);

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',

        success: function (response) {

            console.log('Response:', response);

            if (!response.success) {
                return;
            }

            // Ambil nomor registrasi saat ini
            let noRegistrasi = $('#no_registrasi').val();

            console.log(
                'No Registrasi sebelum:',
                noRegistrasi
            );

            // Pecah nomor registrasi
            let parts = noRegistrasi.split('/');

            if (parts.length === 5) {

                parts[2] =
                    '2006.' + response.nomor_dusun;

                $('#no_registrasi').val(
                    parts.join('/')
                );

                console.log(
                    'No Registrasi sesudah:',
                    $('#no_registrasi').val()
                );

            } else {

                console.error(
                    'Format nomor registrasi tidak sesuai:',
                    noRegistrasi
                );
            }
        },

        error: function (xhr) {

            console.error(
                'AJAX ERROR:',
                xhr.status,
                xhr.responseText
            );

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text:
                    xhr.responseJSON?.message ??
                    'Data dusun tidak ditemukan.'
            });
        }
    });
});
</script>
@endpush

@endsection
