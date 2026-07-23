@extends('admin.layout.main')
@section('title', 'Surat Masuk Kepala Dusun')

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
.badge-diajukan{background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;font-weight:600;padding:5px 12px;border-radius:20px;font-size:.78rem}
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Surat Masuk Kepala Dusun</h1>
            <p class="text-muted small mb-0">Daftar pengajuan surat warga yang menunggu persetujuan Anda.</p>
        </div>
        <a href="{{ route('kadus.tambahpengajuan.index') }}" class="btn btn-primary btn-rounded px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Ajukan Surat untuk Warga
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-inbox-fill text-primary me-2"></i>Pengajuan Masuk — Status: Diajukan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableKadus">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th>Nomor Pengajuan</th>
                                <th>Nama Pemohon</th>
                                <th>NIK</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:190px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $dummy = [
                                ['id'=>1,'no'=>'PGJ-202607-001','nama'=>'Budi Santoso','nik'=>'3509121508900001','surat'=>'Surat Keterangan Domisili','tgl'=>'23 Jul 2026','status'=>'Diajukan','alamat'=>'Dsn. Krajan RT 002/005','no_hp'=>'081234567890','keperluan'=>'Pembukaan Rekening Bank BRI','lampiran'=>['KTP Asli','Kartu Keluarga']],
                                ['id'=>2,'no'=>'PGJ-202607-002','nama'=>'Siti Aminah','nik'=>'3509125211950003','surat'=>'Surat Keterangan Tidak Mampu (SKTM)','tgl'=>'23 Jul 2026','status'=>'Diajukan','alamat'=>'Dsn. Rambie RT 001/002','no_hp'=>'085790123456','keperluan'=>'Pengajuan Beasiswa KIP','lampiran'=>['KTP Asli','KK','Surat Pengantar RT']],
                                ['id'=>3,'no'=>'PGJ-202607-003','nama'=>'Ahmad Fauzi','nik'=>'3509121004880002','surat'=>'Surat Keterangan Usaha (SKU)','tgl'=>'22 Jul 2026','status'=>'Diajukan','alamat'=>'Dsn. Gudang RT 004/001','no_hp'=>'082143658709','keperluan'=>'Permohonan KUR BNI','lampiran'=>['KTP Asli','Foto Usaha']],
                            ];
                            @endphp
                            @foreach($dummy as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $i+1 }}</td>
                                <td><span class="fw-bold text-primary" style="font-size:.82rem">{{ $r['no'] }}</span></td>
                                <td class="fw-semibold text-dark">{{ $r['nama'] }}</td>
                                <td><code style="font-size:.8rem">{{ $r['nik'] }}</code></td>
                                <td><span class="badge bg-light text-dark border fw-medium">{{ $r['surat'] }}</span></td>
                                <td class="text-muted">{{ $r['tgl'] }}</td>
                                <td class="text-center"><span class="badge-diajukan">{{ $r['status'] }}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $r['id'] }}"><i class="bi bi-eye-fill"></i> Detail</button>
                                    <button class="btn btn-sm btn-success btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalSetujui-{{ $r['id'] }}"><i class="bi bi-check-lg"></i> Setujui</button>
                                    <button class="btn btn-sm btn-danger btn-rounded px-2" data-bs-toggle="modal" data-bs-target="#modalTolak-{{ $r['id'] }}"><i class="bi bi-x-lg"></i> Tolak</button>
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

{{-- ============ MODALS ============ --}}
@foreach($dummy as $r)

