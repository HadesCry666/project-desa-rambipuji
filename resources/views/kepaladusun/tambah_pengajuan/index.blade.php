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
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex align-items-center gap-3 mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Tambah Pengajuan Surat</h1>
            <p class="text-muted small mb-0">Kepala Dusun dapat mengajukan surat atas nama warga. Status otomatis: <strong class="text-success">Disetujui Kepala Dusun</strong>.</p>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
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
            <div class="col-12">

                {{-- LANGKAH 1: PILIH KARTU KELUARGA --}}
                <div class="card card-modern p-4 mb-4">
                    <h5 class="fw-bold text-primary mb-4"><span class="step-badge me-4" style="margin-right: 5px">1</span>Pilih Kartu Keluarga</h5>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Nomor KK <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="inputNoKK" placeholder="Masukkan atau cari Nomor KK..." maxlength="16">
                                 <button class="btn btn-primary" type="button" id="btnCariKK" style="border-radius:0 10px 10px 0!important">
                                    <i class="bi bi-search me-1"></i>Cari Anggota
                                </button>
                            </div>
                            <div class="form-text text-muted">Masukkan 16 digit Nomor Kartu Keluarga.</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kepala Keluarga</label>
                            <div class="info-readonly" id="infoKepalaKeluarga">—</div>
                        </div>
                    </div>

                    {{-- Daftar Anggota Keluarga --}}
                    <div id="wrapperAnggota" class="mt-4" style="display:none">
                        <label class="form-label fw-bold">Pilih Anggota Keluarga <span class="text-danger">*</span></label>
                        <div class="row g-2" id="listAnggota"></div>
                        <input type="hidden" name="nik" id="hiddenNIK" required>
                    </div>
                </div>

                {{-- LANGKAH 2: DATA PEMOHON (Auto-fill) --}}
                <div class="card card-modern p-4 mb-4" id="wrapperDataPemohon" style="display:none">
                    <h5 class="fw-bold text-primary mb-4"><span class="step-badge me-2" style="margin-right: 5px">2</span>Data Pemohon</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIK</label>
                            <div class="info-readonly" id="showNIK">—</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="info-readonly" id="showNama">—</div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">No. KK</label>
                            <div class="info-readonly" id="showNoKK">—</div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Status dalam Keluarga</label>
                            <div class="info-readonly" id="showStatus">—</div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Alamat</label>
                            <div class="info-readonly" id="showAlamat">—</div>
                        </div>
                    </div>
                </div>

                {{-- LANGKAH 3: DATA SURAT --}}
                <div class="card card-modern p-4 mb-4" id="wrapperDataSurat" style="display:none">
                    <h5 class="fw-bold text-primary mb-4"><span class="step-badge me-2" style="margin-right: 5px">3</span>Data Surat</h5>
                    <div class="row g-3">
                      <div class="col-md-6">
                            <label for="id_surat" class="form-label d-block mb-2">
                                Jenis Surat <span class="text-danger">*</span>
                            </label>

                            <select id="id_surat" class="form-control selectric" name="id_surat" required>
                                <option value="">— Pilih Jenis Surat —</option>
                                @foreach($datasurat as $s)
                                    <option value="{{ $s->id_surat }}">{{ $s->nama_surat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pengajuan</label>
                            <input type="text" class="form-control" value="{{ date('d F Y') }}" readonly>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Keperluan / Tujuan Surat <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="keperluan" rows="3" placeholder="Jelaskan keperluan surat ini..." required></textarea>
                        </div>
                    </div>
                </div>

                {{-- LANGKAH 4: LAMPIRAN --}}
                <div class="card card-modern p-4 mb-4" id="wrapperLampiran" style="display:none">
                    <h5 class="fw-bold text-primary mb-4"><span class="step-badge me-2" style="margin-right: 5px">4</span>Lampiran Berkas</h5>
                    <div class="mb-2">
                        <label class="form-label">Upload Berkas Pendukung <span class="text-muted fw-normal">(Opsional, maks. 9 file, JPG/PNG, max 5MB/file)</span></label>
                        <input type="file" class="form-control" name="foto[]" id="inputFoto" multiple accept="image/jpg,image/jpeg,image/png">
                        <div class="form-text text-muted">Contoh: KTP, Kartu Keluarga, surat pendukung lainnya.</div>
                    </div>
                    <div id="previewFoto" class="d-flex flex-wrap gap-2 mt-2"></div>
                </div>

                {{-- TOMBOL SUBMIT --}}
                <div class="d-flex justify-content-end gap-2" id="wrapperSubmit" style="display:none!important">
                    <a href="{{ route('kadus.suratmasuk.index') }}" class="btn btn-secondary btn-rounded px-4">Batal</a>
                    <button type="submit" class="btn btn-success btn-rounded px-5" id="btnSubmit">
                        <i class="bi bi-send-fill me-1"></i> Ajukan Surat
                    </button>
                </div>

            </div>
        </div>
    </form>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    const baseUrl = '{{ url("") }}';

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
                    // Reset
                    $('#listAnggota').empty();
                    $('#hiddenNIK').val('');
                    $('#wrapperDataPemohon').hide();
                    $('#wrapperDataSurat').hide();
                    $('#wrapperLampiran').hide();
                    $('#wrapperSubmit').css('display', 'none');

                    // Tampilkan kepala keluarga (anggota pertama dengan status KK)
                    const kk = res.data.find(a => a.status_keluarga && a.status_keluarga.toUpperCase().includes('KEPALA'));
                    $('#infoKepalaKeluarga').text(kk ? kk.nama_lengkap : (res.data[0].nama_lengkap || 'KK ditemukan'));

                    // Tampilkan daftar anggota
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

    // Pilih anggota keluarga
    $(document).on('click', '.member-card', function () {
        $('.member-card').removeClass('selected');
        $(this).addClass('selected');
        const nik = $(this).data('nik');

        // Ambil detail data penduduk
        $.ajax({
            url: baseUrl + '/kepaladusun/get-penduduk-by-nik?nik=' + nik,
            method: 'GET',
            success: function (res) {
                if (res.status === 'success') {
                    $('#hiddenNIK').val(res.nik);
                    $('#showNIK').text(res.nik);
                    $('#showNama').text(res.nama_lengkap);
                    $('#showNoKK').text(res.no_kk);
                    $('#showStatus').text(res.status_keluarga || '-');
                    $('#showAlamat').text(res.alamat + ' RT ' + res.rt + ' / RW ' + res.rw);

                    $('#wrapperDataPemohon').show();
                    $('#wrapperDataSurat').show();
                    $('#wrapperLampiran').show();
                    $('#wrapperSubmit').css('display', 'flex');
                }
            },
            error: function () {
                alert('Gagal mengambil data penduduk.');
            }
        });
    });

    // Preview foto
    $('#inputFoto').on('change', function () {
        $('#previewFoto').empty();
        const files = this.files;
        const max = Math.min(files.length, 9);
        for (let i = 0; i < max; i++) {
            const url = URL.createObjectURL(files[i]);
            $('#previewFoto').append(`
                <div class="position-relative" style="width:80px;height:80px;">
                    <img src="${url}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                </div>`);
        }
    });

    // Enter key untuk cari KK
    $('#inputNoKK').on('keypress', function (e) {
        if (e.which === 13) { e.preventDefault(); $('#btnCariKK').click(); }
    });
});
</script>
@endpush
