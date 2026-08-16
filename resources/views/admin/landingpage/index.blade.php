@extends('admin.layout.main')
@section('title', 'Kelola Website Landingpage')

@push('css-lib')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, .main-content { font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif !important; }
    .card-modern { border: 1px solid #e2e8f0; border-radius: 14px !important; box-shadow: 0 4px 18px rgba(0,0,0,0.03) !important; background: #fff; margin-bottom: 24px; }
    .card-header-modern { background: #fff; padding: 18px 24px; border-bottom: 1px solid #f1f5f9; border-top-left-radius: 14px !important; border-top-right-radius: 14px !important; display: flex; align-items: center; justify-content: space-between; }
    .card-header-title { font-weight: 700; font-size: 1rem; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; }
    .card-header-title i { font-size: 1.2rem; color: var(--primary, #0057A6); }
    .card-body-modern { padding: 24px; }
    .form-label-custom { font-weight: 600; font-size: 0.9rem; color: #334155; margin-bottom: 8px; }
    .btn-rounded { border-radius: 30px !important; }
    .preview-img-wrapper { position: relative; display: inline-block; }
    .preview-img-box { border-radius: 10px; border: 1px solid #e2e8f0; object-fit: cover; }
    .btn-delete-badge { position: absolute; top: -8px; right: -8px; width: 28px; height: 28px; border-radius: 50% !important; padding: 0 !important; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem; box-shadow: 0 4px 10px rgba(225, 29, 72, 0.3); }
    .section-tag { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 4px 12px; border-radius: 20px; background: #e0f2fe; color: #0369a1; }
</style>
@endpush

@section('content')

<section class="section">
    <!-- SECTION HEADER -->
    <div class="section-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Kelola Website Landingpage</h1>
            <p class="text-muted small mb-0">Atur seluruh teks, foto banner, dan konten informasi publik Desa Rambipuji.</p>
        </div>
        <div>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary btn-rounded px-4">
                <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Live Website
            </a>
        </div>
    </div>

    <!-- ALERTS -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Peringatan!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Terjadi Kesalahan!</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('homepage.update') }}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- 1. HERO BANNER SECTION -->
        <div class="card card-modern">
            <div class="card-header-modern">
                <div class="card-header-title">
                    <i class="bi bi-sliders"></i>
                    <span>1. Halaman Utama / Hero Banner</span>
                </div>
                <span class="section-tag">Hero Section</span>
            </div>
            <div class="card-body-modern">
                <div class="mb-4">
                    <label class="form-label-custom">Judul Utama (Hero Title)</label>
                    <input type="text" class="form-control rounded-3" name="title" value="{{ old('title', $data->judul) }}" required placeholder="Contoh: Digital Village - Desa Rambipuji">
                    <small class="text-muted">Judul besar yang tampil di bagian paling atas beranda landingpage.</small>
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Deskripsi Utama (Hero Subtitle)</label>
                    <textarea class="form-control rounded-3" name="description" rows="3" required placeholder="Deskripsi ringkas mengenai layanan digital desa...">{{ old('description', $data->deskripsi1) }}</textarea>
                    <small class="text-muted">Paragraf penjelas di bawah judul utama beranda.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Unggah Gambar Banner Hero / Carousel</label>
                    <input type="file" class="form-control rounded-3" name="hero_image[]" id="hero_image" multiple accept="image/*">
                    <small class="text-muted d-block mt-1">Bisa mengunggah beberapa foto sekaligus. Format: JPG, JPEG, PNG, WEBP. Maksimal 10MB per file.</small>

                    @if(!empty($data->gambar1) && is_array(json_decode($data->gambar1, true)) && count(json_decode($data->gambar1, true)) > 0)
                        <div class="mt-4">
                            <label class="form-label-custom d-block text-dark">Gambar Carousel Aktif (Klik Tombol Merah Untuk Menghapus Foto Specific):</label>
                            <div class="d-flex flex-wrap gap-3 mt-2">
                                @foreach(json_decode($data->gambar1, true) as $index => $img)
                                    <div class="preview-img-wrapper">
                                        <img src="{{ asset('storage/' . $img) }}" class="preview-img-box" width="140" height="90">
                                        <button type="button" 
                                                class="btn btn-danger btn-delete-badge btnDeleteHeroImg" 
                                                data-index="{{ $index }}"
                                                title="Hapus foto ini">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- 2. PROFIL DESA (BAGIAN 1) -->
        <div class="card card-modern">
            <div class="card-header-modern">
                <div class="card-header-title">
                    <i class="bi bi-building"></i>
                    <span>2. Profil & Layanan Desa (Bagian 1)</span>
                </div>
                <span class="section-tag">Section Profil 1</span>
            </div>
            <div class="card-body-modern">
                <div class="mb-4">
                    <label class="form-label-custom">Subjudul Profil (Bagian 1)</label>
                    <input type="text" class="form-control rounded-3" name="subtittle" value="{{ old('subtittle', $data->subtittle) }}" placeholder="Contoh: Layanan Persuratan Mandiri">
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Deskripsi Profil (Bagian 1)</label>
                    <textarea class="form-control rounded-3" name="section_text" rows="4" placeholder="Penjelasan mengenai profil dan layanan desa bagian 1...">{{ old('section_text', $data->section_text) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Foto Profil / Deskripsi 1</label>
                    <input type="file" class="form-control rounded-3" name="image_description1" id="image_description1" accept="image/*">
                    <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG, WEBP. Maksimal 10MB.</small>
                    
                    <div class="mt-3 d-flex align-items-center gap-3">
                        <img src="{{ !empty($data->image_description1) ? asset('storage/' . $data->image_description1) : asset('image/service/1.png') }}"
                             class="preview-img-box"
                             width="200"
                             height="130"
                             id="previewDesc1">

                        @if(!empty($data->image_description1))
                            <button type="button" class="btn btn-outline-danger btn-rounded px-3 py-2 btnDeleteDescImg" data-type="1">
                                <i class="bi bi-trash me-1"></i> Hapus Foto Ini
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. PROFIL DESA (BAGIAN 2) -->
        <div class="card card-modern">
            <div class="card-header-modern">
                <div class="card-header-title">
                    <i class="bi bi-file-text"></i>
                    <span>3. Profil & Layanan Desa (Bagian 2)</span>
                </div>
                <span class="section-tag">Section Profil 2</span>
            </div>
            <div class="card-body-modern">
                <div class="mb-4">
                    <label class="form-label-custom">Subjudul Profil (Bagian 2)</label>
                    <input type="text" class="form-control rounded-3" name="subtitle_2" value="{{ old('subtitle_2', $data->subtitle_2) }}" placeholder="Contoh: Pengurusan Surat Cepat & Praktis">
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Deskripsi Profil (Bagian 2)</label>
                    <textarea class="form-control rounded-3" name="section_second" rows="4" placeholder="Penjelasan mengenai profil dan layanan desa bagian 2...">{{ old('section_second', $data->section_second) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Foto Profil / Deskripsi 2</label>
                    <input type="file" class="form-control rounded-3" name="image_description2" id="image_description2" accept="image/*">
                    <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG, WEBP. Maksimal 10MB.</small>
                    
                    <div class="mt-3 d-flex align-items-center gap-3">
                        <img src="{{ !empty($data->image_description2) ? asset('storage/' . $data->image_description2) : asset('image/service/2.png') }}"
                             class="preview-img-box"
                             width="200"
                             height="130"
                             id="previewDesc2">

                        @if(!empty($data->image_description2))
                            <button type="button" class="btn btn-outline-danger btn-rounded px-3 py-2 btnDeleteDescImg" data-type="2">
                                <i class="bi bi-trash me-1"></i> Hapus Foto Ini
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. VISI & MISI DESA -->
        <div class="card card-modern">
            <div class="card-header-modern">
                <div class="card-header-title">
                    <i class="bi bi-bullseye"></i>
                    <span>4. Visi & Misi Desa Rambipuji</span>
                </div>
                <span class="section-tag">Visi & Misi</span>
            </div>
            <div class="card-body-modern">
                <div class="mb-4">
                    <label class="form-label-custom">Visi Desa</label>
                    <textarea class="form-control rounded-3" name="visi" rows="3" placeholder="Tuliskan Visi Desa Rambipuji...">{{ old('visi', $data->visi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Misi Desa</label>
                    <textarea class="form-control rounded-3" name="misi" rows="5" placeholder="Tuliskan poin-poin Misi Desa Rambipuji...">{{ old('misi', $data->misi) }}</textarea>
                </div>
            </div>
        </div>

        <!-- 5. TENTANG KAMI / FOOTER -->
        <div class="card card-modern">
            <div class="card-header-modern">
                <div class="card-header-title">
                    <i class="bi bi-info-circle"></i>
                    <span>5. Informasi Footer (Tentang Kami)</span>
                </div>
                <span class="section-tag">Footer Info</span>
            </div>
            <div class="card-body-modern">
                <div class="mb-3">
                    <label class="form-label-custom">Teks Tentang Kami / Deskripsi Singkat Footer</label>
                    <textarea class="form-control rounded-3" name="about_content" rows="3" placeholder="Teks deskripsi singkat yang tampil di bagian bawah footer...">{{ old('about_content', $data->about_us) }}</textarea>
                </div>
            </div>
        </div>

        <!-- TOMBOL SIMPAN -->
        <div class="d-flex justify-content-end mb-5">
            <button type="submit" class="btn btn-primary btn-rounded px-5 py-2 shadow">
                <i class="bi bi-check-lg me-1"></i> SIMPAN SEMUA PERUBAHAN
            </button>
        </div>

    </form>
</section>

<!-- FORM HIDDEN HARUS ADA DI LUAR FORM UTAMA UNTUK MENGHINDARI NESTED FORM -->
<form id="formDeleteHero" action="{{ route('homepage.delete_hero') }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
    <input type="hidden" name="image_index" id="deleteHeroIndex">
</form>

<form id="formDeleteDesc1" action="{{ route('homepage.delete_desc', 1) }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<form id="formDeleteDesc2" action="{{ route('homepage.delete_desc', 2) }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Live Image Previews
document.getElementById('image_description1')?.addEventListener('change', function(e){
    const preview = document.getElementById('previewDesc1');
    if (e.target.files && e.target.files[0] && preview) {
        preview.src = URL.createObjectURL(e.target.files[0]);
    }
});

document.getElementById('image_description2')?.addEventListener('change', function(e){
    const preview = document.getElementById('previewDesc2');
    if (e.target.files && e.target.files[0] && preview) {
        preview.src = URL.createObjectURL(e.target.files[0]);
    }
});

// Aksi Hapus Gambar Hero Carousel
document.querySelectorAll('.btnDeleteHeroImg').forEach(btn => {
    btn.addEventListener('click', function() {
        const index = this.getAttribute('data-index');
        Swal.fire({
            title: 'Hapus Gambar Carousel?',
            text: 'Gambar ini akan dihapus permanen dari server!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteHeroIndex').value = index;
                document.getElementById('formDeleteHero').submit();
            }
        });
    });
});

// Aksi Hapus Foto Deskripsi 1 dan 2
document.querySelectorAll('.btnDeleteDescImg').forEach(btn => {
    btn.addEventListener('click', function() {
        const type = this.getAttribute('data-type');
        Swal.fire({
            title: 'Hapus Foto Deskripsi ' + type + '?',
            text: 'Foto ini akan dihapus permanen dari server!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                if (type === '1') {
                    document.getElementById('formDeleteDesc1').submit();
                } else if (type === '2') {
                    document.getElementById('formDeleteDesc2').submit();
                }
            }
        });
    });
});
</script>
@endpush

@endsection
