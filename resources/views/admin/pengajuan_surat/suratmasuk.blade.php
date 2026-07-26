@extends('admin.layout.main')
@section('title', 'Surat Masuk Admin — Verifikasi')

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
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Surat Masuk — Verifikasi Admin</h1>
            <p class="text-muted small mb-0">Surat yang telah disetujui Kepala Dusun dan menunggu verifikasi Admin.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-inbox-fill text-primary me-2"></i>Pengajuan Masuk — Status: Disetujui Kepala Dusun</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableAdminSuratMasuk">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th>Nama Pemohon</th>
                                <th>NIK</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:190px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datapengajuan as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ $r->nama_lengkap }}</td>
                                <td><code style="font-size:.8rem">{{ $r->nik }}</code></td>
                                <td><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $r->nama_surat }}</span></td>
                                <td class="text-muted">{{ $r->tanggal_diajukan ?? $r->created_at }}</td>
                                <td class="text-center">
                                    @if($r->status == 'Disetujui Kepala Dusun')
                                        <span class="badge-kadus">✓ Disetujui Kadus</span>
                                    @else
                                        <span class="badge-diajukan">{{ $r->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalDetailAdmin-{{ $r->id_pengajuan }}"><i class="bi bi-eye-fill"></i> Detail</button>
                                    <button class="btn btn-sm btn-success btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalSetujuiAdmin-{{ $r->id_pengajuan }}"><i class="bi bi-check-lg"></i> Setujui</button>
                                    <button class="btn btn-sm btn-danger btn-rounded px-2" data-bs-toggle="modal" data-bs-target="#modalTolakAdmin-{{ $r->id_pengajuan }}"><i class="bi bi-x-lg"></i> Tolak</button>
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
                <div class="mt-3">
                    {{ $datapengajuan->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ MODALS ============ --}}
@foreach($datapengajuan as $r)

{{-- MODAL DETAIL ADMIN --}}
<div class="modal fade" id="modalDetailAdmin-{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-text-fill me-2"></i>Detail Pengajuan — {{ $r->nama_surat }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background:#f8fafc">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-person-badge-fill me-2"></i>Data Pemohon</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Nama Lengkap</span><strong>{{ $r->nama_lengkap }}</strong></div>
                            <div class="mb-2"><span class="text-muted small d-block">NIK</span><code>{{ $r->nik }}</code></div>
                            <div class="mb-2"><span class="text-muted small d-block">Alamat</span><span>{{ $r->alamat }} RT {{ $r->rt }} / RW {{ $r->rw }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-file-earmark-richtext-fill me-2"></i>Data Surat</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Jenis Surat</span><span class="badge bg-primary">{{ $r->nama_surat }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Keperluan</span><span>{{ $r->keperluan }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Tanggal Pengajuan</span><span class="fw-medium"><i class="bi bi-calendar-event text-primary me-1"></i>{{ $r->tanggal_diajukan ?? $r->created_at }}</span></div>
                            <div><span class="text-muted small d-block mb-1">Lampiran Foto</span>
                                @for($f=1; $f<=8; $f++)
                                    @php $foto = 'foto'.$f; @endphp
                                    @if(!empty($r->$foto))
                                        <a href="{{ asset($r->$foto) }}" target="_blank" class="badge bg-light text-dark border me-1 mb-1 text-decoration-none">
                                            <i class="bi bi-image me-1"></i>Foto {{ $f }}
                                        </a>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                @if(!empty($r->keterangan_admin))
                <div class="card border-info border-opacity-50 shadow-sm rounded-3 p-3 mb-3">
                    <h6 class="fw-bold text-info border-bottom pb-2 mb-2"><i class="bi bi-chat-left-text-fill me-2"></i>Keterangan Admin</h6>
                    <p class="mb-0 text-dark">{{ $r->keterangan_admin }}</p>
                </div>
                @endif

                {{-- Riwayat Timeline --}}
                <div class="card border-0 shadow-sm rounded-3 p-3">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-clock-history me-2"></i>Riwayat Persetujuan</h6>
                    <div class="position-relative" style="padding-left:28px;border-left:2px solid #e2e8f0">
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">Diajukan</span>
                            <small class="text-muted">{{ $r->tanggal_diajukan ?? $r->created_at }}</small>
                        </div>
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-info d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">Disetujui Kepala Dusun</span>
                            <small class="text-muted">Diteruskan ke Admin Desa</small>
                        </div>
                        <div class="mb-1 position-relative opacity-50">
                            <div class="position-absolute rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-dash-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-muted d-block">Verifikasi Admin</span>
                            <small class="text-muted">Menunggu tindakan Anda</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalTolakAdmin-{{ $r->id_pengajuan }}"><i class="bi bi-x-circle-fill me-1"></i>Tolak</button>
                <button type="button" class="btn btn-success btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalSetujuiAdmin-{{ $r->id_pengajuan }}"><i class="bi bi-check-circle-fill me-1"></i>Setujui</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL SETUJUI ADMIN — WAJIB ISI KETERANGAN --}}
<div class="modal fade" id="modalSetujuiAdmin-{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form action="{{ route('pengajuan.setuju', $r->id_pengajuan) }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white py-3 px-4">
                    <h5 class="modal-title fw-bold"><i class="bi bi-check-circle-fill me-2"></i>Setujui & Berikan Keterangan Verifikasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" style="background:#f8fafc">
                    <div class="card border-0 shadow-sm rounded-3 p-3 mb-4">
                        <div class="row g-2">
                            <div class="col-6"><span class="text-muted small d-block">Pemohon</span><strong>{{ $r->nama_lengkap }}</strong></div>
                            <div class="col-6"><span class="text-muted small d-block">NIK</span><code>{{ $r->nik }}</code></div>
                            <div class="col-12"><span class="text-muted small d-block">Jenis Surat</span><span class="badge bg-primary">{{ $r->nama_surat }}</span></div>
                        </div>
                    </div>

                    {{-- KETERANGAN ADMIN — WAJIB --}}
                    <div class="card border-warning border-opacity-50 rounded-3 p-3 mb-3">
                        <h6 class="fw-bold text-warning mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Keterangan Admin <span class="text-danger">*</span></h6>
                        <p class="text-muted small mb-3">Wajib diisi sebelum surat dapat diteruskan ke Sekretaris Desa.</p>
                        
                        {{-- Pilihan Cepat --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-muted">Pilihan Cepat:</label>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-primary border border-primary keterangan-preset px-3 py-2" data-target="keterangan-{{ $r->id_pengajuan }}" data-text="Berkas telah lengkap dan sesuai persyaratan.">Berkas Lengkap</span>
                                <span class="badge bg-light text-primary border border-primary keterangan-preset px-3 py-2" data-target="keterangan-{{ $r->id_pengajuan }}" data-text="Persyaratan administrasi telah sesuai dengan ketentuan yang berlaku.">Persyaratan Sesuai</span>
                                <span class="badge bg-light text-primary border border-primary keterangan-preset px-3 py-2" data-target="keterangan-{{ $r->id_pengajuan }}" data-text="Data pemohon telah diverifikasi dan sesuai dengan catatan kependudukan desa.">Data Terverifikasi</span>
                            </div>
                        </div>
                        <textarea class="form-control rounded-3" id="keterangan-{{ $r->id_pengajuan }}" name="keterangan_admin" rows="4" placeholder="Tuliskan keterangan hasil verifikasi Anda di sini..." required></textarea>
                    </div>

                    <div class="alert alert-info border-0 rounded-3 py-2 px-3 small mb-0">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        Setelah disetujui, surat akan otomatis diteruskan ke <strong>Sekretaris Desa</strong>.
                    </div>
                </div>
                <div class="modal-footer bg-white py-3 px-4">
                    <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-rounded px-5">
                        <i class="bi bi-check-circle-fill me-1"></i>Setujui & Teruskan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL TOLAK ADMIN --}}
<div class="modal fade" id="modalTolakAdmin-{{ $r->id_pengajuan }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <form action="{{ route('pengajuan.tolak', $r->id_pengajuan) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger"><i class="bi bi-x-circle-fill me-2"></i>Tolak Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <p class="text-muted small mb-3">Pemohon: <strong>{{ $r->nama_lengkap }}</strong> ({{ $r->nama_surat }})</p>
                    <label class="form-label fw-semibold">Alasan Penolakan <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-3" name="keterangan_ditolak" rows="4" placeholder="Tuliskan alasan penolakan..." required></textarea>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-rounded px-4">
                            <i class="bi bi-x-lg me-1"></i>Tolak
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $('#tableAdminSuratMasuk').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
        pageLength: 10, responsive: true,
        columnDefs: [{ orderable: false, targets: 6 }]
    });

    $(document).on('click', '.keterangan-preset', function () {
        const targetId = $(this).data('target');
        const text = $(this).data('text');
        $('#' + targetId).val(text);
    });
});
</script>
@endpush
@endsection