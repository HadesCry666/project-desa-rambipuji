@extends('admin.layout.main')
@section('title', 'Master Kartu Keluarga')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0,0,0,0.03) !important; background: #fff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 6px !important; }
    .table-modern thead th { background: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: .75rem !important; letter-spacing: .6px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 14px 16px !important; }
    .table-modern tbody tr { background: #fff !important; box-shadow: 0 2px 6px rgba(0,0,0,.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 14px 16px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: .88rem !important; }
    .btn-rounded { border-radius: 30px !important; }
    .action-group { display: flex; align-items: center; justify-content: center; gap: 4px; flex-wrap: nowrap; white-space: nowrap; }
    .btn-icon { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50% !important; padding: 0 !important; font-size: 0.8rem; }
    .dropdown-item:hover { background: #f1f5ff; }
</style>
@endpush

@section('content')

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Master Kartu Keluarga</h1>
            <p class="text-muted small mb-0">Kelola data Kartu Keluarga seluruh warga Desa Rambipuji.</p>
        </div>
    </div>
@if(session('success'))
    <div id="alertPopup" class="alert alert-success alert-floating">
        {{ session('success') }}
    </div>
@endif
    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card card-modern">

                    <!-- CARD HEADER -->
                    <div class="card-header bg-white py-3 border-bottom-0">
                      <div class="d-flex justify-content-between w-100 align-items-center">

                          <!-- KIRI : PENCARIAN -->
                          <form class="d-flex" action="{{ route('kartukeluarga.view') }}" method="get">
                              <input class="form-control me-2 rounded-pill px-3" type="search" name="katakunci"
                                  value="{{ Request::get('katakunci') }}"
                                  placeholder="Cari No KK / Nama Kepala Keluarga">
                              <button class="btn btn-primary btn-rounded px-4"><i class="bi bi-search me-1"></i> Cari</button>
                          </form>

                         <div class="d-flex align-items-center gap-3">
                                <form id="importForm"
                                    action="{{ route('kartukeluarga.import') }}"
                                    method="POST"
                                    class="me-2"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="file"
                                        id="file"
                                        name="file"
                                        accept=".xlsx,.xls"
                                        hidden>

                                    <button type="button"
                                            id="btnImport"
                                            class="btn btn-success">
                                        <i class="bi bi-file-earmark-excel-fill me-1"></i>
                                        Import Excel
                                    </button>
                                </form>

                                <button id="btnTambah"
                                        type="button"
                                        class="btn btn-primary btn-rounded px-4 ms-4">
                                    <i class="bi bi-plus-circle-fill me-1"></i>
                                    Tambah Data
                                </button>

                            </div>

                      </div>
                  </div>
                    <!-- CARD BODY -->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-modern w-100" id="activityTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px;">No</th>
                                        <th>No Kartu Keluarga</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>Alamat</th>
                                        <th class="text-center">RW</th>
                                        <th class="text-center">RT</th>
                                        <th class="text-center" style="width:130px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($master_kartukeluarga as $a)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                        <td><span class="fw-bold text-primary"><code>{{ $a->no_kk }}</code></span></td>
                                        <td class="fw-semibold text-dark">{{ $a->nama_lengkap }}</td>
                                        <td class="text-muted small">{{ $a->alamat }}</td>
                                        <td class="text-center"><span class="badge bg-light text-dark border">{{ $a->rw }}</span></td>
                                        <td class="text-center"><span class="badge bg-light text-dark border">{{ $a->rt }}</span></td>
                                        <td class="text-center">
                                            <div class="action-group">
                                                <!-- EDIT -->
                                                <button type="button"
                                                    class="btn btn-warning btn-icon btnEditKeluarga"
                                                    title="Edit Data KK"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-id="{{ $a->no_kk }}"
                                                    data-no_kk="{{ $a->no_kk }}"
                                                    data-nik="{{ $a->nik ?? '' }}"
                                                    data-nama_lengkap="{{ $a->nama_lengkap ?? '' }}"
                                                    data-alamat="{{ $a->alamat }}"
                                                    data-rt="{{ $a->rt }}"
                                                    data-rw="{{ $a->rw }}"
                                                    data-kode_pos="{{ $a->kode_pos }}"
                                                    data-desa="{{ $a->desa }}"
                                                    data-kecamatan="{{ $a->kecamatan }}"
                                                    data-kabupaten="{{ $a->kabupaten }}"
                                                    data-provinsi="{{ $a->provinsi }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>

                                                <!-- HAPUS -->
                                                <form id="formHapus{{ $a->no_kk }}" style="display:inline" action="{{ route('kartukeluarga.delete', $a->no_kk) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-danger btn-icon btnDeleteKeluarga"
                                                        title="Hapus KK"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-id="{{ $a->no_kk }}" data-nama_lengkap="{{ $a->nama_lengkap ?? 'ini' }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                                <!-- ANGGOTA KK -->
                                                <a href="{{ url('admin/master_penduduk?nokk=' . $a->no_kk) }}"
                                                   class="btn btn-info btn-icon"
                                                   title="Lihat Anggota KK"
                                                   data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fas fa-users"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- PAGINATION -->
                        <div class="mt-3">
                            {{ $master_kartukeluarga->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH/EDIT -->
<div class="modal fade" id="modalKeluarga" tabindex="-1" aria-labelledby="modalKeluargaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="keluargaForm" method="POST" action="{{ url('admin/master_kartukeluarga/masuk') }}">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title" id="modalKeluargaLabel">Tambah Data Kepala Keluarga</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

      <div class="modal-body">

    {{-- NOMOR KK --}}
    <div class="mb-3">
        <label class="form-label">Nomor KK</label>

        <input type="text"
               class="form-control @error('no_kk') is-invalid @enderror"
               id="no_kk"
               name="no_kk"
               value="{{ old('no_kk') }}"
               pattern="\d{16}"
               required>

        @error('no_kk')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- NIK --}}
    <div class="mb-3">
        <label class="form-label">NIK</label>

        <input type="text"
               class="form-control @error('nik') is-invalid @enderror"
               id="nik"
               name="nik"
               value="{{ old('nik') }}"
               pattern="\d{16}"
               required>

        @error('nik')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- NAMA --}}
    <div class="mb-3">
        <label class="form-label">Nama Kepala Keluarga</label>

        <input type="text"
               class="form-control"
               id="nama_lengkap"
               name="nama_lengkap"
               value="{{ old('nama_lengkap') }}"
               required>
    </div>

    {{-- ALAMAT --}}
    <div class="mb-3">
        <label class="form-label">Alamat</label>

        <input type="text"
               class="form-control"
               id="alamat"
               name="alamat"
               value="{{ old('alamat') }}"
               required>
    </div>

    {{-- RT RW --}}
    <div class="mb-3 row">

        <div class="col">
            <label class="form-label">RT</label>

            <input type="text"
                   class="form-control"
                   id="rt"
                   name="rt"
                   value="{{ old('rt') }}"
                   required>
        </div>

        <div class="col">
            <label class="form-label">RW</label>

            <input type="text"
                   class="form-control"
                   id="rw"
                   name="rw"
                   value="{{ old('rw') }}"
                   required>
        </div>

        <div class="col">
            <label class="form-label">Kode Pos</label>

            <input type="text"
                   class="form-control"
                   id="kode_pos"
                   name="kode_pos"
                   value="68152"
                   readonly>
        </div>

    </div>

    {{-- DESA KECAMATAN --}}
    <div class="mb-3 row">

        <div class="col">
            <label class="form-label">Desa</label>

            <input type="text"
                   class="form-control"
                   id="desa"
                   name="desa"
                   value="Rambipuji"
                   readonly>
        </div>

        <div class="col">
            <label class="form-label">Kecamatan</label>

            <input type="text"
                   class="form-control"
                   id="kecamatan"
                   name="kecamatan"
                   value="Rambipuji"
                   readonly>
        </div>

    </div>

    {{-- KABUPATEN PROVINSI --}}
    <div class="mb-3 row">

        <div class="col">
            <label class="form-label">Kabupaten</label>

            <input type="text"
                   class="form-control"
                   id="kabupaten"
                   name="kabupaten"
                   value="Jember"
                   readonly>
        </div>

        <div class="col">
            <label class="form-label">Provinsi</label>

            <input type="text"
                   class="form-control"
                   id="provinsi"
                   name="provinsi"
                   value="Jawa Timur"
                   readonly>
        </div>

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

{{-- SCRIPTS --}}
@push('scripts')
<script>
    window.importSuccess = @json(session('success'));
    window.importWarning = @json(session('warning'));
    window.importErrors = @json(session('import_errors'));
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/kartukeluarga.js') }}"></script>
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var modal = new bootstrap.Modal(document.getElementById('modalKeluarga'));
        modal.show();
    });
</script>
@endif
@endpush
@endsection