<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Digital Desa Rambipuji - Gerbang Layanan Desa & UMKM</title>
    <meta name="description" content="Portal Terintegrasi Desa Rambipuji. Akses cepat dan mudah untuk layanan administrasi desa dan platform UMKM Digital Desa Rambipuji.">

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS Scroll Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom Portal CSS & Theme Switcher CSS -->
    <link rel="stylesheet" href="{{ asset('css/portal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme-switcher.css') }}">
</head>
<body>

    <!-- ================= SECTION 1: NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg portal-navbar" id="portalNavbar">
        <div class="container">
            <a class="navbar-brand" href="#hero">
                <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa Rambipuji" class="brand-logo">
                <div class="d-flex flex-column">
                    <span class="brand-text">Portal Digital</span>
                    <span class="brand-subtext">Desa Rambipuji</span>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPortalContent" aria-controls="navbarPortalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarPortalContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- ================= SECTION 2: HERO ================= -->
    <section class="hero-section" id="hero">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="900">
                    <div class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        <span>Portal Terintegrasi Desa Rambipuji</span>
                    </div>
                    <h1 class="hero-title">Satu Portal Untuk Layanan Desa dan UMKM Digital</h1>
                    <p class="hero-desc">Portal Digital Desa Rambipuji menghadirkan layanan administrasi desa dan platform UMKM dalam satu akses yang mudah, cepat, dan modern.</p>
                    <div>
                        <a href="#layanan" class="btn-hero-primary">
                            <span>Pilih Layanan</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-duration="900" data-aos-delay="150">
                    <div class="hero-illustration-wrapper">
                        <!-- Premium Modern Vector Illustration: Smart Village & Digital Government -->
                        <svg class="hero-svg" viewBox="0 0 600 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Outer Glow & Ambient Backdrop -->
                            <circle cx="300" cy="250" r="210" fill="var(--primary)" fill-opacity="0.04"/>
                            <circle cx="300" cy="250" r="150" fill="var(--primary)" fill-opacity="0.06"/>
                            
                            <!-- Base Platform -->
                            <ellipse cx="300" cy="420" rx="220" ry="25" fill="#E2E8F0"/>
                            <ellipse cx="300" cy="415" rx="190" ry="20" fill="var(--primary-light)"/>

                            <!-- Government Building Landmark (Left Side of Portal) -->
                            <path d="M140 390 V260 L200 220 L260 260 V390 Z" fill="#FFFFFF" stroke="var(--primary)" stroke-width="4" stroke-linejoin="round"/>
                            <path d="M130 265 L200 215 L270 265 H130 Z" fill="var(--primary)"/>
                            <!-- Building Columns & Door -->
                            <rect x="160" y="280" width="16" height="110" rx="3" fill="var(--primary-light)" stroke="var(--primary)" stroke-width="2"/>
                            <rect x="192" y="280" width="16" height="110" rx="3" fill="var(--primary-light)" stroke="var(--primary)" stroke-width="2"/>
                            <rect x="224" y="280" width="16" height="110" rx="3" fill="var(--primary-light)" stroke="var(--primary)" stroke-width="2"/>
                            <path d="M185 390 V330 C185 320 215 320 215 330 V390 Z" fill="var(--primary-hover)"/>

                            <!-- UMKM Store / Marketplace Shop (Right Side of Portal) -->
                            <path d="M340 390 V270 H460 V390 Z" fill="#FFFFFF" stroke="var(--primary)" stroke-width="4" stroke-linejoin="round"/>
                            <!-- Awning Canopy -->
                            <path d="M330 270 C330 250 470 250 470 270 H330 Z" fill="var(--primary-hover)"/>
                            <path d="M330 270 Q 352.5 290 365 270 Q 387.5 290 400 270 Q 422.5 290 435 270 Q 457.5 290 470 270 V260 H330 V270 Z" fill="var(--primary)"/>
                            <!-- Shop Window & Product Display -->
                            <rect x="360" y="295" width="80" height="50" rx="6" fill="var(--primary-light)" stroke="var(--primary)" stroke-width="2"/>
                            <path d="M375 325 C375 310 425 310 425 325" stroke="var(--primary)" stroke-width="3" fill="none"/>
                            <rect x="375" y="360" width="50" height="30" rx="3" fill="var(--primary)"/>

                            <!-- Central Digital Gateway & Cloud Connectivity -->
                            <rect x="235" y="110" width="130" height="85" rx="16" fill="#FFFFFF" stroke="var(--primary)" stroke-width="4"/>
                            <path d="M260 152 L285 170 L340 128" stroke="var(--primary)" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                            
                            <!-- Floating Tech Badges / Connection Rays -->
                            <circle cx="160" cy="140" r="24" fill="#FFFFFF" stroke="var(--primary)" stroke-width="3"/>
                            <path d="M150 140 H170 M160 130 V150" stroke="var(--primary)" stroke-width="3" stroke-linecap="round"/>

                            <circle cx="440" cy="150" r="24" fill="#FFFFFF" stroke="var(--primary)" stroke-width="3"/>
                            <path d="M432 150 L438 156 L450 142" stroke="var(--primary)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>

                            <!-- Connection Lines -->
                            <path d="M184 140 Q 235 110 235 145" stroke="var(--primary)" stroke-width="3" stroke-dasharray="6 6" fill="none"/>
                            <path d="M365 145 Q 390 110 416 150" stroke="var(--primary)" stroke-width="3" stroke-dasharray="6 6" fill="none"/>

                            <!-- Small Decorative Smart Nodes -->
                            <circle cx="300" cy="70" r="10" fill="var(--primary)"/>
                            <path d="M300 80 V110" stroke="var(--primary)" stroke-width="3" stroke-dasharray="4 4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================= SECTION 3: PILIH LAYANAN ================= -->
    <section class="layanan-section" id="layanan">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Pilih Layanan Digital</h2>
                <p class="section-desc">Silakan pilih layanan yang ingin Anda akses.</p>
            </div>

            <div class="row g-4 justify-content-center">
                
                <!-- CARD 1: DIGITAL VILLAGE DESA RAMBIPUJI -->
                <div class="col-lg-6 col-md-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="portal-card">
                        <div class="card-icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 21h18"/>
                                <path d="M5 21V7l7-4 7 4v14"/>
                                <path d="M9 18h6"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                            </svg>
                        </div>
                        <h3 class="card-title">Digital Village Desa Rambipuji</h3>
                        <p class="card-desc">Platform pelayanan administrasi desa yang memudahkan masyarakat dalam pengajuan surat, pelacakan status surat, pengaduan masyarakat, dan akses informasi desa.</p>
                        
                        <ul class="features-list">
                            <li>
                                <span class="feature-check">✓</span>
                                <span>Pengajuan Surat Online</span>
                            </li>
                            <li>
                                <span class="feature-check">✓</span>
                                <span>Tracking Surat</span>
                            </li>
                            <li>
                                <span class="feature-check">✓</span>
                                <span>Pengaduan Masyarakat</span>
                            </li>
                            <li>
                                <span class="feature-check">✓</span>
                                <span>Informasi Desa</span>
                            </li>
                        </ul>

                        <div>
                            <a href="{{ url('/digital-village') }}" class="btn-card-primary">
                                Masuk Digital Village
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: UMKM DIGITAL DESA RAMBIPUJI -->
                <div class="col-lg-6 col-md-10" data-aos="fade-up" data-aos-delay="200">
                    <div class="portal-card">
                        <div class="card-icon-box">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                <line x1="3" y1="6" x2="21" y2="6"/>
                                <path d="M16 10a4 4 0 0 1-8 0"/>
                            </svg>
                        </div>
                        <h3 class="card-title">UMKM Digital Desa Rambipuji</h3>
                        <p class="card-desc">Platform digital untuk mendukung promosi dan pengembangan produk UMKM lokal Desa Rambipuji.</p>
                        
                        <ul class="features-list">
                            <li>
                                <span class="feature-check">✓</span>
                                <span>Katalog Produk</span>
                            </li>
                            <li>
                                <span class="feature-check">✓</span>
                                <span>Profil UMKM</span>
                            </li>
                            <li>
                                <span class="feature-check">✓</span>
                                <span>Promosi Produk</span>
                            </li>
                            <li>
                                <span class="feature-check">✓</span>
                                <span>Marketplace Digital</span>
                            </li>
                        </ul>

                        <div>
                            <a href="https://your-vercel-url.vercel.app" class="btn-card-outline" target="_blank" rel="noopener">
                                Masuk UMKM Digital
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================= SECTION 4: FOOTER ================= -->
    <footer class="portal-footer">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="footer-brand justify-content-center">
                        <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa Rambipuji" class="footer-logo">
                        <h4 class="footer-title">Portal Digital Desa Rambipuji</h4>
                    </div>
                    <p class="footer-desc mx-auto">
                        Mendukung transformasi digital desa melalui pelayanan publik dan pemberdayaan ekonomi masyarakat.
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="m-0">© 2026 Portal Digital Desa Rambipuji</p>
            </div>
        </div>
    </footer>

    <!-- Floating Theme Switcher Widget -->
    @include('admin.layout.theme_switcher')

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Theme Switcher Engine JS -->
    <script src="{{ asset('js/theme-switcher.js') }}"></script>

    <script>
        // Set default theme for Portal to Hijau Desa (#1B8F5A) if no saved theme exists
        if (!localStorage.getItem('desa_rambipuji_theme_color')) {
            if (window.applyThemeColor) {
                window.applyThemeColor('#1B8F5A', false);
            }
        }

        // Initialize AOS animations
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });

        // Active Nav Link Toggle & ScrollSpy
        const navLinks = document.querySelectorAll('.portal-navbar .nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Navbar Scroll & ScrollSpy Handler
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('portalNavbar');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Toggle active pill box based on scroll position
            const layananSection = document.getElementById('layanan');
            if (layananSection) {
                const layananTop = layananSection.offsetTop - 220;
                if (window.scrollY >= layananTop) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    const layananLink = document.querySelector('.portal-navbar .nav-link[href="#layanan"]');
                    if (layananLink) layananLink.classList.add('active');
                } else {
                    navLinks.forEach(l => l.classList.remove('active'));
                    const berandaLink = document.querySelector('.portal-navbar .nav-link[href="#hero"]');
                    if (berandaLink) berandaLink.classList.add('active');
                }
            }
        });

        // Close mobile navbar on link click
        document.querySelectorAll('.navbar-nav .nav-link').forEach(function(link) {
            link.addEventListener('click', function() {
                const navbarCollapse = document.getElementById('navbarPortalContent');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: true });
                    bsCollapse.hide();
                }
            });
        });
    </script>
</body>
</html>
