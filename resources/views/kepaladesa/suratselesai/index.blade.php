@extends('admin.layout.main')

@section('title', 'Surat Selesai Kepala Desa')

@push('css-lib')
<!-- DataTables & Bootstrap Icons & Google Fonts Poppins -->
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
        transition: all 0.25s ease;
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
        transition: transform 0.15s ease, background-color 0.15s ease;
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
    .badge-success-kades {
        background-color: #d1e7dd !important;
        color: #0f5132 !important;
        border: 1px solid #badbcc !important;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 20px;
    }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Surat Selesai Kepala Desa</h1>
            <p class="text-muted small mb-0">Arsip surat resmi desa yang telah ditandatangani digital & terbit secara sah.</p>
        </div>
        <div>
            <span class="badge bg-success rounded-pill px-3 py-2 fs-7">
                <i class="bi bi-shield-check me-1"></i> Arsip Resmi Kepala Desa
            </span>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-file-earmark-check-fill text-success me-2"></i>Daftar Surat Selesai & Ber-TTE</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableKadesSelesai">
                        <thead>
                            <tr>
                                <th>Nomor Surat</th>
                                <th>Nama</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Selesai</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Download PDF</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Mockup Data Surat Selesai Kepala Desa
                                $dummyKadesSelesai = [
                                    [
                                        'id' => 301,
                                        'no_surat' => '470/115/35.09.12/2026',
                                        'nama' => 'Agus Setiawan',
                                        'nik' => '3509121706820003',
                                        'jenis_surat' => 'Surat Keterangan Domisili',
                                        'tgl_selesai' => '21 Juli 2026',
                                        'status' => 'Selesai',
                                        'file_pdf' => 'surat_domisili_agus.pdf',
                                        'keperluan' => 'Kredit Pemilikan Rumah (KPR)',
                                        'ttd_kades' => 'Signed by Kepala Desa (TTE BSrE)',
                                        'alamat' => 'Dusun Krajan RT 004 / RW 005 Desa Rambipuji',
                                        'no_hp' => '081255667788'
                                    ],
                                    [
                                        'id' => 302,
                                        'no_surat' => '471/095/35.09.12/2026',
                                        'nama' => 'Nurmala Sari',
                                        'nik' => '3509125510940002',
                                        'jenis_surat' => 'Surat Keterangan Tidak Mampu (SKTM)',
                                        'tgl_selesai' => '20 Juli 2026',
                                        'status' => 'Selesai',
                                        'file_pdf' => 'surat_sktm_nurmala.pdf',
                                        'keperluan' => 'Keringanan Biaya Rumah Sakit',
                                        'ttd_kades' => 'Signed by Kepala Desa (TTE BSrE)',
                                        'alamat' => 'Dusun Rambie RT 001 / RW 002 Desa Rambipuji',
                                        'no_hp' => '085344556677'
                                    ]
                                ];
                            @endphp

                            @foreach($dummyKadesSelesai as $row)
                            <tr>
                                <td><span class="fw-bold text-dark"><code>{{ $row['no_surat'] }}</code></span></td>
                                <td class="fw-semibold text-dark">{{ $row['nama'] }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $row['jenis_surat'] }}</span></td>
                                <td><i class="bi bi-calendar-check text-success me-1"></i>{{ $row['tgl_selesai'] }}</td>
                                <td class="text-center">
                                    <span class="badge badge-success-kades">
                                        <i class="bi bi-check-circle-fill me-1"></i> {{ $row['status'] }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-outline-danger btn-rounded px-3 btn-download-pdf" data-file="{{ $row['file_pdf'] }}">
                                        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Download PDF
                                    </a>
                                </td>
                                <td class="text-center">
                                    <button type="button" 
                                            class="btn btn-sm btn-info btn-rounded px-3" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalDetailKadesSelesai-{{ $row['id'] }}">
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

{{-- MODAL DETAIL SURAT SELESAI KEPALA DESA --}}
@foreach($dummyKadesSelesai as $row)
<div class="modal fade" id="modalDetailKadesSelesai-{{ $row['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white py-3 px-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-shield-check me-2"></i>Detail Surat Resmi Selesai - {{ $row['no_surat'] }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8fafc;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card card-modern p-3 h-100">
                            <h6 class="fw-bold text-success border-bottom pb-2 mb-3">Informasi Pemohon</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Nama Lengkap</span><strong class="text-dark">{{ $row['nama'] }}</strong></div>
                            <div class="mb-2"><span class="text-muted small d-block">NIK</span><code>{{ $row['nik'] }}</code></div>
                            <div class="mb-2"><span class="text-muted small d-block">Alamat</span><span class="text-dark">{{ $row['alamat'] }}</span></div>
                            <div><span class="text-muted small d-block">No. Telepon</span><span class="text-success fw-semibold">{{ $row['no_hp'] }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-modern p-3 h-100">
                            <h6 class="fw-bold text-success border-bottom pb-2 mb-3">Status Dokumen Resmisi</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Nomor Surat</span><strong class="text-primary">{{ $row['no_surat'] }}</strong></div>
                            <div class="mb-2"><span class="text-muted small d-block">Jenis Surat</span><span class="badge bg-light text-dark border">{{ $row['jenis_surat'] }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Tanggal Pengesahan</span><span class="text-dark fw-medium">{{ $row['tgl_selesai'] }}</span></div>
                            <div><span class="text-muted small d-block">Otensitas TTE</span><span class="badge bg-success"><i class="bi bi-patch-check-fill me-1"></i>{{ $row['ttd_kades'] }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white border-top py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-danger btn-rounded px-4 btn-download-pdf" data-file="{{ $row['file_pdf'] }}">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Download PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#tableKadesSelesai').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            },
            pageLength: 10,
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [5, 6] }
            ]
        });

        $('.btn-download-pdf').on('click', function(e) {
            e.preventDefault();
            var fileName = $(this).data('file');
            Swal.fire({
                title: 'Mengunduh Surat...',
                text: 'File ' + fileName + ' sedang diunduh.',
                icon: 'info',
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-4'
                }
            });
        });
    });
</script>
@endpush
@endsection
