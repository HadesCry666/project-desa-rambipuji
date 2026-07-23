@extends('admin.layout.main')

@section('title', 'Master Penduduk Sekretaris Desa')

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
            <h1 class="fw-bold text-dark mb-1">Master Penduduk - Sekretaris Desa</h1>
            <p class="text-muted small mb-0">Kelola biodata warga & anggota keluarga Desa Rambipuji.</p>
        </div>
        <div>
            <button type="button" class="btn btn-primary btn-rounded px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPendudukSekdes">
                <i class="bi bi-person-plus-fill me-1"></i> Tambah Data Penduduk
            </button>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-people-fill text-primary me-2"></i>Tabel Master Data Penduduk</h4>
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
                            @php
                                $dummyPenduduk = [
                                    [
                                        'no_kk' => '3509121508100001',
                                        'nik' => '3509121203850004',
                                        'nama' => 'Bambang Triyono',
                                        'tgl_lahir' => '12 Maret 1985',
                                        'status' => 'KEPALA KELUARGA'
                                    ],
                                    [
                                        'no_kk' => '3509121508100001',
                                        'nik' => '3509124409920001',
                                        'nama' => 'Dewi Lestari',
                                        'tgl_lahir' => '04 September 1992',
                                        'status' => 'ISTRI'
                                    ]
                                ];
                            @endphp

                            @foreach($dummyPenduduk as $index => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                <td><code>{{ $row['no_kk'] }}</code></td>
                                <td><span class="fw-bold text-primary"><code>{{ $row['nik'] }}</code></span></td>
                                <td class="fw-semibold text-dark">{{ $row['nama'] }}</td>
                                <td>{{ $row['tgl_lahir'] }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $row['status'] }}</span></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning btn-rounded px-3 me-1">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger btn-rounded px-3 btn-hapus-penduduk">
                                        <i class="bi bi-trash-fill me-1"></i> Hapus
                                    </button>
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

<!-- MODAL TAMBAH PENDUDUK SEKDES -->
<div class="modal fade" id="modalTambahPendudukSekdes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-primary"><i class="bi bi-person-plus-fill me-2"></i>Tambah Data Penduduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form id="formTambahPendudukSekdes">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. Kartu Keluarga (KK)</label>
                            <input type="text" class="form-control rounded-3" placeholder="16 Digit No. KK" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" class="form-control rounded-3" placeholder="16 Digit NIK" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-3" placeholder="Nama Lengkap Warga" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select class="form-select rounded-3" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option>Laki - Laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" class="form-control rounded-3" placeholder="Kota / Kab Lahir" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Agama</label>
                            <select class="form-select rounded-3" required>
                                <option>ISLAM</option>
                                <option>KRISTEN</option>
                                <option>KATHOLIK</option>
                                <option>HINDU</option>
                                <option>BUDHA</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Dalam Keluarga</label>
                            <select class="form-select rounded-3" required>
                                <option>KEPALA KELUARGA</option>
                                <option>SUAMI</option>
                                <option>ISTRI</option>
                                <option>ANAK</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-rounded px-4 btn-simpan-penduduk" data-bs-dismiss="modal">Simpan Penduduk</button>
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
        $('#tablePendudukSekdes').DataTable({
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            pageLength: 10,
            responsive: true
        });
        $('.btn-simpan-penduduk').on('click', function() {
            Swal.fire({
                title: 'Data Penduduk Tersimpan!',
                text: 'Data penduduk baru telah ditambahkan.',
                icon: 'success',
                confirmButtonColor: '#0057A6',
                customClass: { popup: 'rounded-4' }
            });
        });
        $('.btn-hapus-penduduk').on('click', function() {
            Swal.fire({
                title: 'Hapus Data Penduduk?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-4' }
            });
        });
    });
</script>
@endpush
@endsection
