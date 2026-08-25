@extends('admin.layout.main')
@section('title', 'Tambah Pengajuan Surat — Kepala Dusun')

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
.member-card{border:1px solid #e2e8f0;border-radius:12px;padding:12px 16px;cursor:pointer;transition:all .15s;}
.member-card:hover,.member-card.selected{border-color:#0057A6!important;background:#eff6ff!important}
.info-readonly{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:.88rem;color:#374151;min-height:38px}

.select2-container { width: 100% !important; }
.select2-container--default .select2-selection--single {
    height: 48px !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px !important;
    background: #fff !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 46px !important;
    padding-left: 14px !important;
    color: #374151 !important;
    font-size: .9rem;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 46px !important;
    right: 10px !important;
}
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
    height: 110px;
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
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Tambah Pengajuan Surat — Kepala Dusun</h1>
            <p class="text-muted small mb-0">Ajukan surat permohonan atas nama warga. Status otomatis: <strong class="text-success">Disetujui Kepala Dusun</strong>.</p>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <form action="{{ route('kadus.tambahpengajuan.store') }}" method="POST" enctype="multipart/form-data" id="formPengajuanKadus">
        @csrf
        <div class="row justify-content-center">
                        <div class="col-12 mb-3">
                            <div class="alert alert-info border-0 shadow-sm rounded-4 p-3 d-flex align-items-center mb-0">
                                <i class="bi bi-info-circle-fill fa-3x" style="margin-right: 13px"></i>
                                <div>
                                    <strong class="text-dark">Alur Persetujuan Surat:</strong>
                                    <p class="mb-0 small">Pengajuan oleh Kepala Dusun akan otomatis berstatus <strong>Disetujui Kepala Dusun</strong>, lalu diteruskan ke <strong>Admin Desa</strong> > <strong>Sekretaris Desa</strong> > <strong>TTE Kepala Desa</strong>.</p>
                                </div>
                            </div>
                        </div>
            <div class="col-12">
                

                {{-- LANGKAH 1: DATA PEMOHON & JENIS SURAT --}}
                <div class="card card-modern p-4 mb-4">
                    <h5 class="fw-bold text-primary mb-4"><span class="step-badge me-2" style="margin-right: 8px;">1</span>Pilih Pemohon (Warga) & Jenis Surat</h5>
                    
                    {{-- Nav Tabs: Pilih langsung vs Cari via No. KK --}}
                    {{-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill px-4" id="tab-nik-tab" data-bs-toggle="pill" data-bs-target="#tab-nik" type="button" role="tab">
                                <i class="bi bi-person-badge me-1"></i> Pilih NIK / Nama Penduduk
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4" id="tab-kk-tab" data-bs-toggle="pill" data-bs-target="#tab-kk" type="button" role="tab">
                                <i class="bi bi-card-heading me-1"></i> Cari via No. KK
                            </button>
                        </li>
                    </ul> --}}

                    <div class="tab-content" id="pills-tabContent">
                        {{-- Tab 1: Select2 NIK Penduduk --}}
                        <div class="tab-pane fade show active" id="tab-nik" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <i class="fas fa-id-card text-primary me-1"></i>
                                    <label class="form-label">NIK / Nama Penduduk <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="selectNik" name="nik" required style="width: 100%;">
                                        <option value="">-- Pilih NIK / Nama Penduduk --</option>
                                        @foreach($datapenduduk as $p)
                                            <option value="{{ $p->nik }}" {{ old('nik') == $p->nik ? 'selected' : '' }}>
                                                {{ $p->nik }} - {{ $p->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text text-muted">Cari berdasarkan NIK atau Nama lengkap warga.</div>
                                </div>
                                <div class="col-md-4"><i class="fas fa-file-alt text-primary me-1"></i>
                                    <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="id_surat" name="id_surat" required style="width: 100%;">
                                        <option value="">-- Pilih Jenis Surat --</option>
                                        @foreach($datasurat as $s)
                                            <option value="{{ $s->id_surat }}" {{ old('id_surat') == $s->id_surat ? 'selected' : '' }}>
                                                {{ $s->nama_surat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Tab 2: Cari via No KK --}}
                        <div class="tab-pane fade" id="tab-kk" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Nomor KK (16 Digit)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="inputNoKK" placeholder="Masukkan 16 digit Nomor KK..." maxlength="16">
                                        <button class="btn btn-primary" type="button" id="btnCariKK">
                                            <i class="bi bi-search me-1"></i>Cari Anggota
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kepala Keluarga</label>
                                    <div class="info-readonly" id="infoKepalaKeluarga">—</div>
                                </div>
                            </div>

                            <div id="wrapperAnggota" class="mt-3" style="display:none">
                                <label class="form-label fw-bold">Pilih Anggota Keluarga yang Mengajukan <span class="text-danger">*</span></label>
                                <div class="row g-2" id="listAnggota"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- LANGKAH 2: DETAIL PENGAJUAN & INFORMASI REGISTRASI --}}
                <div class="card card-modern p-4 mb-4">
                    <h5 class="fw-bold text-primary mb-4"><span class="step-badge me-2" style="margin-right: 8px;">2</span>Detail Pengajuan Surat</h5>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <i class="fas fa-bookmark text-primary me-1"></i>
                            <label class="form-label">Nomor Registrasi Kepala Dusun <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_registrasi" value="{{ $noRegistrasi }}" readonly required >
                            <div class="form-text text-muted">Nomor registrasi akan dibuat otomatis oleh sistem saat pengajuan disimpan.</div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="keperluan" id="labelKeperluan" class="form-label fw-semibold">
                                Keperluan
                            </label>

                            <textarea name="keperluan"
                                    id="keperluan"
                                    class="form-control"
                                    placeholder="Masukkan keperluan surat"></textarea>
                        </div>
                        
                    </div>
                </div>

                {{-- LANGKAH 3: LAMPIRAN BERKAS --}}
                <div class="card card-modern p-4 mb-4">
                    <h5 class="fw-bold text-primary mb-4">
                        <span class="step-badge me-2" style="margin-right: 8px;">3</span>
                        Lampiran Berkas / Dokumen Pendukung
                    </h5>

                    <div class="mb-2">
                        <label class="form-label">
                            Upload Berkas Pendukung
                            <span class="text-muted fw-normal">
                                (Opsional, maks. 8 file, JPG/PNG, max 2MB/file)
                            </span>
                        </label>

                        <input
                            type="file"
                            class="form-control"
                            name="foto[]"
                            id="inputFoto"
                            multiple
                            accept=".jpg,.jpeg,.png"
                        >

                        <div class="form-text text-muted">
                            Anda dapat memilih beberapa file sekaligus.
                            Contoh: Foto KTP, KK, Surat Pengantar RT/RW, dsb.
                        </div>
                    </div>

                    <div id="previewContainer" class="row mt-3 g-3"></div>
                </div>

                {{-- TOMBOL SUBMIT --}}
                <div class="d-flex justify-content-end gap-2 mb-4">
                    <a href="{{ route('kadus.suratmasuk.index') }}" class="btn btn-secondary btn-rounded px-4">Batal</a>
                    <button type="submit" class="btn btn-success btn-rounded px-5 fw-bold shadow-sm" id="btnSubmit">
                        <i class="bi bi-send-fill me-1"></i> Simpan & Ajukan Surat
                    </button>
                </div>

            </div>
        </div>
    </form>
</section>
@endsection

@push('scripts')
<script>
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
    const baseUrl = '{{ url("") }}';

    // Inisialisasi Select2
    if ($.fn.select2) {
        $('.select2').select2({
            width: '100%',
            placeholder: '-- Pilih --'
        });
    }

    // Cari anggota keluarga berdasarkan No. KK
    $('#btnCariKK').on('click', function () {
        const noKK = $('#inputNoKK').val().trim();
        if (noKK.length !== 16 || isNaN(noKK)) {
            alert('Nomor KK harus terdiri dari 16 digit angka.');
            return;
        }

        $.ajax({
            url: baseUrl + '/kepaladusun/get-anggota-kk/' + noKK,
            method: 'GET',
            success: function (res) {
                if (res.status === 'success' && res.data.length > 0) {
                    $('#listAnggota').empty();
                    const kk = res.data.find(a => a.status_keluarga && a.status_keluarga.toUpperCase().includes('KEPALA'));
                    $('#infoKepalaKeluarga').text(kk ? kk.nama_lengkap : (res.data[0].nama_lengkap || 'KK ditemukan'));

                    res.data.forEach(function (anggota) {
                        const card = `
                            <div class="col-12 col-md-6">
                                <div class="member-card" data-nik="${anggota.nik}">
                                    <div class="fw-semibold text-dark">${anggota.nama_lengkap}</div>
                                    <div class="text-muted small">NIK: ${anggota.nik}</div>
                                    <div class="text-muted small">${anggota.status_keluarga || ''}</div>
                                </div>
                            </div>`;
                        $('#listAnggota').append(card);
                    });

                    $('#wrapperAnggota').show();
                } else {
                    alert('Nomor KK tidak ditemukan atau tidak ada anggota keluarga.');
                }
            },
            error: function () {
                alert('Nomor KK tidak ditemukan. Pastikan sudah terdaftar di data Kartu Keluarga.');
            }
        });
    });

    // Pilih anggota keluarga dari list KK
    $(document).on('click', '.member-card', function () {
        $('.member-card').removeClass('selected');
        $(this).addClass('selected');
        const nik = $(this).data('nik');

        if ($('#selectNik').find("option[value='" + nik + "']").length) {
            $('#selectNik').val(nik).trigger('change');
            $('#tab-nik-tab').tab('show');
        } else {
            let newOption = new Option(nik + ' - Anggota Terpilih', nik, true, true);
            $('#selectNik').append(newOption).trigger('change');
            $('#tab-nik-tab').tab('show');
        }
    });

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


        });
</script>
@endpush
