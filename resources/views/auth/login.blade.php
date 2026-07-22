<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Desa Rambipuji</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0057A6;
            --primary-hover: #004382;
            --primary-light: #f0f7ff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            background-color: #ffffff;
            background-image: 
                radial-gradient(at 0% 0%, rgba(0, 87, 166, 0.04) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 144, 203, 0.04) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(248, 250, 252, 1) 0px, transparent 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 24px 16px;
            color: var(--text-main);
        }

        .back-link {
            position: absolute;
            top: 24px;
            left: 24px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 50px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: all 0.25s ease;
        }

        .back-link:hover {
            color: var(--primary-color);
            border-color: var(--primary-color);
            background: var(--primary-light);
            transform: translateX(-3px);
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            margin: auto;
        }

        .login-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 
                0 20px 40px -15px rgba(0, 87, 166, 0.07),
                0 10px 15px -5px rgba(0, 0, 0, 0.02);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .header-login {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: #ffffff;
            border-radius: 20px;
            padding: 8px;
            margin-bottom: 16px;
            box-shadow: 0 8px 20px rgba(0, 87, 166, 0.08);
            border: 1px solid #edf2f7;
        }

        .logo-desa {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .header-login h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.45rem;
            color: var(--text-main);
            margin-bottom: 4px;
            letter-spacing: -0.3px;
        }

        .header-login .sub-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 6px;
            letter-spacing: 0.2px;
        }

        .header-login .desc-text {
            font-size: 0.825rem;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            font-size: 1.1rem;
            z-index: 5;
            transition: color 0.2s ease;
            pointer-events: none;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 16px 12px 48px;
            font-size: 0.925rem;
            font-weight: 500;
            color: var(--text-main);
            background-color: #f8fafc;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(0, 87, 166, 0.12);
            outline: none;
        }

        .form-control-custom:focus + .input-icon,
        .input-group-custom:focus-within .input-icon {
            color: var(--primary-color);
        }

        .toggle-password-btn {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #94a3b8;
            padding: 6px 8px;
            cursor: pointer;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease, background-color 0.2s ease;
            z-index: 5;
        }

        .toggle-password-btn:hover {
            color: var(--primary-color);
            background-color: #f1f5f9;
        }

        .btn-login {
            background: linear-gradient(135deg, #0057A6 0%, #004382 100%);
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 8px 20px rgba(0, 87, 166, 0.25);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #004382 0%, #003263 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0, 87, 166, 0.32);
            color: #ffffff;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-custom {
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 12px;
            padding: 12px 16px;
            border: none;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-custom-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-custom-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .footer-text {
            text-align: center;
            margin-top: 28px;
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .footer-text a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .back-link {
                position: static;
                margin-bottom: 20px;
                align-self: flex-start;
            }

            .login-card {
                padding: 28px 20px;
                border-radius: 20px;
            }

            .header-login h3 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

    <!-- Tombol Kembali ke Landing Page -->
    <a href="{{ url('/') }}" class="back-link">
        <i class="bi bi-arrow-left"></i>
        <span>Kembali ke Beranda</span>
    </a>

    <div class="login-wrapper">
        <div class="login-card">

            <!-- Header Login & Logo Desa Rambipuji -->
            <div class="header-login">
                <div class="logo-wrapper">
                    <img src="{{ asset('image/logo/logo.png') }}" alt="Logo Desa Rambipuji" class="logo-desa">
                </div>
                <h3>Sistem Desa Digital</h3>
                <div class="sub-title">Desa Rambipuji • Kabupaten Jember</div>
                <p class="desc-text">Masukkan NIK dan password akun Anda untuk masuk</p>
            </div>

            <!-- Session Alerts -->
            @if(session('success'))
                <div class="alert alert-custom alert-custom-success" id="alert-success">
                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-custom alert-custom-danger" id="alert-error">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login.proses') }}" method="POST">
                @csrf

                <!-- Input NIK -->
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                    <div class="input-group-custom">
                        <i class="bi bi-person-vcard input-icon"></i>
                        <input type="text" 
                               id="nik" 
                               name="nik" 
                               class="form-control-custom" 
                               placeholder="Masukkan NIK Anda" 
                               autocomplete="username"
                               required 
                               autofocus>
                    </div>
                </div>

                <!-- Input Password -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label mb-0">Kata Sandi</label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none small fw-semibold" style="color: var(--primary-color); font-size: 0.8rem;">Lupa Kata Sandi?</a>
                        @endif
                    </div>
                    <div class="input-group-custom">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control-custom" 
                               placeholder="Masukkan Kata Sandi" 
                               style="padding-right: 48px;"
                               autocomplete="current-password"
                               required>
                        <button type="button" class="toggle-password-btn" id="togglePassword" aria-label="Tampilkan Kata Sandi">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-login">
                    <span>Masuk ke Akun</span>
                    <i class="bi bi-arrow-right-short fs-4"></i>
                </button>
            </form>

            <div class="footer-text">
                © 2026 Pemerintah Desa Rambipuji
            </div>
        </div>
    </div>

    <script>
        // Toggle Show / Hide Password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                
                if (isPassword) {
                    toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
                    togglePassword.setAttribute('aria-label', 'Sembunyikan Kata Sandi');
                } else {
                    toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
                    togglePassword.setAttribute('aria-label', 'Tampilkan Kata Sandi');
                }
            });
        }

        // Auto dismiss alert notifications after 4 seconds
        setTimeout(() => {
            const alertSuccess = document.getElementById('alert-success');
            const alertError = document.getElementById('alert-error');
            
            if (alertSuccess) {
                alertSuccess.style.transition = 'opacity 0.5s ease';
                alertSuccess.style.opacity = '0';
                setTimeout(() => alertSuccess.remove(), 500);
            }
            if (alertError) {
                alertError.style.transition = 'opacity 0.5s ease';
                alertError.style.opacity = '0';
                setTimeout(() => alertError.remove(), 500);
            }
        }, 4000);
    </script>

</body>
</html>