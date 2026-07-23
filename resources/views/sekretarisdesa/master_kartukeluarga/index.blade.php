@extends('admin.layout.main')

@section('title', 'Master Kartu Keluarga Sekretaris Desa')

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
            <h1 class="fw-bold text-dark mb-1">Master Kartu Keluarga - Sekretaris Desa</h1>
            <p class="text-muted small mb-0">Kelola & pantau data Kartu Keluarga seluruh wilayah Desa Rambipuji.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-house-door-fill text-primary me-2"></i>Data Kartu Keluarga</h4>
                <form class="d-flex" action="{{ route('sekdes.kartukeluarga.index') }}" method="get">
                    <input class="form-control me-2" type="search" name="katakunci"
                        value="{{ Request::get('katakunci') }}"
                        placeholder="Cari No KK / Nama Kepala Keluarga">
                    <button class="btn btn-primary btn-rounded px-4">Cari</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableKKSekdes">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>No Kartu Keluarga</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Alamat</th>
                                <th class="text-center">RW</th>
                                <th class="text-center">RT</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($master_kartukeluarga as $index => $row)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td><span class="fw-bold text-primary"><code>{{ $row->no_kk }}</code></span></td>
                                <td class="fw-semibold text-dark">{{ $row->nama_lengkap ?? '-' }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $row->rw }}</span></td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $row->rt }}</span></td>
                                <td class="text-center">
                                    <!-- LIHAT ANGGOTA KK -->
                                    <a href="{{ url('sekretarisdesa/penduduk?nokk=' . $row->no_kk) }}"
                                       class="btn btn-sm btn-info btn-rounded px-3" title="Lihat Anggota KK">
                                        <i class="bi bi-people-fill me-1"></i> Anggota KK
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $master_kartukeluarga->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
