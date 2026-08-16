@extends('admin.layout.main')
@section('title', 'Master Akun Kepala Dusun')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0,0,0,0.03) !important; background: #fff; }
    .table-modern { border-collapse: separate !important; border-spacing: 0 6px !important; }
    .table-modern thead th { background: #f8fafc !important; color: #475569 !important; font-weight: 600 !important; text-transform: uppercase !important; font-size: .75rem !important; letter-spacing: .6px !important; border-bottom: 2px solid #e2e8f0 !important; padding: 14px 16px !important; }
    .table-modern tbody tr { background: #fff !important; box-shadow: 0 2px 6px rgba(0,0,0,.02); border-radius: 10px !important; }
    .table-modern tbody td { padding: 14px 16px !important; vertical-align: middle !important; border-top: 1px solid #f1f5f9 !important; font-size: .88rem !important; }
    .btn-rounded { border-radius: 30px !important; }
    .action-group { display: flex; align-items: center; justify-content: center; gap: 6px; }
    .btn-icon { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50% !important; padding: 0 !important; font-size: 0.8rem; }
    .badge-kadus { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
</style>
@endpush

@section('content')

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Master Akun Kepala Dusun</h1>
            <p class="text-muted small mb-0">Kelola akun akses sistem untuk para Kepala Dusun Desa Rambipuji.</p>
        </div>
    </div>

    @if(session('success'))
        <div id="alertPopup" class="alert alert-success alert-floating">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-floating">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card card-modern">

                    <!-- CARD HEADER -->
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex justify-content-between w-100 align-items-center flex-wrap gap-2">

                            <!-- PENCARIAN -->
                            <form class="d-flex" action="{{ route('akunkadus.index') }}" method="get">
                                <input class="form-control me-2 rounded-pill px-3" type="search" name="katakunci"
                                    value="{{ Request::get('katakunci') }}"
                                    placeholder="Cari NIK / Nama / Email">
                                <button class="btn btn-primary btn-rounded px-4"><i class="bi bi-search me-1"></i> Cari</button>
                            </form>

                            <!-- TOMBOL TAMBAH -->
                            <div>
                                <button type="button" class="btn btn-primary btn-rounded px-4" data-bs-toggle="modal" data-bs-target="#modalTambahKadus">
                                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Akun Kasun
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- CARD BODY / TABEL -->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-modern w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px;">No</th>
                                        <th>NIK</th>
                                        <th>Nama Kepala Dusun</th>
                                        <th>Email</th>
                                        <th>No. HP</th>
                                        <th class="text-center">Peran</th>
                                        <th class="text-center" style="width:120px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataakun as $a)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                        <td><code class="fw-bold text-primary">{{ $a->nik }}</code></td>
                                        <td class="fw-semibold text-dark">{{ $a->nama_lengkap ?? '-' }}</td>
                                        <td class="text-muted small">{{ $a->email }}</td>
                                        <td class="text-muted small">{{ $a->no_hp }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-kadus">Kepala Dusun</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-group">
                                                <!-- EDIT -->
                                                <button type="button"
                                                    class="btn btn-warning btn-icon btnEditKadus"
                                                    title="Edit Akun"
                                                    data-id="{{ $a->id }}"
                                                    data-nik="{{ $a->nik }}"
                                                    data-nama="{{ $a->nama_lengkap }}"
                                                    data-email="{{ $a->email }}"
                                                    data-no_hp="{{ $a->no_hp }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>

                                                <!-- HAPUS -->
                                                <form id="formHapus{{ $a->id }}" action="{{ route('akunkadus.destroy', $a->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-danger btn-icon btnDeleteKadus"
                                                        title="Hapus Akun"
                                                        data-nama="{{ $a->nama_lengkap ?? $a->nik }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Belum ada akun Kepala Dusun terdaftar.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="mt-3">
                            {{ $dataakun->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL TAMBAH AKUN KASUN -->
<div class="modal fade" id="modalTambahKadus" tabindex="-1" aria-labelledby="modalTambahKadusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('akunkadus.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTambahKadusLabel">Tambah Akun Kepala Dusun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Pilih NIK / Nama Penduduk <span class="text-danger">*</span></label>
                        <select class="form-select select2 w-100" name="nik" required style="width: 100% !important;">
                            <option value="">-- Pilih Kepala Dusun --</option>
                            @foreach($datapenduduk as $p)
                                <option value="{{ $p->nik }}" {{ old('nik') == $p->nik ? 'selected' : '' }}>
                                    {{ $p->nik }} - {{ $p->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Email Login <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="kasun@desa.id">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nomor HP / WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" required placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Password Login <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" required placeholder="Minimal 6 karakter">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT AKUN KASUN -->
<div class="modal fade" id="modalEditKadus" tabindex="-1" aria-labelledby="modalEditKadusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEditKadus" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalEditKadusLabel">Edit Akun Kepala Dusun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nama Kepala Dusun</label>
                        <input type="text" class="form-control bg-light" id="editNama" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Email Login <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="editEmail" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nomor HP / WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="no_hp" id="editNoHp" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Password Baru <span class="text-muted fw-normal">(Biarkan kosong jika tidak diubah)</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak diganti">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Edit Modal Trigger
    $('.btnEditKadus').on('click', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const email = $(this).data('email');
        const noHp = $(this).data('no_hp');

        $('#formEditKadus').attr('action', '/admin/akunkadus/' + id);
        $('#editNama').val(nama);
        $('#editEmail').val(email);
        $('#editNoHp').val(noHp);

        const modal = new bootstrap.Modal(document.getElementById('modalEditKadus'));
        modal.show();
    });

    // Delete Confirmation
    $('.btnDeleteKadus').on('click', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        const nama = $(this).data('nama');

        Swal.fire({
            title: 'Hapus Akun?',
            text: 'Akun Kepala Dusun "' + nama + '" akan dihapus dari sistem!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush

@endsection
