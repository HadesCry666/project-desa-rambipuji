@extends('admin.layout.main')
@section('title', 'Surat Ditolak')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="section">
    <div class="section-header">
        <h1>Surat Ditolak</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between">
                        <form class="d-flex" action="{{ route('suratditolak.tampil') }}" method="get">
                            <input class="form-control me-1" type="search" name="katakunci"
                                value="{{ Request::get('katakunci') }}" placeholder="Cari">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </form>
                    </div>

                    {{-- TABLE --}}
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($datapengajuan as $a)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->nik }}</td>
                                        <td>{{ $a->nama_lengkap }}</td>
                                        <td>{{ $a->nama_surat }}</td>
                                        <td>{{ $a->tanggal_diajukan }}</td>
                                        <td>{{ $a->rw }}</td>
                                        <td>

                                            {{-- DETAIL --}}
                                            <button class="btn btn-success btn-sm"
                                                data-toggle="modal"
                                                data-target="#modalDetail-{{ $a->id_pengajuan }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            {{-- DELETE --}}
                                            <form action="{{ url('admin/suratditolak/'.$a->id_pengajuan.'/delete') }}"
                                                method="POST"
                                                id="deleteForm-{{ $a->id_pengajuan }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $a->id_pengajuan }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Belum ada data
                                        </td>
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
                    <input type="text" class="form-control"
                        value="{{ $a->nama_lengkap }}" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Surat</label>
                    <input type="text" class="form-control"
                        value="{{ $a->nama_surat }}" readonly>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control"
                            value="{{ $a->jenis_kelamin }}" readonly>
                    </div>
                    <div class="col">
                        <label>TTL</label>
                        <input type="text" class="form-control"
                            value="{{ $a->tempat_tanggal_lahir }}" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label>Warga / Agama</label>
                        <input type="text" class="form-control"
                            value="{{ $a->warga_agama }}" readonly>
                    </div>
                    <div class="col">
                        <label>RW</label>
                        <input type="text" class="form-control"
                            value="{{ $a->rw }}" readonly>
                    </div>
                    <div class="col">
                        <label>RT</label>
                        <input type="text" class="form-control"
                            value="{{ $a->rt }}" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label>Keperluan</label>
                        <input type="text" class="form-control"
                            value="{{ $a->keperluan }}" readonly>
                    </div>
                    <div class="col">
                        <label>Tanggal</label>
                        <input type="text" class="form-control"
                            value="{{ $a->tanggal_diajukan }}" readonly>
                    </div>
                </div>

                {{-- FOTO --}}
                <div class="row mt-3">
                    @for ($i = 1; $i <= 8; $i++)
                        @php $foto = 'foto'.$i; @endphp
                        @if (!empty($a->$foto))
                            <div class="col-12 mb-3">
                                <label>Bukti {{ $i }}</label>
                                <img src="{{ asset('storage/surat/' . $a->$foto) }}"
                                     class="img-fluid rounded">
                            </div>
                        @endif
                    @endfor
                </div>

            </div>

        </div>
    </div>
</div>
@endforeach


{{-- ========================= --}}
{{-- SCRIPT --}}
{{-- ========================= --}}
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm-' + id).submit();
        }
    });
}
</script>

@endsection