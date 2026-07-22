<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Village</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> --}}

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>     

    <body>

        <section class="header-section">
    <div class="container-fluid px-4">
        <div class="nav-wrapper">

            <!-- LOGO -->
            <a href="#hero-section" class="logo-container">
                <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa" class="logo-img">
                <div class="logo-text">
                    <span class="logo-name">Desa Rambipuji</span>
                    <span class="logo-sub">Kabupaten Jember</span>
                </div>
            </a>

            <!-- DESKTOP NAV -->
            <nav class="desktop-nav">
                <ul>
                    <li><a href="#hero-section">Beranda</a></li>
                    <li><a href="#section-1-first">Layanan</a></li>
                    <li><a href="#footer-section">Tentang Kami</a></li>
                    <li><a href="{{ route('login') }}" class="nav-login">Login</a></li>
                </ul>
            </nav>

            <!-- HAMBURGER BUTTON -->
            <button class="hamburger" id="hamburgerBtn" onclick="toggleMobileMenu()" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</section>

<!-- MOBILE DRAWER OVERLAY -->
<div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>

<!-- MOBILE DRAWER -->
<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-header">
        <div class="logo-container">
            <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa" class="logo-img">
            <div class="logo-text">
                <span class="logo-name">Desa Rambipuji</span>
                <span class="logo-sub">Kabupaten Jember</span>
            </div>
        </div>
        <button class="drawer-close" onclick="closeMobileMenu()">✕</button>
    </div>
    <nav class="drawer-nav">
        <ul>
            <li><a href="#hero-section" onclick="closeMobileMenu()">
                <span class="drawer-icon">🏠</span> Beranda
            </a></li>
            <li><a href="#section-1-first" onclick="closeMobileMenu()">
                <span class="drawer-icon">⚙️</span> Layanan
            </a></li>
            <li><a href="#footer-section" onclick="closeMobileMenu()">
                <span class="drawer-icon">ℹ️</span> Tentang Kami
            </a></li>
            <li class="drawer-login">
                <a href="{{ route('login') }}">
                    <span class="drawer-icon">🔐</span> Login
                </a>
            </li>
        </ul>
    </nav>
    <div class="drawer-footer">
        <p>© 2026 Desa Rambipuji</p>
    </div>
