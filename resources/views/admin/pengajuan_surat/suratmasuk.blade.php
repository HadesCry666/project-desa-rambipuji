@extends('admin.layout.main')
@section('title', 'Surat Masuk')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="section">
    <div class="section-header">
        <h1>Surat Masuk</h1>
    </div>

    @if(session('success'))
    <div id="alertPopup" class="alert alert-success alert-floating">
        {{ session('success') }}
    </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    {{-- FORM SEARCH --}}
                    <div class="card-header d-flex justify-content-between">
                        <form class="d-flex" action="{{ route('pengajuan.masuk') }}" method="get">
                            <input class="form-control me-2"
                                type="search"
                                name="katakunci"
                                value="{{ Request::get('katakunci') }}"
                                placeholder="Cari...">
                            <button class="btn btn-primary">Cari</button>
                        </form>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>RW</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($datapengajuan->count() > 0)
                                        @foreach ($datapengajuan as $a)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $a->nik }}</td>
                                            <td>{{ $a->nama_lengkap }}</td>
                                            <td>{{ $a->nama_surat }}</td>
                                            <td>{{ $a->tanggal_diajukan }}</td>
                                            <td>{{ $a->rw }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetail-{{ $a->id_pengajuan }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <form id="deleteForm-{{ $a->id_pengajuan }}"
                                                    action="{{ url('admin/suratmasuk/'.$a->id_pengajuan.'/delete') }}"
                                                    method="POST"
                                                    style="display:inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete(event, {{ $a->id_pengajuan }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center align-middle">
                                                <span class="text-muted">Belum ada data</span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>


{{-- ================= MODAL DETAIL (DI LUAR SECTION) ================= --}}
@foreach ($datapengajuan as $a)
<div class="modal fade" id="modalDetail-{{ $a->id_pengajuan }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title">Detail Pengajuan</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" class="form-control"
                        value="{{ $a->nama_lengkap }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Nama Surat</label>
                    <input type="text" class="form-control"
                        value="{{ $a->nama_surat }}" readonly>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Jenis Kelamin</label>
                        <input class="form-control"
                            value="{{ $a->jenis_kelamin }}" readonly>
                    </div>
                    <div class="col">
                        <label>TTL</label>
                        <input class="form-control"
                            value="{{ $a->tempat_tanggal_lahir }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Warga / Agama</label>
                        <input class="form-control"
                            value="{{ $a->warga_agama }}" readonly>
                    </div>
                    <div class="col">
                        <label>RW</label>
                        <input class="form-control"
                            value="{{ $a->rw }}" readonly>
                    </div>
                    <div class="col">
                        <label>RT</label>
                        <input class="form-control"
                            value="{{ $a->rt }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label>Keperluan</label>
                        <input class="form-control"
                            value="{{ $a->keperluan }}" readonly>
                    </div>
                    <div class="col">
                        <label>Tanggal Diajukan</label>
                        <input class="form-control"
                            value="{{ $a->tanggal_diajukan }}" readonly>
                    </div>
                </div>

                {{-- FOTO --}}
                <div class="row">
                    @for ($i = 1; $i <= 8; $i++)
                        @php $foto = 'foto'.$i; @endphp
                        @if (!empty($a->$foto))
                        <div class="col-12 mb-2">
                            <label>Bukti {{ $i }}</label>
                            <img src="{{ asset($a->$foto) }}" width="100%">
                        </div>
                        @endif
                    @endfor
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-danger"
                    onclick="bukaModalPenolakan(event, {{ $a->id_pengajuan }})"
                    data-route="{{ route('pengajuan.tolak',$a->id_pengajuan) }}">
                    Tolak
                </button>

                <button class="btn btn-primary"
                    onclick="setujuiPengajuan(event, {{ $a->id_pengajuan }})"
                    data-route="{{ route('pengajuan.setuju',$a->id_pengajuan) }}">
                    Setujui
                </button>
            </div>

        </div>
    </div>
</div>
@endforeach


{{-- MODAL PENOLAKAN --}}
<div class="modal fade" id="modalPenolakan">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h6>Alasan Penolakan</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formPenolakan" method="POST">
                    @csrf
                    <textarea
                        rows="4"
                        class="form-control mb-3"
                        name="keterangan_ditolak"
                        id="inputAlasan" required></textarea>

                    <button class="btn btn-danger w-100">
                        Tolak Pengajuan
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/suratmasuk.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const alertBox = document.getElementById('alertPopup');

    if(alertBox){
        setTimeout(() => {
            alertBox.classList.add('show');
        }, 100);

        setTimeout(() => {
            alertBox.classList.remove('show');
        }, 4000);
    }

});
</script>
@endpush

<style>
.alert-floating {
    position: fixed;
    top: 20px;
    right: -400px;
    z-index: 9999;
    min-width: 320px;
    transition: all 0.5s ease-in-out;
}

.alert-floating.show {
    right: 20px;
}
</style>

@endsection