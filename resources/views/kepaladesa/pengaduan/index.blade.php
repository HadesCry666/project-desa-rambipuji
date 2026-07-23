@extends('admin.layout.main')

@section('title', 'Master Pengaduan Kepala Desa')

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
            <h1 class="fw-bold text-dark mb-1">Master Pengaduan - Kepala Desa</h1>
            <p class="text-muted small mb-0">Monitor laporan pengaduan & aspirasi warga Desa Rambipuji.</p>
        </div>
        <div>
            <span class="badge bg-danger rounded-pill px-3 py-2 fs-7">
                <i class="bi bi-megaphone-fill me-1"></i> Pengawasan Pengaduan
            </span>
        </div>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-chat-left-dots-fill text-primary me-2"></i>Laporan Masuk Dari Warga</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tablePengaduanKades">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Tanggal</th>
                                <th>Pelapor / NIK</th>
                                <th>Judul Pengaduan</th>
                                <th>Kategori</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $dummyPengaduan = [
                                    [
                                        'id' => 1,
                                        'tanggal' => '22 Juli 2026',
                                        'nama' => 'Bambang Supriyanto',
                                        'nik' => '3509121203850004',
                                        'judul' => 'Jalan Rusak & Lampu Penerangan Padam di RW 005',
                                        'kategori' => 'Infrastruktur',
                                        'status' => 'Diproses',
                                        'isi' => 'Lampu jalan utama Dusun Krajan RT 002 sudah mati sejak 1 minggu lalu dan ada lubang jalan yang membahayakan pengendara.',
                                        'feedback' => 'Tim perbaikan telah berkoordinasi dengan Sekdes untuk tindak lanjut.'
                                    ]
                                ];
                            @endphp

                            @foreach($dummyPengaduan as $index => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>
                                    <strong class="d-block text-dark">{{ $row['nama'] }}</strong>
                                    <small class="text-muted"><code>{{ $row['nik'] }}</code></small>
                                </td>
                                <td class="fw-semibold text-dark">{{ $row['judul'] }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $row['kategori'] }}</span></td>
                                <td class="text-center">
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-1"><i class="bi bi-clock-history me-1"></i>Diproses</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info btn-rounded px-3 me-1" data-bs-toggle="modal" data-bs-target="#modalDetailPengaduanKades-{{ $row['id'] }}">
                                        <i class="bi bi-eye-fill me-1"></i> Detail
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary btn-rounded px-3" data-bs-toggle="modal" data-bs-target="#modalFeedbackPengaduanKades-{{ $row['id'] }}">
                                        <i class="bi bi-reply-fill me-1"></i> Feedback
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

@foreach($dummyPengaduan as $row)
<div class="modal fade" id="modalDetailPengaduanKades-{{ $row['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-megaphone-fill me-2"></i>Detail Pengaduan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8fafc;">
                <div class="card card-modern p-3 mb-3">
                    <h6 class="fw-bold text-primary mb-2">{{ $row['judul'] }}</h6>
                    <div class="small text-muted mb-3"><i class="bi bi-person me-1"></i>{{ $row['nama'] }} ({{ $row['nik'] }})</div>
                    <p class="text-dark bg-light p-3 rounded-3 border mb-0">{{ $row['isi'] }}</p>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFeedbackPengaduanKades-{{ $row['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-primary"><i class="bi bi-reply-fill me-2"></i>Beri Arahan / Feedback Kepala Desa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="mb-3 text-start">
                    <label class="form-label fw-semibold">Arahan Kepala Desa</label>
                    <textarea class="form-control rounded-3" rows="4" placeholder="Masukkan arahan atau tanggapan...">{{ $row['feedback'] }}</textarea>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-rounded px-4 btn-simpan-feedback-kades" data-bs-dismiss="modal">Simpan Arahan</button>
                </div>
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
        $('#tablePengaduanKades').DataTable({
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
            pageLength: 10,
            responsive: true
        });
        $('.btn-simpan-feedback-kades').on('click', function() {
            Swal.fire({
                title: 'Arahan Tersimpan!',
                text: 'Tanggapan Kepala Desa telah disimpan.',
                icon: 'success',
                confirmButtonColor: '#0057A6',
                customClass: { popup: 'rounded-4' }
            });
        });
    });
</script>
@endpush
@endsection
