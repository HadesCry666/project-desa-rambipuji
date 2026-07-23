@extends('admin.layout.main')

@section('title', 'Master Penduduk Kepala Desa')

@push('css-lib')
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

    @if($no_kk)
    <div class="alert alert-info d-flex align-items-center justify-content-between mb-3">
        <div>
            <i class="bi bi-people-fill me-2"></i>
            <strong>Menampilkan anggota keluarga dengan No. KK: {{ $no_kk }}</strong>
        </div>
        <a href="{{ route('kades.kartukeluarga.index') }}" class="btn btn-sm btn-outline-primary btn-rounded px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Kartu Keluarga
        </a>
    </div>
    @endif

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0">
                    <i class="bi bi-people-fill text-primary me-2"></i>Tabel Master Data Penduduk
                </h4>
                <form class="d-flex" action="{{ route('kades.penduduk.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci"
                        value="{{ Request::get('katakunci') }}"
                        placeholder="Cari NIK / Nama">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
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
                                <th>Status Keluarga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($master_penduduk as $index => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td><code class="text-muted">{{ $row->no_kk }}</code></td>
                                <td><span class="fw-bold text-primary"><code>{{ $row->nik }}</code></span></td>
                                <td class="fw-semibold text-dark">{{ $row->nama_lengkap }}</td>
                                <td class="text-muted">{{ $row->tanggal_lahir }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $row->status_keluarga }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $master_penduduk->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
