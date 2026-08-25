@extends('admin.layout.main')
@section('title', 'Master Penduduk')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0,0,0,0.03) !important; background: #fff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 4px !important; }
    .table-modern thead th { background: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: .70rem !important; letter-spacing: .5px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 12px 10px !important; white-space: nowrap; }
    .table-modern tbody tr { background: #fff !important; box-shadow: 0 2px 6px rgba(0,0,0,.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 10px 10px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: .82rem !important; white-space: nowrap; }
    .btn-rounded { border-radius: 30px !important; }
    .action-group { display: flex; align-items: center; justify-content: center; gap: 4px; flex-wrap: nowrap; white-space: nowrap; }
    .btn-icon { width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50% !important; padding: 0 !important; font-size: 0.75rem; }
    .dropdown-item:hover { background: #f1f5ff; }
    .badge-kelamin-l { background: #dbeafe; color: #1e40af; }
    .badge-kelamin-p { background: #fce7f3; color: #9d174d; }
</style>
@endpush

@section('content')

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Master Penduduk</h1>
            <p class="text-muted small mb-0">Kelola data seluruh penduduk Desa Rambipuji.</p>
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
                                  placeholder="Cari No KK / NIK / Nama">
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

                            </div>

                      </div>
                  </div>
                    <!-- CARD BODY -->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-modern w-100" id="activityTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:45px;">No</th>
                                        {{-- <th>Kecamatan</th>
                                        <th>Kelurahan</th> --}}
                                        <th>No KK</th>
                                        <th>No KTP (NIK)</th>
                                        <th>Nama</th>
                                        {{-- <th>Tempat Lahir</th> --}}
                                        <th>Tanggal Lahir</th>
                                        {{-- <th>Sts Kawin</th> --}}
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th class="text-center">RT</th>
                                        <th class="text-center">RW</th>
                                        <th class="text-center" style="width:100px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($master_kartukeluarga as $a)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                        {{-- <td class="text-muted small">{{ $a->kecamatan }}</td>
                                        <td class="text-muted small">{{ $a->desa }}</td> --}}
                                        <td><code class="fw-bold text-primary" style="font-size:.78rem;">{{ $a->no_kk }}</code></td>
                                        <td><code class="fw-bold" style="font-size:.78rem;">{{ $a->nik ?? '-' }}</code></td>
                                        <td class="fw-semibold text-dark">{{ $a->nama_lengkap ?? '-' }}</td>
                                        {{-- <td class="text-muted small">{{ $a->tempat_lahir ?? '-' }}</td> --}}
                                        <td class="text-muted small">
                                            {{ $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->format('d/m/Y') : '-' }}
                                        </td>
                                        {{-- <td>
                                            <span class="badge bg-light text-dark border" style="font-size:.72rem;">
                                                {{ $a->status_perkawinan ?? '-' }}
                                            </span>
                                        </td> --}}
                                        <td>
                                            @if($a->jenis_kelamin == 'Laki-laki' || $a->jenis_kelamin == 'LAKI-LAKI')
                                                <span class="badge badge-kelamin-l" style="font-size:.72rem;">L</span>
                                            @elseif($a->jenis_kelamin == 'Perempuan' || $a->jenis_kelamin == 'PEREMPUAN')
                                                <span class="badge badge-kelamin-p" style="font-size:.72rem;">P</span>
                                            @else
                                                <span class="badge bg-light text-muted border" style="font-size:.72rem;">{{ $a->jenis_kelamin ?? '-' }}</span>
                                            @endif
                                        </td>
                                        <td class="text-muted small">{{ $a->alamat }}</td>
                                        <td class="text-center"><span class="badge bg-light text-dark border">{{ $a->rt }}</span></td>
                                        <td class="text-center"><span class="badge bg-light text-dark border">{{ $a->rw }}</span></td>
                                        <td class="text-center">
                                            <div class="action-group">
                                                <!-- HAPUS -->
                                                <form id="formHapus{{ $a->no_kk }}" style="display:inline" action="{{ route('kartukeluarga.delete', $a->no_kk) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-danger btn-icon btnDeleteKeluarga"
                                                        title="Hapus Seluruh Data KK"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-id="{{ $a->no_kk }}" data-nama_lengkap="{{ $a->nama_lengkap ?? 'ini' }}">
                                                        <i class="fas fa-trash"></i>
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
                            {{ $master_kartukeluarga->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SCRIPTS --}}
@push('scripts')
<!-- Pastikan CDN SweetAlert2 sudah terpasang di head/footer -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('import_errors'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Mengambil array error dari session laravel
        let errors = @json(session('import_errors'));
        
        // Menyusun daftar error menjadi list HTML
        let errorListHtml = '<ul style="text-align: left; max-height: 250px; overflow-y: auto; font-size: 14px; background-color: #f8f9fa; padding: 15px 15px 15px 35px; border-radius: 8px; border: 1px solid #dee2e6;">';
        errors.forEach(function(error) {
            errorListHtml += '<li style="margin-bottom: 5px;">' + error + '</li>';
        });
        errorListHtml += '</ul>';

        // Tampilkan SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Import Data Dibatalkan!',
            html: '<p style="text-align: left; margin-bottom: 10px;">Proses import dihentikan karena ditemukan kesalahan pada data berikut:</p>' + errorListHtml,
            confirmButtonText: 'Tutup & Perbaiki Excel',
            confirmButtonColor: '#dc3545',
            width: '600px'
        });
    });
</script>
@endif
<script>
    window.importSuccess = @json(session('success'));
    window.importWarning = @json(session('warning'));
    window.importErrors = @json(session('import_errors'));
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/kartukeluarga.js') }}"></script>
@endpush
@endsection