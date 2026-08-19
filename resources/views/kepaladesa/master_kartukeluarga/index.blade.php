@extends('admin.layout.main')

@section('title', 'Master Penduduk Kepala Desa')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0,0,0,0.03) !important; background: #fff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 4px !important; }
    .table-modern thead th { background: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: .70rem !important; letter-spacing: .5px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 12px 10px !important; white-space: nowrap; }
    .table-modern tbody tr { background: #fff !important; box-shadow: 0 2px 6px rgba(0,0,0,.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 10px 10px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: .82rem !important; white-space: nowrap; }
    .btn-rounded { border-radius: 30px !important; }
    .badge-kelamin-l { background: #dbeafe; color: #1e40af; }
    .badge-kelamin-p { background: #fce7f3; color: #9d174d; }
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Master Penduduk — Kepala Desa</h1>
            <p class="text-muted small mb-0">Data seluruh penduduk Desa Rambipuji (Read-Only untuk Kepala Desa).</p>
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
                    <i class="bi bi-people-fill text-primary me-2"></i>Data Penduduk
                </h4>
                <form class="d-flex" action="{{ route('kades.kartukeluarga.index') }}" method="get">
                    <input class="form-control me-2 rounded-pill px-3" type="search" name="katakunci"
                        value="{{ Request::get('katakunci') }}"
                        placeholder="Cari No KK / NIK / Nama">
                    <button class="btn btn-primary btn-rounded px-4"><i class="bi bi-search me-1"></i> Cari</button>
                </form>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableKKKades">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:45px;">No</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>No KK</th>
                                <th>No KTP (NIK)</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Sts Kawin</th>
                                <th>Kelamin</th>
                                <th>Alamat</th>
                                <th class="text-center">RT</th>
                                <th class="text-center">RW</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($master_kartukeluarga as $a)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="text-muted small">{{ $a->kecamatan }}</td>
                                <td class="text-muted small">{{ $a->desa }}</td>
                                <td><code class="fw-bold text-primary" style="font-size:.78rem;">{{ $a->no_kk }}</code></td>
                                <td><code class="fw-bold" style="font-size:.78rem;">{{ $a->nik ?? '-' }}</code></td>
                                <td class="fw-semibold text-dark">{{ $a->nama_lengkap ?? '-' }}</td>
                                <td class="text-muted small">{{ $a->tempat_lahir ?? '-' }}</td>
                                <td class="text-muted small">
                                    {{ $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->format('d/m/Y') : '-' }}
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border" style="font-size:.72rem;">
                                        {{ $a->status_perkawinan ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if($a->jenis_kelamin == 'Laki-laki' || $a->jenis_kelamin == 'LAKI-LAKI')
                                        <span class="badge badge-kelamin-l" style="font-size:.72rem;">L</span>
                                    @elseif($a->jenis_kelamin == 'Perempuan' || $a->jenis_kelamin == 'PEREMPUAN')
                                        <span class="badge badge-kelamin-p" style="font-size:.72rem;">P</span>
                                    @else
                                        <span class="badge bg-light text-muted border" style="font-size:.72rem;">{{ $a->jenis_kelamin ?? '-' }}</span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $a->alamat }}</td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $a->rt }}</span></td>
                                <td class="text-center"><span class="badge bg-light text-dark border">{{ $a->rw }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center py-4 text-muted">Belum ada data penduduk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $master_kartukeluarga->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

