<link rel="stylesheet" href="{{ asset('css/detailberita.css') }}">

@if(isset($beritas))
    <section class="berita-section" id="berita-section">
        <div class="container-berita">

            <div class="berita-heading">
                <span class="berita-label">Berita Desa</span>
                <h2 class="section-title-berita">Berita Terkini</h2>
                <p class="section-subtitle-berita">
                    Informasi terbaru seputar kegiatan, layanan, dan perkembangan Desa Kalipait.
                </p>
            </div>

            <div class="row-berita">
                @foreach($beritas as $berita)
                    @php
                        $gambar = data_get($berita, 'gambar');
                        $judul = data_get($berita, 'judul', 'Judul berita');
                        $isi = data_get($berita, 'isi') ?? data_get($berita, 'deskripsi', '');
                        $penulis = data_get($berita, 'penulis.nama_lengkap', 'Tidak diketahui');
                        $tanggal = data_get($berita, 'tanggal') ?? data_get($berita, 'created_at');
                    @endphp

                    <div class="col-berita">
                        <div class="card-berita">
                            <div class="card-img-wrapper">
                                @if($gambar)
                                    <img src="{{ asset('storage/imageberita/' . $gambar) }}" class="card-img-berita" alt="{{ $judul }}">
                                @else
                                    <div class="card-img-placeholder">
                                        <span>Berita Desa</span>
                                    </div>
                                @endif

                                <div class="card-img-overlay"></div>
                                <span class="badge-berita">Terbaru</span>
                            </div>

                            <div class="card-body-berita">
                                <div class="meta-berita">
                                    <span>🖊 {{ $penulis }}</span>
                                    <span>
                                        📅 
                                        @if($tanggal)
                                            {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>

                                <h5 class="card-title-berita">{{ $judul }}</h5>

                                <p class="card-text-berita">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($isi), 115) }}
                                </p>

                                <a href="{{ route('landing_page.show', $berita->id_berita) }}" class="btn-berita">
                                    Baca Selengkapnya
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endif

@if(isset($berita))
    @php
        $judul = data_get($berita, 'judul', 'Detail Berita');
        $deskripsi = data_get($berita, 'deskripsi') ?? data_get($berita, 'isi', '');
        $penulis = data_get($berita, 'penulis.nama_lengkap', 'Tidak diketahui');
        $tanggal = data_get($berita, 'created_at');
        $gambar = data_get($berita, 'gambar');
    @endphp

    <section class="berita-detail">
        <div class="container-berita">

            <a href="{{ route('website') }}#berita-section" class="btn-kembali">
                ← Kembali ke Daftar Berita
            </a>

            <div class="card-berita-detail">
                @if($gambar)
                    <div class="detail-img-wrapper">
                        <img src="{{ asset('storage/imageberita/' . $gambar) }}" alt="{{ $judul }}">
                        <div class="detail-img-overlay"></div>
                    </div>
                @endif

                <div class="card-body-berita-detail">
                    <span class="berita-label">Detail Berita</span>

                    <h2 class="card-title-berita-detail">{{ $judul }}</h2>

                    <div class="detail-meta">
                        <span>🖊 {{ $penulis }}</span>
                        <span>
                            📅 {{ $tanggal ? $tanggal->format('d M Y') : '-' }}
                        </span>
                    </div>

                    <div class="card-text-berita-detail">
                        {!! $deskripsi !!}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll('.card-berita, .card-berita-detail');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        cards.forEach(card => observer.observe(card));
    });
</script>