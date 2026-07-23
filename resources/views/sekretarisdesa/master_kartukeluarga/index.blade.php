@extends('admin.layout.main')

@section('title', 'Master Kartu Keluarga Sekretaris Desa')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
            <h1 class="fw-bold text-dark mb-1">Master Kartu Keluarga - Sekretaris Desa</h1>
            <p class="text-muted small mb-0">Kelola & pantau data Kartu Keluarga seluruh wilayah Desa Rambipuji.</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary btn-rounded px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKKSekdes">
                <i class="bi bi-plus-lg me-1"></i> Tambah KK Baru
            </button>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-house-door-fill text-primary me-2"></i>Data Kartu Keluarga</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableKKSekdes">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>No Kartu Keluarga</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Alamat</th>
                                <th class="text-center">RW</th>
                                <th class="text-center">RT</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $dummyKK = [
                                    [
                                        'no_kk' => '3509121508100001',
                                        'nama' => 'Bambang Triyono',
                                        'alamat' => 'Dusun Krajan RT 001 / RW 004',
                                        'rw' => '004',
                                        'rt' => '001',
                                        'desa' => 'Rambipuji',
                                        'kecamatan' => 'Rambipuji',
                                        'kabupaten' => 'Jember',
                                        'provinsi' => 'Jawa Timur',
                                        'kode_pos' => '68152'
                                    ],
                                    [
                                        'no_kk' => '3509122002150003',
                                        'nama' => 'Sutrisno',
                                        'alamat' => 'Dusun Rambie RT 003 / RW 002',
                                        'rw' => '002',
                                        'rt' => '003',
                                        'desa' => 'Rambipuji',
                                        'kecamatan' => 'Rambipuji',
                                        'kabupaten' => 'Jember',
                                        'provinsi' => 'Jawa Timur',
                                        'kode_pos' => '68152'
                                    ]
                                ];
                            @endphp

                            @foreach($dummyKK as $index => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                <td><span class="fw-bold text-primary"><code>{{ $row['no_kk'] }}</code></span></td>
                                <td class="fw-semibold text-dark">{{ $row['nama'] }}</td>
                                <td>{{ $row['alamat'] }}</td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $row['rw'] }}</span></td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $row['rt'] }}</span></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning btn-rounded px-3 me-1" data-bs-toggle="modal" data-bs-target="#modalEditKKSekdes-{{ $index }}">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                    <a href="{{ route('sekdes.penduduk.index') }}" class="btn btn-sm btn-success btn-rounded px-3">
                                        <i class="bi bi-person-plus-fill me-1"></i> Anggota
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH KK SEKDES -->
<div class="modal fade" id="modalTambahKKSekdes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-primary"><i class="bi bi-house-add-fill me-2"></i>Tambah Data Kepala Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form id="formTambahKKSekdes">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor KK (16 Digit)</label>
                            <input type="text" class="form-control rounded-3" placeholder="Masukkan 16 digit No. KK" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Kepala Keluarga</label>
                            <input type="text" class="form-control rounded-3" placeholder="Nama Lengkap Kepala Keluarga" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Alamat Tempat Tinggal</label>
                            <input type="text" class="form-control rounded-3" placeholder="Alamat RT/RW & Dusun" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">RT</label>
                            <input type="text" class="form-control rounded-3" placeholder="001" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">RW</label>
                            <input type="text" class="form-control rounded-3" placeholder="001" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Kode Pos</label>
                            <input type="text" class="form-control rounded-3" value="68152" readonly>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-rounded px-4 btn-simpan-kk" data-bs-dismiss="modal">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#tableKKSekdes').DataTable({
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            pageLength: 10,
            responsive: true
        });
        $('.btn-simpan-kk').on('click', function() {
            Swal.fire({
                title: 'Data KK Tersimpan!',
                text: 'Master data Kartu Keluarga baru telah disimpan.',
                icon: 'success',
                confirmButtonColor: '#0057A6',
                customClass: { popup: 'rounded-4' }
            });
        });
    });
</script>
@endpush
@endsection
