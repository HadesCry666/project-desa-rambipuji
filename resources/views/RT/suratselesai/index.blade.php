@extends('rt.layout.main')
@section('title', 'Surat Selesai')

@section('content')

<section class="section">

    <div class="section-header">
        <h1>Surat Selesai</h1>
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

                    <div class="card-header d-flex justify-content-between">

                        <form id="searchForm"
                              class="d-flex"
                              action="{{ route('rt.suratselesai.index') }}"
                              method="get">

                            <input class="form-control me-2"
                                   type="search"
                                   name="katakunci"
                                   id="searchInput"
                                   value="{{ Request::get('katakunci') }}"
                                   placeholder="Cari..."
                                   autocomplete="off">

                            <button class="btn btn-outline-primary">
                                Cari
                            </button>

                        </form>

                    </div>

                    {{-- Tabel Data --}}
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

                                    @forelse ($pengajuan as $a)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->nik }}</td>
                                        <td>{{ $a->nama_lengkap }}</td>
                                        <td>{{ $a->nama_surat }}</td>
                                        <td>{{ $a->tanggal_diajukan }}</td>
                                        <td>{{ $a->rw }}</td>

                                        <td>

                                            <button type="button"
                                                    class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetail-{{ $a->id_pengajuan }}">

                                                <i class="fas fa-eye"></i>

                                            </button>

                                        </td>

                                    </tr>

                                    @empty

                                    <tr>

                                        <td colspan="7" class="text-center">

                                            @if(request('katakunci'))

                                                Data dengan kata kunci
                                                <strong>{{ request('katakunci') }}</strong>
                                                tidak ditemukan.

                                            @else

                                                Belum ada data.

                                            @endif

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

{{-- MODAL DI LUAR SECTION --}}
@foreach ($pengajuan as $a)

<div class="modal fade"
     id="modalDetail-{{ $a->id_pengajuan }}"
     tabindex="-1"
     aria-labelledby="modalDetailLabel"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h6 class="modal-title">
                    Detail Pengajuan
                </h6>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <label class="form-label">Nama</label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->nama_lengkap }}"
                       readonly>

                <label class="form-label mt-2">
                    Nama Surat
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->nama_surat }}"
                       readonly>

                <label class="form-label mt-2">
                    Jenis Kelamin
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->jenis_kelamin }}"
                       readonly>

                <label class="form-label mt-2">
                    TTL
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->tempat_tanggal_lahir }}"
                       readonly>

                <label class="form-label mt-2">
                    Warga / Agama
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->warga_agama }}"
                       readonly>

                <label class="form-label mt-2">
                    RW
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->rw }}"
                       readonly>

                <label class="form-label mt-2">
                    RT
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->rt }}"
                       readonly>

                <label class="form-label mt-2">
                    Keperluan
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->keperluan }}"
                       readonly>

                <label class="form-label mt-2">
                    Tanggal Diajukan
                </label>

                <input type="text"
                       class="form-control"
                       value="{{ $a->tanggal_diajukan }}"
                       readonly>

                <div class="mt-3">

                    @for ($i = 1; $i <= 8; $i++)

                        @php
                            $foto = 'foto'.$i;
                        @endphp

                        @if (!empty($a->$foto))

                            <label class="form-label">
                                Bukti {{ $i }}
                            </label>

                            <br>

                            <img src="{{ asset($a->$foto) }}"
                                 class="img-fluid mb-2"
                                 alt="Bukti {{ $i }}">

                        @endif

                    @endfor

                </div>

            </div>

        </div>

    </div>

</div>

@endforeach

@endsection