@extends('admin.layout.main')
@section('title', 'Surat Masuk — Kepala Desa')

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
.badge-sekdes{background:#f3e8ff;color:#7e22ce;border:1px solid #d8b4fe;font-weight:600;padding:5px 12px;border-radius:20px;font-size:.78rem}
.tte-box{background:linear-gradient(135deg,#0057A6 0%,#0284c7 100%);color:#fff;border-radius:12px;padding:16px;}
</style>
@endpush

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Surat Masuk — Kepala Desa</h1>
            <p class="text-muted small mb-0">Surat yang telah disetujui Sekretaris Desa dan siap untuk pengesahan Tanda Tangan Digital (TTE).</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="section-body">
        <div class="card card-modern">
            <div class="card-header bg-white py-3 border-bottom-0 d-flex align-items-center">
                <h4 class="fw-bold text-dark m-0"><i class="bi bi-inbox-fill text-primary me-2"></i>Pengajuan Masuk — Status: Disetujui Sekretaris Desa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-modern w-100" id="tableKadesSuratMasuk">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">No</th>
                                <th>Nomor Pengajuan</th>
                                <th>Nama Pemohon</th>
                                <th>NIK</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Pengajuan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:210px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $dummy = [
                                [
                                    'id'=>1,'no'=>'PGJ-202607-001','nama'=>'Budi Santoso','nik'=>'3509121508900001',
                                    'surat'=>'Surat Keterangan Domisili','tgl'=>'23 Jul 2026','status'=>'Disetujui Sekretaris Desa',
                                    'alamat'=>'Dsn. Krajan RT 002/005','no_hp'=>'081234567890','keperluan'=>'Pembukaan Rekening Bank BRI',
                                    'lampiran'=>['KTP Asli','Kartu Keluarga'],
                                    'ket_admin'=>'Berkas lengkap dan telah diverifikasi sesuai data kependudukan.',
                                    'tgl_kadus'=>'23 Jul 2026, 09.30', 'tgl_admin'=>'23 Jul 2026, 11.15', 'tgl_sekdes'=>'23 Jul 2026, 14.20'
                                ],
                                [
                                    'id'=>2,'no'=>'PGJ-202607-002','nama'=>'Siti Aminah','nik'=>'3509125211950003',
                                    'surat'=>'Surat Keterangan Tidak Mampu (SKTM)','tgl'=>'23 Jul 2026','status'=>'Disetujui Sekretaris Desa',
                                    'alamat'=>'Dsn. Rambie RT 001/002','no_hp'=>'085790123456','keperluan'=>'Pengajuan Beasiswa KIP',
                                    'lampiran'=>['KTP Asli','KK','Surat Pengantar RT'],
                                    'ket_admin'=>'Persyaratan administrasi beasiswa telah sesuai.',
                                    'tgl_kadus'=>'23 Jul 2026, 10.15', 'tgl_admin'=>'23 Jul 2026, 13.00', 'tgl_sekdes'=>'23 Jul 2026, 15.10'
                                ],
                            ];
                            @endphp

                            @foreach($dummy as $i => $r)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $i+1 }}</td>
                                <td><span class="fw-bold text-primary" style="font-size:.82rem">{{ $r['no'] }}</span></td>
                                <td class="fw-semibold text-dark">{{ $r['nama'] }}</td>
                                <td><code style="font-size:.8rem">{{ $r['nik'] }}</code></td>
                                <td><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $r['surat'] }}</span></td>
                                <td class="text-muted">{{ $r['tgl'] }}</td>
                                <td class="text-center"><span class="badge-sekdes">✓ Disetujui Sekdes</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalDetailKades-{{ $r['id'] }}"><i class="bi bi-eye-fill"></i> Detail</button>
                                    <button class="btn btn-sm btn-primary btn-rounded px-2 me-1" data-bs-toggle="modal" data-bs-target="#modalSetujuiKades-{{ $r['id'] }}"><i class="bi bi-shield-check me-1"></i>Setujui & TTE</button>
                                    <button class="btn btn-sm btn-danger btn-rounded px-2" data-bs-toggle="modal" data-bs-target="#modalTolakKades-{{ $r['id'] }}"><i class="bi bi-x-lg"></i> Tolak</button>
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

