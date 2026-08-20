@extends('admin.layout.main')
@section('title', 'Surat Selesai')

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
.table-modern tbody tr:hover{background:#f0f7ff!important}
.table-modern tbody td{padding:13px 16px!important;vertical-align:middle!important;border-top:1px solid #f1f5f9!important;font-size:.875rem!important}
.btn-rounded{border-radius:30px!important}
.badge-kadus{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;font-weight:600;padding:5px 12px;border-radius:20px;font-size:.78rem}
.badge-diajukan{background:#fef3c7;color:#d97706;border:1px solid #fde68a;font-weight:600;padding:5px 12px;border-radius:20px;font-size:.78rem}
.keterangan-preset {cursor:pointer;transition:all .15s;}
.keterangan-preset:hover{background-color:#dbeafe!important;border-color:#3b82f6!important;}
</style>
@endpush

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="section">
    <div class="section-header">
        <h1>Surat Selesai</h1>
    </div>
 
    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    {{-- Form Search --}}
                    <div class="card-header d-flex justify-content-between">
                        <form class="d-flex" action="{{ route('suratselesai.index') }}" method="get">
                            <input class="form-control me-1" type="search" name="katakunci"
                                   value="{{ Request::get('katakunci') }}"
                                   placeholder="Cari">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </form>
                    </div>

                    {{-- Table --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-modern w100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px">No</th>
                                        <th>Nama Pemohon</th>
                                        <th class="text-center">Jenis Surat</th>
                                        <th class="text-center">Tanggal Pengajuan</th>
                                        <th class="text-center">RW</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @forelse ($datapengajuan as $a)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                        <td class="">
                                            <div class="fw-semibold">
                                                {{ $a->nama_lengkap ?? 'Warga' }}
                                            </div>
                                            <div style="font-size:11px;color:#e83e8c;">
                                                {{ $a->nik }}
                                            </div>
                                        </td>
                                        <td class="text-center"><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $a->nama_surat }}</td>
                                        <td class="text-muted text-center">{{ $a->tanggal_diajukan }}</td>
                                        <td class="text-center"><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $a->rw }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $a->id_pengajuan }}"><i class="bi bi-eye-fill"></i> </button>
                                            <a href="{{ route('suratselesai.cetak', $a->id_pengajuan) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-danger btn-rounded px-2"
                                                title="Cetak Surat PDF">
                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                @empty
                                    <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada pengajuan surat masuk.</td>
                            </tr>
                                @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>


{{-- ========================= --}}
{{-- MODAL DI LUAR SECTION --}}
{{-- ========================= --}}

@foreach ($datapengajuan as $a)
<div class="modal fade" id="modalDetail-{{ $a->id_pengajuan }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title">Detail Pengajuan</h6>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{ $a->nama_lengkap }}" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Surat</label>
                    <input type="text" class="form-control" value="{{ $a->nama_surat }}" readonly>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" value="{{ $a->jenis_kelamin }}" readonly>
                    </div>
                    <div class="col">
                        <label>TTL</label>
                        <input type="text" class="form-control" value="{{ $a->tempat_tanggal_lahir }}" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label>Warga / Agama</label>
                        <input type="text" class="form-control" value="{{ $a->warga_agama }}" readonly>
                    </div>
                    <div class="col">
                        <label>RW</label>
                        <input type="text" class="form-control" value="{{ $a->rw }}" readonly>
                    </div>
                    <div class="col">
                        <label>RT</label>
                        <input type="text" class="form-control" value="{{ $a->rt }}" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label>Keperluan</label>
                        <input type="text" class="form-control" value="{{ $a->keperluan }}" readonly>
                    </div>
                    <div class="col">
                        <label>Tanggal Diajukan</label>
                        <input type="text" class="form-control" value="{{ $a->tanggal_diajukan }}" readonly>
                    </div>
                </div>

                {{-- FOTO --}}
                <div class="row mt-3">
                    @for ($i = 1; $i <= 8; $i++)
                        @php $foto = 'foto'.$i; @endphp
                        @if (!empty($a->$foto))
                            <div class="col-12 mb-2">
                                <label>Bukti {{ $i }}</label>
                                <img src="{{ asset('storage/surat/' . $a->$foto) }}"
                                     class="img-fluid">
                            </div>
                        @endif
                    @endfor
                </div>

            </div>

            <div class="modal-footer">
                <a href="{{ route('suratselesai.cetak', $a->id_pengajuan) }}" target="_blank" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Cetak PDF Surat
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
@endforeach
@endsection