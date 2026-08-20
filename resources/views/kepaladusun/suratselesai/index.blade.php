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
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-1">Surat Selesai — Kepala Dusun</h1>
        <p class="text-muted small mb-0">
            Arsip surat yang telah selesai diproses dan disahkan Kepala Desa.
        </p>
    </div>
</div>

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0">Arsip Surat Selesai</h4>
                <form class="d-flex" action="{{ route('kadus.suratselesai.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari NIK / Nama / Surat">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableSuratSelesaiKadus">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th class="text-center">Nama Pemohon</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">Jenis Surat</th>
                                <th class="text-center">Tanggal Disahkan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Download PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark text-center">{{ $r->nama_lengkap }}</td>
                                <td class="text-center"><code>{{ $r->nik }}</code></td>
                                <td class="text-center"><span class="badge bg-light text-dark border fw-medium">{{ $r->nama_surat }}</span></td>
                                <td class="text-muted text-center">{{ $r->updated_at ?? $r->created_at }}</td>
                                <td class="text-center"><span class="badge bg-success text-white fw-semibold px-3 py-2 rounded-pill">Selesai</span></td>
                                <td class="text-center">
                                    @if(!empty($r->file_pdf) && $r->file_pdf !== '-')
                                        <a href="{{ route('suratselesai.cetak', $r->id_pengajuan) }}" class="btn btn-sm btn-danger btn-rounded px-3">
                                            <i class="bi bi-filetype-pdf me-1"></i>Unduh PDF
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">PDF Belum Dibuat</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada surat yang berstatus Selesai.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $datapengajuan->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>$(document).ready(function(){$('#tableSuratSelesaiKadus').DataTable({language:{url:'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'},pageLength:10,responsive:true,columnDefs:[{orderable:false,targets:[6]}]});});</script>
@endpush
@endsection