</div>


    <section class="hero-section" id="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="left-section">
                        <h1>{{ $data->judul }}</h1>
                        <p>{{ $data->deskripsi1 }}</p>
                        <div class="d-flex">
                            <a href="{{ asset('downloads/Digital-Village.apk') }}" class="contact-button" download>Download</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('image/coroseul/flash1.png') }}" alt="Slide 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('image/coroseul/flash2.png') }}" alt="Slide 2">
                            </div>
                        </div>
    
                        <!-- Custom Indicators -->
                        {{-- <div class="carousel-indicators-custom">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div> --}}
    
                        <!-- Custom Controls -->
                        {{-- <div class="carousel-controls-bottom">
                            <div class="carousel-nav-buttons">
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">&#8592;</button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide="next">&#8594;</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="service-section" id="service-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                   <div class="inner">
                        <img src="{{ asset('image/service/1.png') }}" alt="">
                        <div class="service">
                            <h1>Website</h1>
                            <p>
                                Pusat informasi dan e-form Desa Rambipuji
                            </p>
                        </div>
                   </div>
                </div>
                <div class="col-lg-4">
                     <div class="inner">
                         <img src="{{ asset('image/service/2.png') }}" alt="">
                         <div class="service">
                             <h1>Pengajuan Surat</h1>
                             <p>
                                 Ajukan dokumen resmi tanpa antre
                             </p>
                         </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="inner">
                         <img src="{{ asset('image/service/4.png') }}" alt="">
                         <div class="service">
                             <h1>Aplikasi Mobile </h1>
                             <p>
                                  Layanan desa dalam genggaman anda
                             </p>
                         </div>
                     </div>
                  </div>
            </div>
        </div>
    </section>
    <section class="dummy-section" id="dummy-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Aplikasi Desa Digital : Semua Layanan Surat Kini dalam Genggaman </h3>
                    <p>
                        Ajukan Akta Kelahiran, Kartu Keluarga, KTP, dan beragam surat lainya 
                        <br>tanpa antre cukup menggunakan handphone
                    </p>
                </div>
            </div>
        </div>
    </section>

            <!-- ALUR PENGAJUAN SURAT SECTION -->
    <section class="alur-section bg-light" id="alur-section" style="padding-top: 100px; padding-bottom: 100px;">
        <div class="container alur-grid-container" style="max-width: 1250px;">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold" style="color: #2c3e50;">Alur Pengajuan Surat</h2>
                <p class="text-muted">Ikuti langkah-langkah berikut untuk mengajukan surat di Desa Rambipuji.</p>
            </div>
            
            <div class="alur-grid">
                
                <!-- Step 01 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="grid-step-number">01</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Permohonan Surat ke Ketua RT</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Warga mengajukan permohonan surat pengantar kepada Ketua RT.</p>
                </div>
                
                <!-- Step 02 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="grid-step-number">02</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Verifikasi dan Tanda Tangan Ketua RT</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Ketua RT melakukan verifikasi data dan memberikan tanda tangan.</p>
                </div>

                <!-- Step 03 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="grid-step-number">03</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Tanda Tangan Ketua RW</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Warga meminta tanda tangan Ketua RW.</p>
                </div>

                <!-- Step 04 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="grid-step-number">04</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Tanda Tangan Kepala Dusun</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Warga meminta tanda tangan Kepala Dusun.</p>
                </div>

                <!-- Step 05 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="grid-step-number">05</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Kepala Dusun Memberikan Nomor Registrasi</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Kepala Dusun melakukan verifikasi akhir dan memberikan nomor registrasi surat.</p>
                </div>

                <!-- Step 06 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="grid-step-number">06</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><line x1="4" x2="20" y1="9" y2="9"/><line x1="4" x2="20" y1="15" y2="15"/><line x1="10" x2="8" y1="3" y2="21"/><line x1="16" x2="14" y1="3" y2="21"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Pengajuan ke Admin Desa</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Warga menyerahkan surat yang telah lengkap kepada Admin Desa.</p>
                </div>

                <!-- Step 07 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="700">
                    <div class="grid-step-number">07</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Verifikasi Dokumen oleh Admin Desa</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Admin Desa melakukan verifikasi dokumen.</p>
                </div>

                <!-- Step 08 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="800">
                    <div class="grid-step-number">08</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Proses Pembuatan Surat</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Surat diproses oleh Pemerintah Desa.</p>
                </div>

                <!-- Step 09 -->
                <div class="alur-grid-card" data-aos="fade-up" data-aos-delay="900">
                    <div class="grid-step-number">09</div>
                    <div class="grid-icon-wrapper">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-main"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h5 class="fw-bold mt-3 mb-2 text-dark" style="font-size: 1.1rem;">Surat Selesai dan Diserahkan kepada Warga</h5>
                    <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">Surat selesai dan dapat diambil oleh warga.</p>
                </div>

            </div>
        </div>
    </section>
    <section class="section-1" id="section-1-first">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-3">{{ $data->subtittle }}</h3>
                    <p>{{ $data->section_text }}</p>
                </div>
                <div class="col-lg-6">
                <?php if (!empty($data['image_description1'])): ?>
                    <div class="text-center" style="max-width: 90%; margin: auto;">
                        <img src="{{ asset('storage/' . $data->image_description1) }}" style="width: 100%; max-width: 500px; height: auto; border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);" class="image-description1" alt="Description Image">
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="section-1" id="section-1-second">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                <?php if (!empty($data['image_description2'])): ?>
                    <div class="text-center" style="max-width: 90%; margin: auto;">
                        <img src="{{ asset('storage/' . $data->image_description2) }}" style="width: 100%; max-width: 500px; height: auto; border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);" class="image-description2" alt="Description Image2">
                    </div>
                <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <h3 class="mb-3">{{ $data->subtitle_2 ?? '' }}</h3>
                    <p id="section-second">{{ nl2br(e($data->section_second ?? '')) }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="visi-misi-section">
        <div class="container">
            <div class="row">
                <div class="col visi">
                    <h2>Visi</h2>
                    <p id="visi">{{ nl2br(e($data->visi ?? '')) }}</p>
                </div>
                <div class="col misi">
                    <h2>Misi</h2>
                    <p id="misi">{{ nl2br(e($data->misi ?? '')) }}</p>
                </div>
            </div>
        </div>
    </section>
    
    
    <footer class="footer-section" id="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>About Us</h4>
                    <p>{{ $data->about_us }}</p>
                </div>
    
                <div class="col-lg-4 text-center">
                    <h4>Connect</h4>
                    <hr style="width: 50px; border: 1px solid #fff; margin: 10px auto;">
                    <div class="social-icons">
                        <a href="https://www.instagram.com/synexa._/" class="social-icon" target="_blank">
                            <img src="{{ asset('image/icons/instagram.png') }}" alt="Instagram">
                        </a>
                        <a href="mailto:desa.rambipuji@gmail.com" class="social-icon">
                            <img src="{{ asset('image/icons/email.png') }}" alt="Email">
                        </a>
                        <a href="https://wa.me/6285748782437" class="social-icon" target="_blank">
                            <img src="{{ asset('image/icons/whatsapp.png') }}" alt="WhatsApp">
                        </a>
                    </div>
                </div>
    
                <div class="col-lg-4">
                    <h4>Contact Us</h4>
                    <p>Email: desa.rambipuji@gmail.com</p>
                    <p>Phone: +62 857-4878-2437</p>
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.92151770681!2d113.60142007500957!3d-8.210647691821597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd691bdc6c8f1b5%3A0x212afef9452e8eee!2sKantor%20Desa%20Rambipuji!5e0!3m2!1sid!2sid!4v1784638597422!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                </div>
            </div>
    
            <div class="row mt-4">
                <div class="col-lg-12 text-center">
                    <p class="copyright">
                        © 2026 Desa Rambipuji. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
        <script>
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

    // Close on ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeMobileMenu();
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/landingpage.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>