{{-- MODAL DETAIL --}}
<div class="modal fade" id="modalDetail-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-text-fill me-2"></i>Detail Pengajuan — {{ $r['no'] }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background:#f8fafc">
                <div class="row g-3 mb-3">
                    {{-- Data Pemohon --}}
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-person-badge-fill me-2"></i>Data Pemohon</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Nama Lengkap</span><strong>{{ $r['nama'] }}</strong></div>
                            <div class="mb-2"><span class="text-muted small d-block">NIK</span><code>{{ $r['nik'] }}</code></div>
                            <div class="mb-2"><span class="text-muted small d-block">Alamat</span><span>{{ $r['alamat'] }}</span></div>
                            <div><span class="text-muted small d-block">No. HP / WA</span><span class="text-success fw-semibold"><i class="bi bi-whatsapp me-1"></i>{{ $r['no_hp'] }}</span></div>
                        </div>
                    </div>
                    {{-- Data Surat --}}
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-file-earmark-richtext-fill me-2"></i>Data Surat</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Jenis Surat</span><span class="badge bg-primary fw-medium px-2 py-1">{{ $r['surat'] }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Keperluan</span><span class="fw-medium">{{ $r['keperluan'] }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Tanggal Pengajuan</span><span class="fw-medium"><i class="bi bi-calendar-event text-primary me-1"></i>{{ $r['tgl'] }}</span></div>
                            <div>
                                <span class="text-muted small d-block mb-1">Lampiran Berkas</span>
                                @foreach($r['lampiran'] as $l)
                                <span class="badge bg-light text-dark border me-1 mb-1"><i class="bi bi-paperclip me-1"></i>{{ $l }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Timeline Persetujuan --}}
                <div class="card border-0 shadow-sm rounded-3 p-3">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-clock-history me-2"></i>Riwayat Persetujuan</h6>
                    <div class="position-relative" style="padding-left:28px;border-left:2px solid #e2e8f0">
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">Diajukan</span>
                            <small class="text-muted">{{ $r['tgl'] }} — Pengajuan masuk dari warga/Kepala Dusun</small>
                        </div>
                        <div class="mb-1 position-relative opacity-50">
                            <div class="position-absolute rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-dash-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-muted d-block">Verifikasi Kepala Dusun</span>
                            <small class="text-muted">Menunggu tindakan Anda</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalTolak-{{ $r['id'] }}"><i class="bi bi-x-circle-fill me-1"></i>Tolak</button>
                <button type="button" class="btn btn-success btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalSetujui-{{ $r['id'] }}"><i class="bi bi-check-circle-fill me-1"></i>Setujui</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL SETUJUI --}}
<div class="modal fade" id="modalSetujui-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 text-center p-3">
            <div class="modal-body p-4">
                <div class="text-success mb-3"><i class="bi bi-check-circle-fill" style="font-size:3.5rem"></i></div>
                <h4 class="fw-bold text-dark mb-2">Setujui Surat Ini?</h4>
                <p class="text-muted">Surat akan diteruskan ke <strong>Admin Desa</strong> untuk diverifikasi lebih lanjut.</p>
                <div class="card bg-light border-0 rounded-3 p-3 mb-3 text-start small">
                    <div><strong>Nomor:</strong> {{ $r['no'] }}</div>
                    <div><strong>Pemohon:</strong> {{ $r['nama'] }}</div>
                    <div><strong>Jenis Surat:</strong> {{ $r['surat'] }}</div>
                </div>
                <div class="d-flex justify-content-center gap-2 mt-4">
                    <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success btn-rounded px-5 btn-aksi-setujui" data-id="{{ $r['id'] }}" data-bs-dismiss="modal">
                        <i class="bi bi-check-lg me-1"></i>Setujui
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div class="modal fade" id="modalTolak-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger"><i class="bi bi-x-circle-fill me-2"></i>Tolak Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <p class="text-muted small mb-3">Nomor: <strong>{{ $r['no'] }}</strong> — Pemohon: <strong>{{ $r['nama'] }}</strong></p>
                <label class="form-label fw-semibold">Alasan Penolakan <span class="text-danger">*</span></label>
                <textarea class="form-control rounded-3" id="alasan-{{ $r['id'] }}" rows="4" placeholder="Masukkan alasan penolakan yang jelas..." required></textarea>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-rounded px-4 btn-aksi-tolak" data-id="{{ $r['id'] }}" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i>Tolak Pengajuan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#tableKadus').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
        pageLength: 10, responsive: true,
        columnDefs: [{ orderable: false, targets: 7 }]
    });

    $(document).on('click', '.btn-aksi-setujui', function () {
        Swal.fire({ title: 'Surat Disetujui!', text: 'Pengajuan telah diteruskan ke Admin Desa.', icon: 'success', confirmButtonColor: '#16a34a', customClass: { popup: 'rounded-4' } });
    });

    $(document).on('click', '.btn-aksi-tolak', function () {
        const id = $(this).data('id');
        const alasan = $('#alasan-' + id).val();
        if (!alasan.trim()) {
            Swal.fire({ title: 'Alasan Wajib Diisi!', text: 'Mohon isi alasan penolakan sebelum melanjutkan.', icon: 'warning', confirmButtonColor: '#dc3545', customClass: { popup: 'rounded-4' } });
            return;
        }
        Swal.fire({ title: 'Pengajuan Ditolak', text: 'Catatan penolakan telah disimpan.', icon: 'warning', confirmButtonColor: '#dc3545', customClass: { popup: 'rounded-4' } });
    });
});
</script>
@endpush
@endsection
