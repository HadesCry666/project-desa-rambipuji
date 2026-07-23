@extends('admin.layout.main')
@section('title', 'Master Pengaduan Admin')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03) !important; background: #ffffff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 6px !important; }
    .table-modern thead th { background-color: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: 0.75rem !important; letter-spacing: 0.6px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 14px 16px !important; }
    .table-modern tbody tr { background-color: #ffffff !important; box-shadow: 0 2px 6px rgba(0,0,0,0.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 14px 16px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: 0.88rem !important; }
    .btn-rounded { border-radius: 30px !important; }
    .action-btn-group { display: flex; align-items: center; justify-content: center; gap: 6px; }
</style>
@endpush

@section('content')

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Master Pengaduan Masyarakat</h1>
            <p class="text-muted small mb-0">Kelola dan tanggapi laporan serta pengaduan warga Desa Rambipuji.</p>
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
            <!-- HEADER SEARCH & SORT -->
            <div class="card-header bg-white py-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <form class="d-flex" action="{{ route('master-pengaduan.index') }}" method="get" id="searchForm">
                    <input class="form-control me-2 rounded-pill px-3" type="search" name="katakunci" placeholder="Cari NIK / Nama / Kategori / Ulasan..." value="{{ Request::get('katakunci') }}">
                    <input type="hidden" name="sort" value="{{ Request::get('sort', 'terbaru') }}">
                    <button class="btn btn-primary btn-rounded px-4" type="submit">Cari</button>
                </form>

                <div class="btn-group">
                    <a href="{{ route('master-pengaduan.index', array_merge(request()->query(), ['sort' => 'terbaru'])) }}"
                       class="btn btn-sm btn-rounded px-3 {{ Request::get('sort', 'terbaru') == 'terbaru' ? 'btn-primary' : 'btn-outline-primary' }}"
                       title="Urutkan Terbaru">
                        <i class="fas fa-arrow-down me-1"></i> Terbaru
                    </a>
                    <a href="{{ route('master-pengaduan.index', array_merge(request()->query(), ['sort' => 'terlama'])) }}"
                       class="btn btn-sm btn-rounded px-3 {{ Request::get('sort') == 'terlama' ? 'btn-primary' : 'btn-outline-primary' }}"
                       title="Urutkan Terlama">
                        <i class="fas fa-arrow-up me-1"></i> Terlama
                    </a>
                </div>
            </div>

            <!-- BODY TABLE -->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-modern w-100">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>NIK Pemohon</th>
                                <th>Nama Pelapor</th>
                                <th>Kategori</th>
                                <th>Ulasan Pengaduan</th>
                                <th>Status / Feedback</th>
                                <th class="text-center" style="width: 250px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduan as $i => $item)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $pengaduan->firstItem() + $i }}</td>
                                <td><code>{{ $item->nik }}</code></td>
                                <td class="fw-semibold text-dark">{{ $item->penduduk->nama_lengkap ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary fw-medium px-3 py-1 rounded-pill">
                                        {{ $item->kategori ?? 'Umum' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        {{ \Illuminate\Support\Str::words(strip_tags($item->ulasan), 12, '...') }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->feedback)
                                        <span class="text-success small fw-semibold">
                                            <i class="bi bi-check-circle-fill me-1"></i> {{ Str::limit($item->feedback, 30) }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning fw-normal px-2 py-1">
                                            Belum Ada Feedback
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-btn-group">
                                        <!-- TOMBOL LIHAT DETAIL -->
                                        <button class="btn btn-sm btn-info btn-rounded px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#lihatModal{{ $item->id }}"
                                                title="Lihat Detail">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </button>

                                        <!-- TOMBOL TANGGAPI -->
                                        <button class="btn btn-sm btn-primary btn-rounded px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#feedbackModal{{ $item->id }}"
                                                title="Kirim Feedback">
                                            <i class="fas fa-comment-dots me-1"></i> Tanggapi
                                        </button>

                                        <!-- TOMBOL HAPUS -->
                                        <form action="{{ route('master-pengaduan.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              id="formHapus{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-sm btn-danger btn-rounded px-3 btnHapus"
                                                    data-id="{{ $item->id }}"
                                                    data-nama="{{ $item->penduduk->nama_lengkap ?? 'Pengaduan' }}"
                                                    title="Hapus Pengaduan">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Tidak ada data pengaduan masyarakat.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $pengaduan->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODALS SECTION -->
@foreach($pengaduan as $item)

<!-- MODAL DETAIL -->
<div class="modal fade" id="lihatModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-file-earmark-text-fill me-2"></i>Detail Pengaduan Masyarakat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background-color: #f8fafc;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small mb-1">NIK Pemohon</label>
                        <input type="text" class="form-control rounded-3 bg-white fw-bold text-primary" value="{{ $item->nik }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small mb-1">Nama Lengkap Pelapor</label>
                        <input type="text" class="form-control rounded-3 bg-white fw-bold text-dark" value="{{ $item->penduduk->nama_lengkap ?? '-' }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted small mb-1">Kategori Pengaduan</label>
                        <div>
                            <span class="badge bg-primary text-white px-3 py-2 fs-6 rounded-pill">
                                {{ $item->kategori ?? 'Umum' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted small mb-1">Ulasan / Laporan Lengkap</label>
                        <div class="p-3 bg-white rounded-3 border text-dark shadow-sm">
                            {{ $item->ulasan }}
                        </div>
                    </div>
                    @if($item->feedback)
                    <div class="col-12">
                        <label class="form-label text-muted small mb-1">Feedback / Respon Resmi Desa</label>
                        <div class="p-3 bg-success-subtle rounded-3 border border-success text-success fw-medium">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ $item->feedback }}
                        </div>
                    </div>
                    @endif
                    <div class="col-12 text-center mt-3">
                        @if($item->foto1 && file_exists(storage_path('app/public/'.$item->foto1)))
                            <label class="form-label text-muted small d-block mb-2">Foto Lampiran</label>
                            <img src="{{ asset('storage/'.$item->foto1) }}" class="img-fluid rounded-3 shadow-sm border" style="max-height:280px; object-fit: cover;">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FEEDBACK -->
<div class="modal fade" id="feedbackModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <form action="{{ route('pengaduan.feedback', $item->id) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">
                        <i class="bi bi-reply-fill me-2"></i>Tanggapi Pengaduan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="mb-3">
                        <label class="form-label text-muted small mb-1">Laporan dari {{ $item->penduduk->nama_lengkap ?? 'Warga' }}</label>
                        <div class="p-3 bg-light rounded-3 small text-dark border">{{ $item->ulasan }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Feedback / Tanggapan Resmi</label>
                        <textarea name="feedback" class="form-control rounded-3" rows="4" placeholder="Tuliskan jawaban atau langkah tindak lanjut desa..." required>{{ old('feedback', $item->feedback ?? '') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-rounded px-4">Kirim Feedback</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const hapusButtons = document.querySelectorAll('.btnHapus');

    hapusButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.dataset.id;
            const nama = this.dataset.nama || 'pengaduan ini';

            Swal.fire({
                title: 'Hapus Pengaduan?',
                text: 'Data pengaduan atas nama "' + nama + '" akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-4' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formHapus' + id).submit();
                }
            });
        });
    });

    // Auto-search logic
    const searchInput = document.querySelector('input[name="katakunci"]');
    const searchForm = document.getElementById('searchForm');
    if (searchInput && searchForm) {
        let timeout = null;
        searchInput.addEventListener('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                searchForm.submit();
            }, 600);
        });
    }
});
</script>
@endpush
@endsection