{{-- MODAL DETAIL KADES --}}
<div class="modal fade" id="modalDetailKades-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-file-earmark-text-fill me-2"></i>Detail Pengajuan Surat — {{ $r['no'] }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background:#f8fafc">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-person-badge-fill me-2"></i>Data Pemohon</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Nama Lengkap</span><strong>{{ $r['nama'] }}</strong></div>
                            <div class="mb-2"><span class="text-muted small d-block">NIK</span><code>{{ $r['nik'] }}</code></div>
                            <div class="mb-2"><span class="text-muted small d-block">Alamat</span><span>{{ $r['alamat'] }}</span></div>
                            <div><span class="text-muted small d-block">No. HP</span><span class="text-success fw-semibold"><i class="bi bi-whatsapp me-1"></i>{{ $r['no_hp'] }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-file-earmark-richtext-fill me-2"></i>Data Surat</h6>
                            <div class="mb-2"><span class="text-muted small d-block">Jenis Surat</span><span class="badge bg-primary">{{ $r['surat'] }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Keperluan</span><span>{{ $r['keperluan'] }}</span></div>
                            <div class="mb-2"><span class="text-muted small d-block">Tanggal Pengajuan</span><span class="fw-medium"><i class="bi bi-calendar-event text-primary me-1"></i>{{ $r['tgl'] }}</span></div>
                            <div><span class="text-muted small d-block mb-1">Lampiran</span>
                                @foreach($r['lampiran'] as $l)<span class="badge bg-light text-dark border me-1 mb-1"><i class="bi bi-paperclip me-1"></i>{{ $l }}</span>@endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KETERANGAN ADMIN CARD --}}
                <div class="card border-purple border-opacity-50 bg-light rounded-3 p-3 mb-3" style="border-left:4px solid #7e22ce!important;">
                    <h6 class="fw-bold text-purple mb-1" style="color:#7e22ce"><i class="bi bi-chat-quote-fill me-2"></i>Keterangan Admin Desa</h6>
                    <p class="mb-0 text-dark fw-medium" style="font-size:.9rem">"{{ $r['ket_admin'] }}"</p>
                </div>

                {{-- Riwayat Timeline Lengkap --}}
                <div class="card border-0 shadow-sm rounded-3 p-3">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3"><i class="bi bi-clock-history me-2"></i>Seluruh Riwayat Persetujuan</h6>
                    <div class="position-relative" style="padding-left:28px;border-left:2px solid #e2e8f0">
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">1. Diajukan</span>
                            <small class="text-muted">{{ $r['tgl'] }}</small>
                        </div>
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-info d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">2. Disetujui Kepala Dusun</span>
                            <small class="text-muted">{{ $r['tgl_kadus'] }}</small>
                        </div>
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-warning d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">3. Disetujui Admin Desa</span>
                            <small class="text-muted">{{ $r['tgl_admin'] }}</small>
                        </div>
                        <div class="mb-3 position-relative">
                            <div class="position-absolute rounded-circle bg-purple d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px;background:#7e22ce"><i class="bi bi-check-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-dark d-block">4. Disetujui Sekretaris Desa</span>
                            <small class="text-muted">{{ $r['tgl_sekdes'] }}</small>
                        </div>
                        <div class="mb-1 position-relative opacity-50">
                            <div class="position-absolute rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width:22px;height:22px;left:-39px;top:2px"><i class="bi bi-dash-lg text-white" style="font-size:.7rem"></i></div>
                            <span class="fw-bold text-muted d-block">5. Persetujuan Kepala Desa & TTE</span>
                            <small class="text-muted">Menunggu tindakan Anda</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalTolakKades-{{ $r['id'] }}"><i class="bi bi-x-circle-fill me-1"></i>Tolak</button>
                <button type="button" class="btn btn-primary btn-rounded px-4" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalSetujuiKades-{{ $r['id'] }}"><i class="bi bi-shield-check me-1"></i>Setujui & TTE</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL SETUJUI KEPALA DESA (TTE) --}}
<div class="modal fade" id="modalSetujuiKades-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold"><i class="bi bi-shield-check me-2"></i>Pengesahan & Tanda Tangan Digital (TTE)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" style="background:#f8fafc">
                <div class="tte-box mb-4 shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-qr-code-scan" style="font-size:3rem"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Pengesahan Otomatis Berbasis QR-TTE</h6>
                            <p class="small mb-0 opacity-90">Dengan menyetujui, sistem akan secara otomatis membuat berkas PDF resmi, membubuhkan QR Code TTE Kepala Desa, dan mengubah status menjadi <strong>Selesai</strong>.</p>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-3 p-3 mb-3">
                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-2"><i class="bi bi-file-earmark-check me-2 text-primary"></i>Ringkasan Pengajuan</h6>
                    <div class="row g-2 small">
                        <div class="col-6"><span class="text-muted d-block">Nomor Pengajuan:</span><strong>{{ $r['no'] }}</strong></div>
                        <div class="col-6"><span class="text-muted d-block">Pemohon:</span><strong>{{ $r['nama'] }}</strong></div>
                        <div class="col-12"><span class="text-muted d-block">Jenis Surat:</span><span class="badge bg-primary">{{ $r['surat'] }}</span></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white py-3 px-4">
                <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-rounded px-5 btn-submit-tte" data-bs-dismiss="modal">
                    <i class="bi bi-shield-lock-fill me-2"></i>Sahkan & Generate PDF
                </button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TOLAK KADES --}}
