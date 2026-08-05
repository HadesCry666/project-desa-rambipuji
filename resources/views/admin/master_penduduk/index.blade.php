@extends('admin.layout.main')
@section('title', 'Master Penduduk')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- CSS Selectric -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-selectric/1.13.0/selectric.css" integrity="sha512-0qVbXztEFgh+qSrfFQaA/2z2P7sHqv6pouVbC+6p4rt5WjEM45ZUBQdqU30z4RhvYVq4Nnhq2vLQfYgOZyLxUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0,0,0,0.03) !important; background: #fff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 6px !important; }
    .table-modern thead th { background: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: .75rem !important; letter-spacing: .6px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 14px 16px !important; }
    .table-modern tbody tr { background: #fff !important; box-shadow: 0 2px 6px rgba(0,0,0,.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 14px 16px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: .88rem !important; }
    .btn-rounded { border-radius: 30px !important; }
    .action-group { display: flex; align-items: center; justify-content: center; gap: 5px; flex-wrap: wrap; }
</style>
@endpush

@section('content')

@php
    $no_kk = request('nokk');
@endphp

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Master Data Penduduk</h1>
            <p class="text-muted small mb-0">Kelola biodata seluruh warga & anggota keluarga Desa Rambipuji.</p>
        </div>
    </div>
   @if(session('success'))
    <div id="alertPopup" class="alert alert-success alert-floating">
        {{ session('success') }}
    </div>
    @endif

    @if($no_kk)
    <div class="alert alert-info d-flex align-items-center justify-content-between mb-3">
        <div>
            <i class="fas fa-users me-2"></i>
            <strong>Menampilkan anggota keluarga dengan No. KK: {{ $no_kk }}</strong>
        </div>
        <a href="{{ route('kartukeluarga.view') }}" class="btn btn-sm btn-outline-primary btn-rounded px-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Kartu Keluarga
        </a>
    </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card card-modern">

                    <!-- CARD HEADER -->
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex justify-content-between w-100 align-items-center gap-2">

                            <!-- Kiri: Pencarian -->
                            <form class="d-flex" action="{{ url('master_penduduk') }}" method="get">
                                <input class="form-control me-2 rounded-pill px-3" type="search" name="katakunci"
                                    value="{{ Request::get('katakunci') }}"
                                    placeholder="Cari NIK / Nama">
                                <button class="btn btn-primary btn-rounded px-4"><i class="bi bi-search me-1"></i> Cari</button>
                            </form>

                            <!-- Kanan: Tombol Tambah -->
                            <div>
                                <button type="button" class="btn btn-primary btn-rounded px-4" id="btnTambahPenduduk">
                                   <i class="bi bi-person-plus-fill me-1"></i> Tambah Data
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- TABEL ANGGOTA KELUARGA -->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-modern w-100" id="activityTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px;">No</th>
                                        <th>NO KK</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Status Keluarga</th>
                                        <th class="text-center" style="width:160px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($master_penduduk as $a)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                        <td><code>{{ $a->no_kk }}</code></td>
                                        <td><span class="fw-bold text-primary"><code>{{ $a->nik }}</code></span></td>
                                        <td class="fw-semibold text-dark">{{ $a->nama_lengkap }}</td>
                                        <td class="text-muted small">{{ $a->tanggal_lahir }}</td>
                                        <td><span class="badge bg-light text-dark border">{{ $a->status_keluarga }}</span></td>
                                        <td class="text-center">
                                            <div class="action-group">
                                                <!-- Tombol Edit -->
                                                <a href="#"
                                                   class="btn btn-warning btn-sm btn-rounded px-3 btn-edit"
                                                    data-nik="{{ $a->nik }}"
                                                    data-nama_lengkap="{{ $a->nama_lengkap }}"
                                                    data-tempat_lahir="{{ $a->tempat_lahir }}"
                                                    data-tanggal_lahir="{{ $a->tanggal_lahir }}"
                                                    data-jenis_kelamin="{{ $a->jenis_kelamin }}"
                                                    data-agama="{{ $a->agama }}"
                                                    data-pendidikan="{{ $a->pendidikan }}"
                                                    data-pekerjaan="{{ $a->pekerjaan }}"
                                                    data-golongan_darah="{{ $a->golongan_darah }}"
                                                    data-status_perkawinan="{{ $a->status_perkawinan }}"
                                                    data-status_keluarga="{{ $a->status_keluarga }}"
                                                    data-kewarganegaraan="{{ $a->kewarganegaraan }}">
                                                   <i class="fas fa-pencil-alt me-1"></i> Edit
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form id="formHapus{{ $a->nik }}" action="{{ route('penduduk.delete', $a->nik) }}"
                                                    method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm btn-rounded px-3 btndeletependuduk"
                                                        data-id="{{ $a->nik }}"
                                                        data-nama_lengkap="{{ $a->nama_lengkap }}">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="mt-3">
                            {{ $master_penduduk->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH / EDIT -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="anggotaForm" action="{{ url('admin/master_penduduk/masuk') }}" method="POST">
                @csrf
                <input type="hidden" name="no_kk" value="{{ $no_kk }}">
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Tambah Anggota Keluarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form Inputs -->
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                      <input type="tel"
       class="form-control @error('nik') is-invalid @enderror"
       name="nik"
       value="{{ old('nik') }}"
       pattern="[0-9]{16}"
       title="Masukkan 16 digit angka"
       required>

@error('nik')
    <small class="text-danger">{{ $message }}</small>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select id="jenis_kelamin" class="form-control selectric" name="jenis_kelamin" required>
                            <option value="" selected disabled> -- Pilih Kelamin -- </option>
                            <option>Laki - Laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>
                    </div>

                    <!-- Tambahkan semua select lainnya dengan class selectric -->
                    <div class="mb-3 row">
                        <div class="col">
                            <label class="form-label">Agama</label>
                            <select class="form-control selectric" name="agama" required>
                                <option value="" selected disabled> -- Pilih Agama -- </option>
                                <option>ISLAM</option>
                                <option>HINDU</option>
                                <option>KRISTEN</option>
                                <option>KATHOLIK</option>
                                <option>BUDHA</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Pendidikan</label>
                            <select class="form-control selectric" name="pendidikan" required>
                                <option value="" selected disabled> -- Pilih Pendidikan -- </option>
                                <option>TIDAK / BELUM SEKOLAH</option>
                                <option>BELUM TAMAT SD / SEDERAJAT</option>
                                <option>TAMAT SD / SEDERAJAT</option>
                                <option>SLTP / SEDERAJAT</option>
                                <option>SLTA / SEDERAJAT</option>
                                <option>Diploma I / II</option>
                                <option>AKADEMI / DIPLOMA III / S.MUDA</option>
                                <option>DIPLOMA IV / STRATA I</option>
                                <option>STRATA II</option>
                                <option>STRATA III</option>
                            </select>
                        </div>
                    </div>
                      <div class="mb-3">
                    <label class="form-label">Pekerjaan</label>
                    <input type="text" class="form-control" name="pekerjaan"  required>
                </div>


                <div class="mb-3 row">
                    <div class="col">
                        <label class="form-label">Golongan Darah</label>
                        <select id="golongan_darah" class="form-control selectric" name="golongan_darah">
                            <option value="" selected> -- Pilih Golongan Darah -- </option>
                            <option>A</option>
                            <option>B</option>
                            <option>AB</option>
                            <option>O</option>
                          </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Status Perkawinan</label>
                        <select id="status_perkawinan" class="form-control selectric" name="status_perkawinan"  required>
                            <option value="" selected disabled> -- Pilih Status -- </option>
                            <option value="BELUM KAWIN">BELUM KAWIN</option>
                            <option value="KAWIN">KAWIN</option>
                            <option value="CERAI HIDP">CERAI HIDUP</option>
                            <option value="CERAI MATI">CERAI MATI</option>
                          </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label class="form-label">Status Keluarga</label>
                        <select id="status_keluarga" class="form-control selectric" name="status_keluarga"  required>
                            <option value="" selected disabled> -- Pilih Status -- </option>
                            <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                            <option>SUAMI</option>
                            <option>ISTRI</option>
                            <option>ANAK</option>
                            <option>MENANTU</option>
                            <option>ORANG TUA</option>
                            <option>MERTUA</option>
                            <option>PEMBANTU</option>
                            <option>FAMILI LAIN</option>
                          </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Kewarganegaraan</label>
                        <select id="kewarganegaraan" class="form-control selectric" name="kewarganegaraan"  required>
                            <option value="" selected disabled> -- Pilih Kewarganegaraan -- </option>
                            <option value="WNI" >WNI</option>
                            <option value="WNA" >WNA</option>
                          </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
@push('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi Selectric untuk semua dropdown
        if ($.fn.selectric) {
            $('.selectric').selectric();
        }
    });
</script>
<script src="{{ asset('js/penduduk.js') }}"></script>

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
        modal.show();
    });
</script>
@endif
@endpush

@endsection