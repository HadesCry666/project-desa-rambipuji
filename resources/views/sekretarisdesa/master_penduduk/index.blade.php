@extends('admin.layout.main')

@section('title', 'Master Penduduk Sekretaris Desa')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content {
        font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important;
    }
    .card-modern {
        border: 1px solid #e2e8f0;
        border-radius: 14px !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03) !important;
        background: #ffffff;
    }
    .table-modern {
        border-collapse: separate !important;
        border-spacing: 0 6px !important;
    }
    .table-modern thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        font-size: 0.75rem !important;
        letter-spacing: 0.6px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 14px 16px !important;
    }
    .table-modern tbody tr {
        background-color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        border-radius: 10px !important;
    }
    .table-modern tbody td {
        padding: 14px 16px !important;
        vertical-align: middle !important;
        border-top: 1px solid #f1f5f9 !important;
        font-size: 0.88rem !important;
    }
    .btn-rounded {
        border-radius: 30px !important;
    }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Data Anggota Keluarga - Sekretaris Desa</h1>
            <p class="text-muted small mb-0">Kelola biodata warga & anggota keluarga Desa Rambipuji.</p>
        </div>
        @if($no_kk)
        <div>
            <button type="button" class="btn btn-primary btn-rounded px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPenduduk">
                <i class="bi bi-person-plus-fill me-1"></i> Tambah Anggota Keluarga
            </button>
        </div>
        @endif
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($no_kk)
    <div class="alert alert-info d-flex align-items-center justify-content-between mb-3">
        <div>
            <i class="bi bi-people-fill me-2"></i>
            <strong>Menampilkan Anggota Keluarga untuk No. KK: {{ $no_kk }}</strong>
        </div>
        <a href="{{ route('sekdes.kartukeluarga.index') }}" class="btn btn-sm btn-outline-primary btn-rounded px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Kartu Keluarga
        </a>
    </div>
    @endif

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-people-fill text-primary me-2"></i>Tabel Anggota Keluarga</h4>
                <div class="d-flex gap-2">
                    <form class="d-flex" action="{{ route('sekdes.penduduk.index') }}" method="get">
                        @if($no_kk)
                            <input type="hidden" name="nokk" value="{{ $no_kk }}">
                        @endif
                        <input class="form-control me-2" type="search" name="katakunci"
                            value="{{ Request::get('katakunci') }}"
                            placeholder="Cari NIK / Nama">
                        <button class="btn btn-primary btn-rounded px-4">Cari</button>
                    </form>
                    @if(!$no_kk)
                    <button type="button" class="btn btn-primary btn-rounded px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPenduduk">
                        <i class="bi bi-person-plus-fill me-1"></i> Tambah Penduduk
                    </button>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tablePendudukSekdes">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>NO KK</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Status Keluarga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($master_penduduk as $index => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td><code>{{ $row->no_kk }}</code></td>
                                <td><span class="fw-bold text-primary"><code>{{ $row->nik }}</code></span></td>
                                <td class="fw-semibold text-dark">{{ $row->nama_lengkap }}</td>
                                <td>{{ $row->tanggal_lahir }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $row->status_keluarga }}</span></td>
                                <td class="text-center">
                                    <form action="{{ route('sekdes.penduduk.delete', $row->nik) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota keluarga ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-rounded px-3" title="Hapus Anggota">
                                            <i class="bi bi-trash-fill me-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada data anggota keluarga. Silakan klik tombol "Tambah Anggota Keluarga".</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $master_penduduk->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH ANGGOTA KELUARGA -->
<div class="modal fade" id="modalTambahPenduduk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-primary"><i class="bi bi-person-plus-fill me-2"></i>Tambah Anggota Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form action="{{ route('sekdes.penduduk.masuk') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Kartu Keluarga (KK)</label>
                            <input type="text" class="form-control rounded-3" name="no_kk" value="{{ $no_kk ?? old('no_kk') }}" {{ $no_kk ? 'readonly' : '' }} required placeholder="16 Digit No. KK">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" class="form-control rounded-3" name="nik" value="{{ old('nik') }}" pattern="\d{16}" placeholder="16 Digit NIK" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-3" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap Warga" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select class="form-select rounded-3" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki - Laki" {{ old('jenis_kelamin') == 'Laki - Laki' ? 'selected' : '' }}>Laki - Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" class="form-control rounded-3" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Kota / Kab Lahir" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" class="form-control rounded-3" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Agama</label>
                            <select class="form-select rounded-3" name="agama" required>
                                <option value="ISLAM" {{ old('agama') == 'ISLAM' ? 'selected' : '' }}>ISLAM</option>
                                <option value="KRISTEN" {{ old('agama') == 'KRISTEN' ? 'selected' : '' }}>KRISTEN</option>
                                <option value="KATHOLIK" {{ old('agama') == 'KATHOLIK' ? 'selected' : '' }}>KATHOLIK</option>
                                <option value="HINDU" {{ old('agama') == 'HINDU' ? 'selected' : '' }}>HINDU</option>
                                <option value="BUDHA" {{ old('agama') == 'BUDHA' ? 'selected' : '' }}>BUDHA</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pendidikan</label>
                            <select class="form-select rounded-3" name="pendidikan" required>
                                <option value="SLTA / SEDERAJAT">SLTA / SEDERAJAT</option>
                                <option value="TAMAT SD / SEDERAJAT">TAMAT SD / SEDERAJAT</option>
                                <option value="SLTP / SEDERAJAT">SLTP / SEDERAJAT</option>
                                <option value="DIPLOMA IV / STRATA I">DIPLOMA IV / STRATA I</option>
                                <option value="STRATA II">STRATA II</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pekerjaan</label>
                            <input type="text" class="form-control rounded-3" name="pekerjaan" value="{{ old('pekerjaan', 'WIRASWASTA') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Golongan Darah</label>
                            <select class="form-select rounded-3" name="golongan_darah" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O" selected>O</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Perkawinan</label>
                            <select class="form-select rounded-3" name="status_perkawinan" required>
                                <option value="BELUM KAWIN">BELUM KAWIN</option>
                                <option value="KAWIN">KAWIN</option>
                                <option value="CERAI HIDUP">CERAI HIDUP</option>
                                <option value="CERAI MATI">CERAI MATI</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Dalam Keluarga</label>
                            <select class="form-select rounded-3" name="status_keluarga" required>
                                <option value="ANAK">ANAK</option>
                                <option value="ISTRI">ISTRI</option>
                                <option value="SUAMI">SUAMI</option>
                                <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                                <option value="ORANG TUA">ORANG TUA</option>
                                <option value="FAMILI LAIN">FAMILI LAIN</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kewarganegaraan</label>
                            <select class="form-select rounded-3" name="kewarganegaraan" required>
                                <option value="WNI" selected>WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Ayah</label>
                            <input type="text" class="form-control rounded-3" name="nama_ayah" value="{{ old('nama_ayah', '-') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Ibu</label>
                            <input type="text" class="form-control rounded-3" name="nama_ibu" value="{{ old('nama_ibu', '-') }}" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-rounded px-4">Simpan Anggota Keluarga</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var modal = new bootstrap.Modal(document.getElementById('modalTambahPenduduk'));
        modal.show();
    });
</script>
@endif
@endpush
@endsection
