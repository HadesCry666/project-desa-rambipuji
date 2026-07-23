@extends('admin.layout.main')
@section('title', 'Surat Ditolak — Sekretaris Desa')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
body,.main-content{font-family:'Poppins','Plus Jakarta Sans',sans-serif!important}
.card-modern{border:1px solid #e2e8f0;border-radius:15px;box-shadow:0 4px 16px rgba(0,0,0,.03);background:#fff}
.table-modern{border-collapse:separate!important;border-spacing:0 5px!important}
.table-modern thead th{background:#f8fafc!important;color:#475569!important;font-weight:600!important;font-size:.74rem!important;text-transform:uppercase!important;letter-spacing:.6px!important;border-bottom:2px solid #e2e8f0!important;padding:13px 16px!important}
.table-modern tbody tr{background:#fff!important;transition:background .15s}
.table-modern tbody tr:hover{background:#fff1f2!important}
.table-modern tbody td{padding:13px 16px!important;vertical-align:middle!important;border-top:1px solid #f1f5f9!important;font-size:.875rem!important}
.btn-rounded{border-radius:30px!important}
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header mb-4">
        <h1 class="fw-bold text-dark mb-1">Surat Ditolak — Sekretaris Desa</h1>
        <p class="text-muted small mb-0">Arsip seluruh surat pengajuan yang ditolak di tingkat Sekretaris Desa maupun tingkat sebelumnya.</p>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-x-circle-fill text-danger me-2"></i>Daftar Surat Ditolak</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableDitolakSekdes">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th>Nomor Pengajuan</th>
                                <th>Nama Pemohon</th>
                                <th>Jenis Surat</th>
                                <th>Ditolak Oleh</th>
                                <th>Alasan Penolakan</th>
                                <th>Tanggal</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $ditolak = [
                                ['id'=>1,'no'=>'PGJ-202607-004','nama'=>'Rina Wijaya','surat'=>'Surat Keterangan Kelahiran','oleh'=>'Kepala Dusun','alasan'=>'Berkas tidak lengkap, KTP dan KK tidak dilampirkan.','tgl'=>'21 Jul 2026'],
                                ['id'=>2,'no'=>'PGJ-202606-012','nama'=>'Hendra Gunawan','surat'=>'SKTM','oleh'=>'Admin Desa','alasan'=>'Data pemohon tidak sesuai dengan catatan kependudukan desa.','tgl'=>'15 Jun 2026'],
                                ['id'=>3,'no'=>'PGJ-202606-008','nama'=>'M. Rizky','surat'=>'Surat Keterangan Usaha','oleh'=>'Sekretaris Desa','alasan'=>'Usaha belum beroperasi minimal 6 bulan sesuai ketentuan desa.','tgl'=>'10 Jun 2026'],
                            ];
                            @endphp
                            @foreach($ditolak as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $i+1 }}</td>
                                <td><span class="fw-bold text-danger" style="font-size:.82rem">{{ $r['no'] }}</span></td>
                                <td class="fw-semibold text-dark">{{ $r['nama'] }}</td>
                                <td><span class="badge bg-light text-dark border fw-medium">{{ $r['surat'] }}</span></td>
                                <td>
                                    <span class="badge {{ $r['oleh'] == 'Sekretaris Desa' ? 'bg-purple-subtle text-purple' : ($r['oleh'] == 'Admin Desa' ? 'bg-warning-subtle text-warning' : 'bg-info-subtle text-info') }} fw-semibold" style="color:#7e22ce">
                                        <i class="bi bi-person-fill me-1"></i>{{ $r['oleh'] }}
                                    </span>
                                </td>
                                <td class="text-muted" style="max-width:220px;white-space:normal;font-size:.82rem">{{ $r['alasan'] }}</td>
                                <td class="text-muted"><i class="bi bi-calendar-x text-danger me-1"></i>{{ $r['tgl'] }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-secondary btn-rounded px-3" data-bs-toggle="modal" data-bs-target="#modalDetailDitolakSekdes-{{ $r['id'] }}">
                                        <i class="bi bi-eye-fill me-1"></i>Detail
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

@foreach($ditolak as $r)
<div class="modal fade" id="modalDetailDitolakSekdes-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-danger text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-x-circle-fill me-2"></i>Detail Surat Ditolak</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background:#f8fafc">
                <div class="card border-0 shadow-sm rounded-3 p-3 mb-3">
                    <div class="mb-2"><span class="text-muted small d-block">Nomor Pengajuan</span><strong class="text-danger">{{ $r['no'] }}</strong></div>
                    <div class="mb-2"><span class="text-muted small d-block">Nama Pemohon</span><strong>{{ $r['nama'] }}</strong></div>
                    <div class="mb-2"><span class="text-muted small d-block">Jenis Surat</span><span class="badge bg-light text-dark border">{{ $r['surat'] }}</span></div>
                    <div class="mb-2"><span class="text-muted small d-block">Ditolak Oleh</span><strong>{{ $r['oleh'] }}</strong></div>
                    <div class="mb-2"><span class="text-muted small d-block">Tanggal</span><span>{{ $r['tgl'] }}</span></div>
                </div>
                <div class="card border-danger border-opacity-25 bg-danger-subtle rounded-3 p-3">
                    <h6 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Alasan Penolakan</h6>
                    <p class="mb-0 text-dark">{{ $r['alasan'] }}</p>
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
<script>$(document).ready(function(){$('#tableDitolakSekdes').DataTable({language:{url:'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'},pageLength:10,responsive:true,columnDefs:[{orderable:false,targets:7}]});});</script>
@endpush
@endsection
