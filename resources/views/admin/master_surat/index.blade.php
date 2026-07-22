@extends('admin.layout.main')
@section('title', 'Master Surat')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Master Surat</h1>
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
                        <form id="searchForm" class="d-flex" action="{{ route('mastersurat.index') }}" method="get">
                            <input class="form-control me-2" type="search" name="katakunci" id="searchInput"
                                   value="{{ Request::get('katakunci') }}" placeholder="Cari..." autocomplete="off">
                            <button class="btn btn-primary">
                                Cari
                            </button>
                        </form>
                        <a href="#" class="btn btn-primary" id="btnTambahSurat" data-id_surat="{{ $id_surat }}">
                            + Tambah Data
                        </a>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datasurat as $item)
                                        @if(!is_null($item->nama_surat))
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->id_surat }}</td>
                                            <td>{{ $item->nama_surat }}</td>
                                            <td>
                                               <button type="button"
                                                    class="btn btn-warning btn-sm btnEditSurat"

                                                    data-action="{{ route('mastersurat.update', $item->id_surat) }}"

                                                    data-id="{{ $item->id_surat }}"

                                                    data-nama="{{ $item->nama_surat }}"

                                                    data-keterangan="{{ $item->keterangan }}"

                                                    data-slug="{{ $item->slug }}"

                                                    data-berkas1="{{ $item->berkas1 }}"
                                                    data-berkas2="{{ $item->berkas2 }}"
                                                    data-berkas3="{{ $item->berkas3 }}"
                                                    data-berkas4="{{ $item->berkas4 }}"
                                                    data-berkas5="{{ $item->berkas5 }}"
                                                    data-berkas6="{{ $item->berkas6 }}"
                                                    data-berkas7="{{ $item->berkas7 }}"
                                                    data-berkas8="{{ $item->berkas8 }}"
                                                    data-berkas9="{{ $item->berkas9 }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <form id="formHapus{{ $item->id_surat }}" method="POST" action="{{ route('mastersurat.destroy', $item->id_surat) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm btnDeleteSurat"
                                                            data-id="{{ $item->id_surat }}"
                                                            data-nama="{{ $item->nama_surat }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $datasurat->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- MODAL TAMBAH / EDIT --}}
<div class="modal fade" id="modalForm" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modalTitle">
                    Tambah Surat
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>


            <div class="modal-body">
                <form id="formSurat" method="POST" enctype="multipart/form-data" data-store-url="{{ route('mastersurat.store') }}" action="{{ route('mastersurat.store') }}">
                    @csrf

                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <div class="mb-3">
                        <label class="form-label">
                            ID Surat
                        </label>
                        <input type="text" class="form-control" id="inputIdSurat" name="id_surat" value="{{ old('id_surat') }}" readonly>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">
                            Nama Surat
                        </label>
                        <input type="text" class="form-control" id="inputNamaSurat" name="nama_surat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Keterangan Surat
                        </label>
                        <input type="text" class="form-control" id="inputKetSurat" name="keterangan" required>
                        <small class="text-muted">
                            *Jika akta kematian bisa diisi dengan nama almarhum
                        </small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Slug
                        </label>
                        <textarea rows="4" class="form-control" name="slug" id="slug" ></textarea>
                        
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <label class="form-label mb-0">
                                Persyaratan Berkas
                            </label>

                            <button type="button"
                                    class="btn btn-primary btn-sm"
                                    id="btnTambahBerkas">

                                + Tambah Berkas
                            </button>

                        </div>

                        <div id="containerBerkas">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="submit" form="formSurat" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>


{{-- JAVASCRIPT --}}
@push('scripts')
<script src="{{ asset('js/mastersurat.js') }}"></script>
<script>
let jumlahBerkas = 0;

$('#btnTambahBerkas').on('click', function () {

    jumlahBerkas++;

    if (jumlahBerkas > 8) {

        alert('Maksimal 8 berkas');

        return;
    }

    $('#containerBerkas').append(`

        <div class="mb-3 d-flex justify-content-between align-items-end item-berkas">

    <div style="width: 82%;">

        <label>
            Berkas ${jumlahBerkas}
        </label>

        <input type="text"
               name="berkas${jumlahBerkas}"
               class="form-control"
               placeholder="Contoh: KTP">

    </div>

    <div style="width: 15%;">

        <button type="button"
                class="btn btn-danger btnHapus w-100">

            Hapus
        </button>

    </div>

</div>

    `);

});

$(document).on('click', '.btnHapus', function () {

    $(this).closest('.item-berkas').remove();

});
</script>
@endpush

@endsection