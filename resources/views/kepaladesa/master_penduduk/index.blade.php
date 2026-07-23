@extends('admin.layout.main')

@section('title', 'Master Penduduk Kepala Desa')

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
        transition: background-color 0.15s ease;
    }
    .table-modern tbody tr:hover {
        background-color: #f0f7ff !important;
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
            <h1 class="fw-bold text-dark mb-1">Master Penduduk - Kepala Desa</h1>
            <p class="text-muted small mb-0">Data kependudukan warga Desa Rambipuji (Read-Only untuk Kepala Desa).</p>
        </div>
        <div>
            <span class="badge bg-danger rounded-pill px-3 py-2">
                <i class="bi bi-eye-fill me-1"></i> Mode Kepala Desa
            </span>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0">
                    <i class="bi bi-people-fill text-primary me-2"></i>Tabel Master Data Penduduk
                </h4>
                <span class="badge bg-light text-muted border px-3 py-2 small">
                    <i class="bi bi-lock-fill me-1"></i> Hanya Bisa Dilihat
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tablePendudukKades">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>NO KK</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Keluarga</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $dummyPendudukKades = [
                                    [
                                        'no_kk'       => '3509121508100001',
                                        'nik'         => '3509121203850004',
                                        'nama'        => 'Bambang Triyono',
                                        'tgl_lahir'   => '12 Maret 1985',
                                        'jk'          => 'Laki-Laki',
                                        'status'      => 'KEPALA KELUARGA',
                                        'pekerjaan'   => 'Wiraswasta',
                                        'agama'       => 'ISLAM',
                                        'pendidikan'  => 'SLTA / SEDERAJAT',
                                        'alamat'      => 'Dusun Krajan RT 001 / RW 004',
                                    ],
                                    [
                                        'no_kk'       => '3509121508100001',
                                        'nik'         => '3509124409920001',
                                        'nama'        => 'Dewi Lestari',
                                        'tgl_lahir'   => '04 September 1992',
                                        'jk'          => 'Perempuan',
                                        'status'      => 'ISTRI',
                                        'pekerjaan'   => 'Ibu Rumah Tangga',
                                        'agama'       => 'ISLAM',
                                        'pendidikan'  => 'SLTA / SEDERAJAT',
                                        'alamat'      => 'Dusun Krajan RT 001 / RW 004',
                                    ],
                                    [
                                        'no_kk'       => '3509122002150003',
                                        'nik'         => '3509121807890005',
                                        'nama'        => 'Eko Prasetyo',
                                        'tgl_lahir'   => '18 Juli 1989',
                                        'jk'          => 'Laki-Laki',
                                        'status'      => 'KEPALA KELUARGA',
                                        'pekerjaan'   => 'Petani',
                                        'agama'       => 'ISLAM',
                                        'pendidikan'  => 'DIPLOMA IV / STRATA I',
                                        'alamat'      => 'Dusun Rambie RT 003 / RW 002',
                                    ],
                                ];
                            @endphp

                            @foreach($dummyPendudukKades as $index => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                <td><code class="text-muted">{{ $row['no_kk'] }}</code></td>
                                <td><span class="fw-bold text-primary"><code>{{ $row['nik'] }}</code></span></td>
                                <td class="fw-semibold text-dark">{{ $row['nama'] }}</td>
                                <td class="text-muted">{{ $row['tgl_lahir'] }}</td>
                                <td>
                                    @if($row['jk'] == 'Laki-Laki')
                                        <span class="badge bg-info-subtle text-info fw-semibold">
                                            <i class="bi bi-gender-male me-1"></i> Laki-Laki
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger fw-semibold">
                                            <i class="bi bi-gender-female me-1"></i> Perempuan
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $row['status'] }}</span>
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-sm btn-info btn-rounded px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetailPendudukKades-{{ $index }}">
                                        <i class="bi bi-eye-fill me-1"></i> Detail
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

{{-- MODAL DETAIL PENDUDUK KEPALA DESA --}}
@foreach($dummyPendudukKades as $index => $row)
<div class="modal fade" id="modalDetailPendudukKades-{{ $index }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-badge-fill me-2"></i>Detail Data Penduduk
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8fafc;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card card-modern p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                <i class="bi bi-person-fill me-2"></i>Identitas Pribadi
                            </h6>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Nama Lengkap</span>
                                <strong class="text-dark">{{ $row['nama'] }}</strong>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">NIK</span>
                                <code class="text-primary fw-bold">{{ $row['nik'] }}</code>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Jenis Kelamin</span>
                                <span class="fw-medium text-dark">{{ $row['jk'] }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Tanggal Lahir</span>
                                <span class="fw-medium text-dark">{{ $row['tgl_lahir'] }}</span>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Agama</span>
                                <span class="fw-medium text-dark">{{ $row['agama'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-modern p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                <i class="bi bi-info-circle-fill me-2"></i>Data Kependudukan
                            </h6>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Nomor KK</span>
                                <code class="text-muted">{{ $row['no_kk'] }}</code>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Status Dalam Keluarga</span>
                                <span class="badge bg-primary fw-semibold px-3 py-1">{{ $row['status'] }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Pekerjaan</span>
                                <span class="fw-medium text-dark">{{ $row['pekerjaan'] }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted small d-block">Pendidikan Terakhir</span>
                                <span class="fw-medium text-dark">{{ $row['pendidikan'] }}</span>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Alamat</span>
                                <span class="fw-medium text-dark">{{ $row['alamat'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tablePendudukKades').DataTable({
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            pageLength: 10,
            responsive: true,
            columnDefs: [{ orderable: false, targets: 7 }]
        });
    });
</script>
@endpush
@endsection
