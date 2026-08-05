@extends('admin.layout.main')
@section('title', 'Surat Ditolak — Kepala Dusun')

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
        <div>
        <h1 class="fw-bold text-dark mb-1">Surat Ditolak — Kepala Dusun</h1>
        <p class="text-muted small mb-0">Daftar pengajuan surat yang telah ditolak di tahap manapun.</p>
        </div>
    </div>
@if(session('success'))
    <div id="alertPopup" class="alert alert-success alert-floating">
        {{ session('success') }}
    </div>
@endif
    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0">Arsip Surat Ditolak</h4>
                <form class="d-flex" action="{{ route('kadus.suratditolak.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Cari NIK / Nama / Surat">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableDitolakKadus">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th>Nama Pemohon</th>
                                <th>NIK</th>
                                <th>Jenis Surat</th>
                                <th>Status Penolakan</th>
                                <th>Alasan Penolakan</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ $r->nama_lengkap }}</td>
                                <td><code>{{ $r->nik }}</code></td>
                                <td><span class="badge bg-light text-dark border fw-medium">{{ $r->nama_surat }}</span></td>
                                <td>
                                    <span class="badge bg-danger text-white fw-semibold px-3 py-1 rounded-pill">
                                        <i class="bi bi-x-circle-fill me-1"></i>{{ $r->status }}
                                    </span>
                                </td>
                                <td class="text-muted" style="max-width:250px;white-space:normal;font-size:.82rem">{{ $r->keterangan_ditolak ?? '-' }}</td>
                                <td class="text-muted">{{ $r->updated_at ?? $r->created_at }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada pengajuan surat yang ditolak.</td>
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
<script>$(document).ready(function(){$('#tableDitolakKadus').DataTable({language:{url:'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'},pageLength:10,responsive:true});});</script>
@endpush
@endsection
