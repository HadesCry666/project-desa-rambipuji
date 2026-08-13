<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Village - Desa Rambipuji</title>
    
    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Landing Page CSS -->
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme-switcher.css') }}">
    
    <!-- AOS Scroll Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>     

<body>

    <!-- ================= NAVBAR SECTION ================= -->
    <header class="header-section" id="navbarHeader">
        <div class="container h-100">
            <div class="nav-wrapper">

                <!-- LOGO DESA RAMBIPUJI -->
                <a href="#hero-section" class="logo-container">
                    <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa Rambipuji" class="logo-img">
                    <div class="logo-text">
                        <span class="logo-name">Desa Rambipuji</span>
                        <span class="logo-sub">Kabupaten Jember</span>
                    </div>
                </a>

                <!-- DESKTOP NAVIGATION -->
                <nav class="desktop-nav">
                    <ul>
                        <li><a href="#hero-section" class="active">Beranda</a></li>
                        <li><a href="#section-1-first">Layanan</a></li>
                        <li><a href="#footer-section">Tentang Kami</a></li>
                        <li><a href="{{ route('login') }}" class="nav-login">Login</a></li>
                    </ul>
                </nav>

                <!-- HAMBURGER TOGGLE BUTTON -->
                <button class="hamburger" id="hamburgerBtn" onclick="toggleMobileMenu()" aria-label="Toggle Navigation Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

            </div>
        </div>
    </header>

    <!-- MOBILE DRAWER OVERLAY -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>

    <!-- MOBILE DRAWER SIDEBAR -->
    <aside class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            <div class="logo-container">
                <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa" class="logo-img">
                <div class="logo-text">
                    <span class="logo-name">Desa Rambipuji</span>
                    <span class="logo-sub">Smart Village Jember</span>
                </div>
            </div>
            <button class="drawer-close" onclick="closeMobileMenu()">✕</button>
        </div>
        <nav class="drawer-nav">
            <ul>
                <li>
                    <a href="#hero-section" onclick="closeMobileMenu()">
                        <span class="drawer-icon">🏠</span> Beranda
                    </a>
                </li>
                <li>
                    <a href="#section-1-first" onclick="closeMobileMenu()">
                        <span class="drawer-icon">⚙️</span> Layanan
                    </a>
                </li>
                <li>
                    <a href="#footer-section" onclick="closeMobileMenu()">
                        <span class="drawer-icon">ℹ️</span> Tentang Kami
                    </a>
                </li>
                <li class="drawer-login">
                    <a href="{{ route('login') }}">
                        <span class="drawer-icon">🔐</span> Login Portal
                    </a>
                </li>
            </ul>
        </nav>
        <div class="drawer-footer">
            <p>© 2026 Desa Rambipuji. All Rights Reserved.</p>
        </div>
    </aside>


    <!-- ================= HERO SECTION ================= -->
    <section class="hero-section" id="hero-section">
        <div class="container position-relative" style="z-index: 5;">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="left-section">
                        <div class="hero-badge">
                            <span class="hero-badge-icon"></span>
                            <span>Portal Resmi Digital Village 2026</span>
                        </div>
                        <h1>{{ $data->judul }}</h1>
                        <p>{{ $data->deskripsi1 }}</p>
                        <div class="d-flex align-items-center">
                            <a href="{{ asset('downloads/Digital-Village.apk') }}" class="contact-button" download>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="7 10 12 15 17 10"/>
                                    <line x1="12" y1="15" x2="12" y2="3"/>
                                </svg>
                                <span>Download APK</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if(!empty($data->gambar1) && is_array(json_decode($data->gambar1, true)) && count(json_decode($data->gambar1, true)) > 0)
                                @foreach(json_decode($data->gambar1, true) as $index => $img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $img) }}" alt="Banner Slide {{ $index + 1 }}" style="max-height: 450px; object-fit: contain;">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <img src="{{ asset('image/coroseul/flash1.png') }}" alt="Aplikasi Mobile Desa Rambipuji Slide 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('image/coroseul/flash2.png') }}" alt="Aplikasi Mobile Desa Rambipuji Slide 2">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <!-- ================= FITUR LAYANAN SECTION ================= -->
    <section class="service-section" id="service-section">
        <div class="container">
            <div class="row g-4">
                
                <!-- Card 1: Website -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <img src="{{ asset('image/service/1.png') }}" alt="Ikon Website">
                        </div>
                        <div class="service-content">
                            <h3>Website</h3>
                            <p>Pusat informasi dan e-form resmi Desa Rambipuji</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Pengajuan Surat -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <img src="{{ asset('image/service/2.png') }}" alt="Ikon Pengajuan Surat">
                        </div>
                        <div class="service-content">
                            <h3>Pengajuan Surat</h3>
                            <p>Ajukan dokumen resmi secara mandiri tanpa perlu antre</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Aplikasi Mobile -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <div class="service-icon-box">
                            <img src="{{ asset('image/service/4.png') }}" alt="Ikon Aplikasi Mobile">
                        </div>
                        <div class="service-content">
                            <h3>Aplikasi Mobile</h3>
                            <p>Seluruh layanan desa publik berada dalam genggaman Anda</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= DUMMY BANNER SLOGAN ================= -->
    <section class="dummy-section" id="dummy-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center" data-aos="zoom-in">
                    <h3>Aplikasi Desa Digital : Semua Layanan Surat Kini dalam Genggaman</h3>
                    <p>
                        Ajukan Akta Kelahiran, Kartu Keluarga, KTP, dan beragam surat lainnya <br class="d-none d-md-block">
                        tanpa antre, cukup menggunakan handphone Anda kapan saja dan di mana saja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= ALUR PENGAJUAN SURAT SECTION ================= -->
    <section class="alur-section" id="alur-section">
        <div class="container alur-grid-container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-kicker">Kemudahan Layanan</span>
                <h2 class="section-title">Alur Pengajuan Surat</h2>
                <p class="section-subtitle">Ikuti langkah-langkah mudah berikut untuk mengajukan surat di Desa Rambipuji.</p>
            </div>
            
            <div class="alur-grid">
                
                <!-- Step 01 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="grid-step-number">01</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <h5>Permohonan Surat ke Ketua RT</h5>
                    <p>Warga mengajukan permohonan surat pengantar kepada Ketua RT.</p>
                </div>
                
                <!-- Step 02 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="150">
                    <div class="grid-step-number">02</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h5>Verifikasi & TTD Ketua RT</h5>
                    <p>Ketua RT melakukan verifikasi data dan memberikan tanda tangan.</p>
                </div>

                <!-- Step 03 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="grid-step-number">03</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/></svg>
                    </div>
                    <h5>Tanda Tangan Ketua RW</h5>
                    <p>Warga meminta persetujuan dan tanda tangan Ketua RW.</p>
                </div>

                <!-- Step 04 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="250">
                    <div class="grid-step-number">04</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </div>
                    <h5>Tanda Tangan Kepala Dusun</h5>
                    <p>Warga meminta tanda tangan dan verifikasi Kepala Dusun.</p>
                </div>

                <!-- Step 05 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="grid-step-number">05</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                    </div>
                    <h5>Nomor Registrasi Kadus</h5>
                    <p>Kepala Dusun melakukan verifikasi akhir dan memberikan nomor registrasi surat.</p>
                </div>

                <!-- Step 06 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="350">
                    <div class="grid-step-number">06</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="9" y2="9"/><line x1="4" x2="20" y1="15" y2="15"/><line x1="10" x2="8" y1="3" y2="21"/><line x1="16" x2="14" y1="3" y2="21"/></svg>
                    </div>
                    <h5>Pengajuan ke Admin Desa</h5>
                    <p>Warga menyerahkan surat yang telah lengkap kepada Admin Desa.</p>
                </div>

                <!-- Step 07 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="grid-step-number">07</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <h5>Verifikasi Dokumen Admin</h5>
                    <p>Admin Desa melakukan verifikasi kelengkapan berkas dokumen.</p>
                </div>

                <!-- Step 08 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="450">
                    <div class="grid-step-number">08</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>
                    </div>
                    <h5>Proses Pembuatan Surat</h5>
                    <p>Surat diproses dan ditandatangani oleh Pemerintah Desa.</p>
                </div>

                <!-- Step 09 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="grid-step-number">09</div>
                    <div class="grid-icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h5>Surat Selesai & Diserahkan</h5>
                    <p>Surat resmi selesai diproses dan siap diambil oleh warga.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= TENTANG DESA / SEJARAH DESA (BAGIAN 1) ================= -->
    <section class="section-1" id="section-1-first">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="content-box">
                        <span class="section-kicker">Profil Desa</span>
                        <h3>{{ $data->subtittle }}</h3>
                        <p>{{ $data->section_text }}</p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="img-wrapper-modern">
                        @if(!empty($data->image_description1))
                            <img src="{{ asset('storage/' . $data->image_description1) }}" class="image-description1" alt="Visual Profil Desa Rambipuji 1">
                        @else
                            <img src="{{ asset('image/service/1.png') }}" class="image-description1" alt="Visual Profil Desa Rambipuji 1">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= TENTANG DESA / SEJARAH DESA (BAGIAN 2) ================= -->
    <section class="section-1" id="section-1-second">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="img-wrapper-modern">
                        @if(!empty($data->image_description2))
                            <img src="{{ asset('storage/' . $data->image_description2) }}" class="image-description2" alt="Visual Profil Desa Rambipuji 2">
                        @else
                            <img src="{{ asset('image/service/2.png') }}" class="image-description2" alt="Visual Profil Desa Rambipuji 2">
                        @endif
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="content-box">
                        <span class="section-kicker">Layanan & Informasi</span>
                        <h3>{{ $data->subtitle_2 ?? '' }}</h3>
                        <p id="section-second">{!! nl2br(e($data->section_second ?? '')) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= VISI DAN MISI SECTION ================= -->
    <section class="visi-misi-section" id="visi-misi-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-kicker">Landasan Pembangunan</span>
                <h2 class="section-title">Visi & Misi Desa</h2>
                <p class="section-subtitle">Komitmen Pemerintah Desa Rambipuji dalam memberikan pelayanan terbaik.</p>
            </div>
            <div class="row g-4">
                
                <!-- Card Visi -->
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="visi-card">
                        <div class="card-header-flex">
                            <div class="card-icon-badge">🎯</div>
                            <h2>Visi Desa</h2>
                        </div>
                        <p id="visi">{!! nl2br(e($data->visi ?? '')) !!}</p>
                    </div>
                </div>

                <!-- Card Misi -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="misi-card">
                        <div class="card-header-flex">
                            <div class="card-icon-badge">🚀</div>
                            <h2>Misi Desa</h2>
                        </div>
                        <p id="misi">{!! nl2br(e($data->misi ?? '')) !!}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    <!-- ================= FOOTER SECTION ================= -->
    <footer class="footer-section" id="footer-section">
        <div class="container">
            <div class="row g-4">
                
                <!-- Kolom 1: About Us -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <img src="{{ asset('image/logo/logo.png') }}" alt="Logo" width="40" height="40">
                            <h4 class="m-0">Desa Rambipuji</h4>
                        </div>
                        <p>{{ $data->about_us }}</p>
                        <div class="social-icons">
                            <a href="https://www.instagram.com/synexa._/" class="social-icon" target="_blank" aria-label="Instagram">
                                <img src="{{ asset('image/icons/instagram.png') }}" alt="Instagram">
                            </a>
                            <a href="mailto:desa.rambipuji@gmail.com" class="social-icon" aria-label="Email">
                                <img src="{{ asset('image/icons/email.png') }}" alt="Email">
                            </a>
                            <a href="https://wa.me/6285748782437" class="social-icon" target="_blank" aria-label="WhatsApp">
                                <img src="{{ asset('image/icons/whatsapp.png') }}" alt="WhatsApp">
                            </a>
                        </div>
                    </div>
                </div>
    
                <!-- Kolom 2: Contact Us -->
                <div class="col-lg-4 col-md-6">
                    <h4 class="footer-title">Kontak Kami</h4>
                    <ul class="contact-info-list">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span>+62 857-4878-2437</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <span>desa.rambipuji@gmail.com</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>Kantor Desa Rambipuji, Kabupaten Jember, Jawa Timur</span>
                        </li>
                    </ul>
                </div>
    
                <!-- Kolom 3: Google Maps Location -->
                <div class="col-lg-4 col-md-12">
                    <h4 class="footer-title">Peta Lokasi</h4>
                    <div class="map-card-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.92151770681!2d113.60142007500957!3d-8.210647691821597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd691bdc6c8f1b5%3A0x212afef9452e8eee!2sKantor%20Desa%20Rambipuji!5e0!3m2!1sid!2sid!4v1784638597422!5m2!1sid!2sid" width="100%" height="180" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" title="Lokasi Kantor Desa Rambipuji"></iframe>
                    </div>
                </div>
            </div>
    
            <!-- Copyright Row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-bottom">
                        <p class="copyright">
                            © 2026 Desa Rambipuji - Smart Digital Village. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- ================= JAVASCRIPT LIBRARIES ================= -->
    <script>
    // Sticky Glassmorphism Navbar Scroll Effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbarHeader');
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile Drawer Toggle Handlers
    function toggleMobileMenu() {
        const drawer = document.getElementById('mobileDrawer');
        const overlay = document.getElementById('mobileOverlay');
        const btn = document.getElementById('hamburgerBtn');
        drawer.classList.toggle('open');
        overlay.classList.toggle('open');
        btn.classList.toggle('active');
        document.body.classList.toggle('drawer-open');
    }

    function closeMobileMenu() {
        const drawer = document.getElementById('mobileDrawer');
        const overlay = document.getElementById('mobileOverlay');
        const btn = document.getElementById('hamburgerBtn');
        drawer.classList.remove('open');
        overlay.classList.remove('open');
        btn.classList.remove('active');
        document.body.classList.remove('drawer-open');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeMobileMenu();
    });
    </script>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Landing Page JS -->
    <script type="text/javascript" src="{{ asset('js/landingpage.js') }}"></script>
    
    @include('admin.layout.theme_switcher')
    <script src="{{ asset('js/theme-switcher.js') }}"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>