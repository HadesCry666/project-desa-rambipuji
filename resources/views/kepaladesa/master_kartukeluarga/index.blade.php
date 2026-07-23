@extends('admin.layout.main')

@section('title', 'Master Kartu Keluarga Kepala Desa')

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
            <h1 class="fw-bold text-dark mb-1">Master Kartu Keluarga - Kepala Desa</h1>
            <p class="text-muted small mb-0">Data Kartu Keluarga seluruh wilayah Desa Rambipuji (Read-Only untuk Kepala Desa).</p>
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
                    <i class="bi bi-house-door-fill text-primary me-2"></i>Data Kartu Keluarga
                </h4>
                <span class="badge bg-light text-muted border px-3 py-2 small">
                    <i class="bi bi-lock-fill me-1"></i> Hanya Bisa Dilihat
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableKKKades">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>No Kartu Keluarga</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Alamat</th>
                                <th class="text-center">RW</th>
                                <th class="text-center">RT</th>
                                <th class="text-center">Jml Anggota</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $dummyKKKades = [
                                    [
                                        'no_kk'   => '3509121508100001',
                                        'nama'    => 'Bambang Triyono',
                                        'alamat'  => 'Dusun Krajan RT 001 / RW 004',
                                        'rw'      => '004',
                                        'rt'      => '001',
                                        'anggota' => 4,
                                    ],
                                    [
                                        'no_kk'   => '3509122002150003',
                                        'nama'    => 'Sutrisno Wibowo',
                                        'alamat'  => 'Dusun Rambie RT 003 / RW 002',
                                        'rw'      => '002',
                                        'rt'      => '003',
                                        'anggota' => 3,
                                    ],
                                    [
                                        'no_kk'   => '3509120505880007',
                                        'nama'    => 'Hendra Gunawan',
                                        'alamat'  => 'Dusun Gudang RT 002 / RW 001',
                                        'rw'      => '001',
                                        'rt'      => '002',
                                        'anggota' => 5,
                                    ],
                                ];
                            @endphp

                            @foreach($dummyKKKades as $index => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-bold text-primary"><code>{{ $row['no_kk'] }}</code></span>
                                </td>
                                <td class="fw-semibold text-dark">{{ $row['nama'] }}</td>
                                <td class="text-muted">{{ $row['alamat'] }}</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border fw-bold">{{ $row['rw'] }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border fw-bold">{{ $row['rt'] }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill">
                                        {{ $row['anggota'] }} Orang
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                            class="btn btn-sm btn-info btn-rounded px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetailKKKades-{{ $index }}">
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

{{-- MODAL DETAIL KK KEPALA DESA --}}
@foreach($dummyKKKades as $index => $row)
<div class="modal fade" id="modalDetailKKKades-{{ $index }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-house-door-fill me-2"></i>Detail Kartu Keluarga
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8fafc;">
                <div class="card card-modern p-3">
                    <div class="mb-3">
                        <span class="text-muted small d-block">Nomor Kartu Keluarga</span>
                        <strong class="text-primary fs-6"><code>{{ $row['no_kk'] }}</code></strong>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted small d-block">Nama Kepala Keluarga</span>
                        <strong class="text-dark">{{ $row['nama'] }}</strong>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted small d-block">Alamat Tempat Tinggal</span>
                        <span class="text-dark fw-medium">{{ $row['alamat'] }}</span>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <span class="text-muted small d-block">RT</span>
                            <span class="badge bg-light text-dark border fw-bold fs-6">{{ $row['rt'] }}</span>
                        </div>
                        <div class="col-4">
                            <span class="text-muted small d-block">RW</span>
                            <span class="badge bg-light text-dark border fw-bold fs-6">{{ $row['rw'] }}</span>
                        </div>
                        <div class="col-4">
                            <span class="text-muted small d-block">Jumlah Anggota</span>
                            <span class="badge bg-primary text-white fw-bold fs-6">{{ $row['anggota'] }} Org</span>
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
        $('#tableKKKades').DataTable({
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            pageLength: 10,
            responsive: true,
            columnDefs: [{ orderable: false, targets: 7 }]
        });
    });
</script>
@endpush
@endsection
