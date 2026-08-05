@extends('admin.layout.main')
@section('title', 'Edit Landingpage')

@section('content')

<section class="section">

<div class="section-header">
    <h1>Edit Landingpage</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi Kesalahan!</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('homepage.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Judul Utam / Hero Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $data->judul }}" required>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Deskripsi Utama / Hero Subtitle</label>
                            <textarea class="form-control" name="description" rows="5" required>{{ $data->deskripsi1 }}</textarea>
                        </div>

                        <!-- HERO BANNER IMAGES -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Gambar Banner Hero / Carousel (Bisa Unggah Banyak Gambar)</label>
                            <input type="file" class="form-control" name="hero_image[]" id="hero_image" multiple accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maksimal 10MB per file.</small>
                            @if(!empty($data->gambar1) && is_array(json_decode($data->gambar1, true)))
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach(json_decode($data->gambar1, true) as $img)
                                        <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail" width="120" style="height: 80px; object-fit: cover;">
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- SUBJUDUL -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Subjudul Deskripsi 1</label>
                            <textarea class="form-control" name="subtittle">{{ $data->subtittle }}</textarea>
                        </div>

                        <!-- DESKRIPSI SUBJUDUL -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Deskripsi Subjudul 1</label>
                            <textarea class="form-control" name="section_text" rows="5">{{ $data->section_text }}</textarea>
                        </div>

                        <!-- IMAGE DESKRIPSI 1 -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Foto Profil / Deskripsi 1</label>
                            <input type="file" class="form-control" name="image_description1" id="image_description1" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maksimal 10MB.</small>
                            <div class="mt-2">
                                <img src="{{ !empty($data->image_description1) ? asset('storage/' . $data->image_description1) : '' }}"
                                     class="img-thumbnail {{ empty($data->image_description1) ? 'd-none' : '' }}"
                                     width="200"
                                     id="previewDesc1">
                            </div>
                        </div>

                        <!-- SUBJUDUL 2 -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Subjudul Deskripsi 2</label>
                            <textarea class="form-control" name="subtitle_2">{{ $data->subtitle_2 }}</textarea>
                        </div>

                        <!-- DESKRIPSI SUBJUDUL 2 -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Deskripsi Subjudul 2</label>
                            <textarea class="form-control" name="section_second" rows="5">{{ $data->section_second }}</textarea>
                        </div>

                        <!-- IMAGE DESKRIPSI 2 -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Foto Profil / Deskripsi 2</label>
                            <input type="file" class="form-control" name="image_description2" id="image_description2" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG, WEBP. Maksimal 10MB.</small>
                            <div class="mt-2">
                                <img src="{{ !empty($data->image_description2) ? asset('storage/' . $data->image_description2) : '' }}"
                                     class="img-thumbnail {{ empty($data->image_description2) ? 'd-none' : '' }}"
                                     width="200"
                                     id="previewDesc2">
                            </div>
                        </div>

                        <!-- VISI -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Visi Desa</label>
                            <textarea class="form-control" name="visi" rows="4">{{ $data->visi }}</textarea>
                        </div>

                        <!-- MISI -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Misi Desa</label>
                            <textarea class="form-control" name="misi" rows="4">{{ $data->misi }}</textarea>
                        </div>

                        <!-- ABOUT -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Tentang Kami / Profil Desa</label>
                            <textarea class="form-control" name="about_content" rows="4">{{ $data->about_us }}</textarea>
                        </div>

                        <!-- BUTTON -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-1"></i> SIMPAN PERUBAHAN
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

</section>

<script>

document.getElementById('image_description1')?.addEventListener('change', function(e){
    const preview = document.getElementById('previewDesc1');
    if (e.target.files && e.target.files[0] && preview) {
        preview.src = URL.createObjectURL(e.target.files[0]);
        preview.classList.remove('d-none');
    }
});

document.getElementById('image_description2')?.addEventListener('change', function(e){
    const preview = document.getElementById('previewDesc2');
    if (e.target.files && e.target.files[0] && preview) {
        preview.src = URL.createObjectURL(e.target.files[0]);
        preview.classList.remove('d-none');
    }
});

</script>

@endsection
