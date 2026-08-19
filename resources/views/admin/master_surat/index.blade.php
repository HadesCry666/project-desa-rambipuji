@extends('admin.layout.main')
@section('title', 'Master Surat')

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
                            <table class="table table-modern w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px">No</th>
                                        <th class="text-center">ID Surat</th>
                                        <th class="text-center">Nama Surat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datasurat as $item)
                                        @if(!is_null($item->nama_surat))
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                            <td class="text-center"><span class="badge-kadus">{{ $item->id_surat }}</span></td>
                                            <td class="text-center"><span class="badge bg-light text-dark border fw-medium" style="font-size:.78rem">{{ $item->nama_surat }}</td>
                                            <td class="text-center">
                                               <button type="button"
                                                    class="btn btn-sm btn-warning btn-rounded btnEditSurat"

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
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>

                                                <form id="formHapus{{ $item->id_surat }}" method="POST" action="{{ route('mastersurat.destroy', $item->id_surat) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-sm btn-danger btn-rounded px-2 btnDeleteSurat"
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