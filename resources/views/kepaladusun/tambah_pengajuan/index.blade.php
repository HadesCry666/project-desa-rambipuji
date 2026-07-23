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
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('kadus.suratmasuk.index') }}" class="btn btn-light btn-rounded px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <div>
            <h1 class="fw-bold text-dark mb-1">Tambah Pengajuan Surat</h1>
            <p class="text-muted small mb-0">Kepala Dusun dapat mengajukan surat untuk warga yang tidak dapat mengajukan sendiri.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card card-modern p-4">
                <h5 class="fw-bold text-primary mb-4"><i class="bi bi-pencil-square me-2"></i>Form Pengajuan Surat</h5>

                <form id="formTambahPengajuan">
                    {{-- Data Pemohon --}}
                    <div class="card bg-light border-0 rounded-3 p-3 mb-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-person-fill text-primary me-2"></i>Data Pemohon</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">NIK Pemohon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="inputNIK" name="nik" placeholder="Masukkan 16 digit NIK" maxlength="16" required>
                                    <button class="btn btn-outline-primary rounded-end" type="button" id="btnCariNIK"><i class="bi bi-search me-1"></i>Cari</button>
                                </div>
                                <div class="form-text text-muted">Cari warga berdasarkan NIK.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="inputNama" name="nama_lengkap" placeholder="Otomatis terisi setelah cari NIK" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat Tempat Tinggal</label>
                                <input type="text" class="form-control" id="inputAlamat" name="alamat" placeholder="Otomatis terisi setelah cari NIK" readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Data Surat --}}
                    <div class="card bg-light border-0 rounded-3 p-3 mb-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-file-earmark-richtext-fill text-primary me-2"></i>Data Surat</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                <select class="form-select" name="id_surat" required>
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    <option value="1">Surat Keterangan Domisili</option>
                                    <option value="2">Surat Keterangan Tidak Mampu (SKTM)</option>
                                    <option value="3">Surat Keterangan Usaha (SKU)</option>
                                    <option value="4">Surat Keterangan Belum Menikah</option>
                                    <option value="5">Surat Keterangan Kelahiran</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pengajuan</label>
                                <input type="date" class="form-control" name="tanggal_diajukan" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Keperluan Surat <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="keperluan" rows="3" placeholder="Jelaskan keperluan pengajuan surat ini..." required></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Lampiran --}}
                    <div class="card bg-light border-0 rounded-3 p-3 mb-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-paperclip text-primary me-2"></i>Lampiran Berkas</h6>
                        <div class="mb-2">
                            <label class="form-label">Upload Berkas Pendukung <span class="text-muted fw-normal">(Maks. 9 file, format JPG/PNG/PDF)</span></label>
                            <input type="file" class="form-control" name="foto[]" multiple accept="image/*,.pdf">
                            <div class="form-text text-muted">Contoh: scan KTP, Kartu Keluarga, bukti pendukung lainnya.</div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('kadus.suratmasuk.index') }}" class="btn btn-secondary btn-rounded px-4">Batal</a>
                        <button type="submit" class="btn btn-primary btn-rounded px-5">
                            <i class="bi bi-send-fill me-1"></i> Ajukan Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    // Simulasi cari NIK
    $('#btnCariNIK').on('click', function () {
        const nik = $('#inputNIK').val();
        if (nik.length === 16) {
            $('#inputNama').val('Budi Santoso');
            $('#inputAlamat').val('Dsn. Krajan RT 002 / RW 005, Rambipuji, Jember');
        } else {
            Swal.fire({ title: 'NIK Tidak Valid', text: 'Pastikan NIK terdiri dari 16 digit angka.', icon: 'warning', confirmButtonColor: '#0057A6', customClass: { popup: 'rounded-4' } });
        }
    });

    $('#formTambahPengajuan').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({ title: 'Pengajuan Berhasil!', text: 'Surat telah diajukan dan masuk ke antrian Kepala Dusun.', icon: 'success', confirmButtonColor: '#16a34a', customClass: { popup: 'rounded-4' }
        }).then(() => { window.location.href = '{{ route("kadus.suratmasuk.index") }}'; });
    });
});
</script>
@endpush