<div class="modal fade" id="modalTolakKades-{{ $r['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 p-2">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger"><i class="bi bi-x-circle-fill me-2"></i>Tolak Pengajuan Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <p class="text-muted small mb-3">Nomor: <strong>{{ $r['no'] }}</strong> — Pemohon: <strong>{{ $r['nama'] }}</strong></p>
                <label class="form-label fw-semibold">Alasan Penolakan <span class="text-danger">*</span></label>
                <textarea class="form-control rounded-3" id="alasan-kades-{{ $r['id'] }}" rows="4" placeholder="Tuliskan alasan penolakan..." required></textarea>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-secondary btn-rounded px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-rounded px-4 btn-submit-tolak-kades" data-id="{{ $r['id'] }}" data-bs-dismiss="modal">
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
    $('#tableKadesSuratMasuk').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
        pageLength: 10, responsive: true,
        columnDefs: [{ orderable: false, targets: 7 }]
    });

    $(document).on('click', '.btn-submit-tte', function () {
        Swal.fire({
            title: 'Memproses PDF & TTE...',
            text: 'Sistem sedang men-generate file PDF dan menyematkan Tanda Tangan Digital Kepala Desa.',
            icon: 'info',
            timer: 2000,
            showConfirmButton: false,
            customClass: { popup: 'rounded-4' }
        }).then(() => {
            Swal.fire({
                title: 'Surat Selesai Disahkan! 🎉',
                text: 'PDF berhasil digenerate, TTE terpasang, dan status berubah menjadi Selesai.',
                icon: 'success',
                confirmButtonColor: '#0057A6',
                customClass: { popup: 'rounded-4' }
            });
        });
    });

    $(document).on('click', '.btn-submit-tolak-kades', function () {
        const id = $(this).data('id');
        const alasan = $('#alasan-kades-' + id).val().trim();
        if (!alasan) {
            Swal.fire({ title: 'Alasan Wajib Diisi!', text: 'Mohon masukkan alasan penolakan.', icon: 'warning', confirmButtonColor: '#dc3545', customClass: { popup: 'rounded-4' } });
            return;
        }
        Swal.fire({ title: 'Pengajuan Ditolak', text: 'Catatan penolakan telah disimpan.', icon: 'warning', confirmButtonColor: '#dc3545', customClass: { popup: 'rounded-4' } });
    });
});
</script>
@endpush
@endsection
