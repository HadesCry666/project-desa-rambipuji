@extends('admin.layout.main')
@section('title', 'Surat Selesai — Kepala Dusun')

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
.table-modern tbody tr:hover{background:#f0fff4!important}
.table-modern tbody td{padding:13px 16px!important;vertical-align:middle!important;border-top:1px solid #f1f5f9!important;font-size:.875rem!important}
.btn-rounded{border-radius:30px!important}
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header mb-4">
        <h1 class="fw-bold text-dark mb-1">Surat Selesai — Kepala Dusun</h1>
        <p class="text-muted small mb-0">Arsip surat yang telah selesai diproses dan siap diunduh warga.</p>
    </div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-check-circle-fill text-success me-2"></i>Arsip Surat Selesai</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableSuratSelesaiKadus">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th>Nomor Surat</th>
                                <th>Nama Pemohon</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Selesai</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Download PDF</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $selesai = [
                                ['id'=>1,'no_surat'=>'474/001/DS-RBP/VII/2026','nama'=>'Budi Santoso','surat'=>'Surat Keterangan Domisili','tgl'=>'20 Jul 2026'],
                                ['id'=>2,'no_surat'=>'474/002/DS-RBP/VII/2026','nama'=>'Eko Prasetyo','surat'=>'Surat Keterangan Usaha','tgl'=>'18 Jul 2026'],
                                ['id'=>3,'no_surat'=>'474/003/DS-RBP/VI/2026','nama'=>'Dewi Lestari','surat'=>'SKTM','tgl'=>'12 Jun 2026'],
                            ];
                            @endphp
                            @foreach($selesai as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $i+1 }}</td>
                                <td><span class="fw-bold text-primary" style="font-size:.82rem">{{ $r['no_surat'] }}</span></td>
                                <td class="fw-semibold text-dark">{{ $r['nama'] }}</td>
                                <td><span class="badge bg-light text-dark border fw-medium">{{ $r['surat'] }}</span></td>
                                <td class="text-muted"><i class="bi bi-calendar-check text-success me-1"></i>{{ $r['tgl'] }}</td>
                                <td class="text-center"><span class="badge bg-success text-white fw-semibold px-3 py-2 rounded-pill">Selesai</span></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-danger btn-rounded px-3" onclick="event.preventDefault();Swal.fire({title:'Download PDF',text:'File surat siap diunduh.',icon:'success',confirmButtonColor:\'#dc3545\'})">
                                        <i class="bi bi-filetype-pdf me-1"></i>Unduh PDF
                                    </a>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info btn-rounded px-3" data-bs-toggle="modal" data-bs-target="#modalDetailSelesai-{{ $r['id'] }}">
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

@foreach($selesai as $r)
<div class="modal fade" id="modalDetailSelesai-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-check-circle-fill me-2"></i>Detail Surat Selesai</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background:#f8fafc">
                <div class="card border-0 shadow-sm rounded-3 p-3 mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2"><span class="text-muted small d-block">Nomor Surat</span><strong class="text-primary">{{ $r['no_surat'] }}</strong></div>
                            <div class="mb-2"><span class="text-muted small d-block">Nama Pemohon</span><strong>{{ $r['nama'] }}</strong></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2"><span class="text-muted small d-block">Jenis Surat</span><span class="badge bg-primary">{{ $r['surat'] }}</span></div>
                            <div><span class="text-muted small d-block">Tanggal Selesai</span><strong>{{ $r['tgl'] }}</strong></div>
                        </div>
                    </div>
                </div>
                {{-- Timeline --}}
                <div class="card border-0 shadow-sm rounded-3 p-3">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-clock-history me-2"></i>Timeline Persetujuan</h6>
                    <div class="position-relative" style="padding-left:28px;border-left:2px solid #e2e8f0">
                        @php $steps = [['label'=>'Diajukan','date'=>'15 Jul 2026','color'=>'primary'],['label'=>'Disetujui Kepala Dusun','date'=>'16 Jul 2026','color'=>'info'],['label'=>'Disetujui Admin','date'=>'17 Jul 2026','color'=>'warning'],['label'=>'Disetujui Sekretaris Desa','date'=>'18 Jul 2026','color'=>'purple'],['label'=>'Disetujui Kepala Desa','date'=>'19 Jul 2026','color'=>'dark'],['label'=>'Generate PDF & TTE','date'=>'19 Jul 2026','color'=>'danger'],['label'=>'Selesai','date'=>$r['tgl'],'color'=>'success']]; @endphp
                        @foreach($steps as $s)
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-{{ $s['color'] }} d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block" style="font-size:.88rem">{{ $s['label'] }}</span>
                            <small class="text-muted">{{ $s['date'] }}</small>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-danger btn-rounded px-4"><i class="bi bi-filetype-pdf me-1"></i>Unduh PDF</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>$(document).ready(function(){$('#tableSuratSelesaiKadus').DataTable({language:{url:'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'},pageLength:10,responsive:true,columnDefs:[{orderable:false,targets:[6,7]}]});});</script>
@endpush
@endsection
