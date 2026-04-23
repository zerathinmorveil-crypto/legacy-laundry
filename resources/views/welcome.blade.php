<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Service - Kualitas Cucian Terbaik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue-dark:   #1a5fa8;
            --blue-mid:    #2980d4;
            --blue-light:  #d6e8f7;
            --blue-bg:     #c2d8ef;
            --white:       #ffffff;
            --orange:      #f97316;
            --orange-hover:#ea6510;
            --text-dark:   #0f2d52;
            --text-body:   #4a6280;
            --green:       #4caf50;
            --glass-bg: rgba(255,255,255,0.08);
            --glass-border: rgba(255,255,255,0.15);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            color: white;
            min-height: 100vh;
            background: linear-gradient(135deg, #0a0a0a, #1a1a1a, #2a2a2a);
        }
        
        /* ── NAVBAR ── */
        nav {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.15);
            padding: 14px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-logo .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--blue-mid);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-logo .logo-icon svg {
            width: 22px;
            height: 22px;
            fill: white;
        }

        .nav-logo span {
            font-family: 'Nunito', sans-serif;
            font-size: 13px;
            font-weight: 800;
            color: var(--blue-dark);
            line-height: 1.2;
            color: white
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-body);
            transition: color .2s;
            color: rgba(255,255,255,0.75);
        }

        .nav-links a:hover { color: white; }

        .nav-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1.5px solid rgba(255,255,255,0.2);
            border-radius: 24px;
            padding: 7px 16px;
        }

        .nav-search input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            width: 140px;
            color: white;
        }

        .nav-search input::placeholder {
            color: rgba(255,255,255,0.5); 
        }

        .nav-search svg { 
            stroke: rgba(255,255,255,0.6); 
        }

        .nav-search svg {
            width: 16px;
            height: 16px;
            stroke: var(--text-body);
            flex-shrink: 0;
        }

        nav, section, .stats, .section, footer {
            position: relative;
            z-index: 1;
        }

        /* ── LOGIN BUTTON ── */
        .btn-login {
            background: transparent;
            color: white;
            font-weight: 600;
            font-size: 14px;
            padding: 8px 20px;
            border: 1.5px solid rgba(255,255,255,0.4);
            border-radius: 24px;
            text-decoration: none;
            cursor: pointer;
            transition: all .2s ease;
            white-space: nowrap;
            backdrop-filter: blur(10px);
        }

        .btn-login:hover {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.7);
            transform: translateY(-1px);;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* ── HERO ── */
        .hero {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: calc(100vh - 70px);
        }

        .hero-content { animation: fadeUp .7s ease both; }

        .hero-eyebrow {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #6ee7b7;;
            margin-bottom: 14px;
        }

        .hero-title {
            font-family: 'Nunito', sans-serif;
            font-size: clamp(38px, 5vw, 58px);
            font-weight: 900;
            color: white;;
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .hero-subtitle {
            font-size: 18px;
            font-weight: 600;
            color: rgba(255,255,255,0.85);
            margin-bottom: 14px;
        }

        .hero-desc {
            font-size: 14px;
            color: rgba(255,255,255,0.65);
            line-height: 1.8;
            max-width: 420px;
            margin-bottom: 36px;
        }

        .btn-primary {
            display: inline-block;
            background: var(--orange);
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            padding: 13px 34px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background .2s, transform .2s, box-shadow .2s;
            box-shadow: 0 4px 20px rgba(249,115,22,.35);
        }

        .btn-primary:hover {
            background: var(--orange-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(249,115,22,.45);
        }

        /* ── HERO ILLUSTRATION ── */
        .hero-illustration {
            position: relative;
            height: 500px;
            animation: fadeIn .9s ease both .2s;
        }

        /* Blob shape behind everything */
        .blob {
            position: absolute;
            right: -30px;
            top: 20px;
            width: 380px;
            height: 420px;
            background: var(--white);
            border-radius: 60% 40% 55% 45% / 50% 60% 40% 50%;
            opacity: .55;
        }

        /* Washing machine */
        .machine-wrap {
            position: absolute;
            bottom: 30px;
            right: 30px;
            width: 200px;
        }

        /* SVG illustration placeholders — replaced by inline SVG below */
        .hero-illustration svg { width: 100%; height: 100%; }

        /* ── STATS BAR ── */
        .stats {
            max-width: 1200px;
            margin: 40px auto 0;
            padding: 0 48px;
            display: flex;
            gap: 32px;
        }

        .stat-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 16px;
            padding: 22px 28px;
            flex: 1;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform .2s;
        }

        .stat-card:hover { transform: translateY(-4px); }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon.blue   { background: #dbeafe; }
        .stat-icon.orange { background: #ffedd5; }
        .stat-icon.green  { background: #dcfce7; }

        .stat-icon svg { width: 24px; height: 24px; }

        .stat-number {
            font-family: 'Nunito', sans-serif;
            font-size: 26px;
            font-weight: 900;
            color: white;
        }

        .stat-label {
            font-size: 12px;
            color: rgba(255,255,255,0.65);
            font-weight: 500;
        }

        /* ── SERVICES ── */
        .section {
            max-width: 1200px;
            margin: 60px auto 0;
            padding: 0 48px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-tag {
            display: inline-block;
            background: rgba(255,255,255,0.12);
            color: #6ee7b7;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            padding: 5px 14px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Nunito', sans-serif;
            font-size: 34px;
            font-weight: 900;
            color: white;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .service-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 20px;
            padding: 32px 28px;
            box-shadow: 0 4px 20px rgba(26,95,168,.07);
            transition: transform .25s, box-shadow .25s;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.3);
            background: rgba(255,255,255,0.13);
        }

        .service-icon-wrap {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .service-icon-wrap svg { width: 30px; height: 30px; }

        .service-name {
            font-family: 'Nunito', sans-serif;
            font-size: 18px;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
        }

        .service-desc {
            font-size: 13px;
            color: rgba(255,255,255,0.65);
            line-height: 1.7;
        }

        /* ── FOOTER ── */
        footer {
            margin-top: 80px;
            background: rgba(0,0,0,0.3);
            color: rgba(255,255,255,.7);
            text-align: center;
            padding: 28px 48px;
            font-size: 13px;
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        footer strong { color:  white;  }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes gradientMove {
            0%   { transform: translate(0, 0) rotate(0deg); }
            50%  { transform: translate(-5%, -10%) rotate(180deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            nav { padding: 14px 24px; }
            .hero { grid-template-columns: 1fr; padding: 40px 24px 0; min-height: auto; }
            .hero-illustration { height: 320px; }
            .stats { flex-direction: column; padding: 0 24px; }
            .section { padding: 0 24px; }
            .services-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .nav-actions { gap: 8px; }
            .nav-search input { width: 100px; }
        }
    </style>
</head>
<body>

{{-- ══ NAVBAR ══ --}}
<nav>
    <a href="{{ url('/') }}" class="nav-logo">
        <div class="logo-icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 14a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
            </svg>
        </div>
        <span>Laundry<br>Service</span>
    </a>

    <ul class="nav-links">
        <li><a href="{{ url('/dashboard') }}">Home</a></li>
        <li><a href="{{ url('/services') }}">Service</a></li>
        <li><a href="{{ url('/gallery') }}">Gallery</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
    </ul>

    <div class="nav-actions">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-login">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-login">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary" style="padding: 8px 20px; font-size: 14px;">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

{{-- ══ HERO ══ --}}
<section id="home">
    <div class="hero">

        {{-- Left: Text --}}
        <div class="hero-content">
            <p class="hero-eyebrow">We Have The Best Washing Quality</p>
            <h1 class="hero-title">Laundry<br>Service</h1>
            <p class="hero-subtitle">Your clothes clean in a few minutes</p>
            <p class="hero-desc">
                Kami memberikan layanan laundry profesional dengan teknologi pencucian terkini.
                Pakaian Anda bersih, rapi, dan wangi — siap dipakai kembali!
            </p>
            <a href="#service" class="btn-primary">More Info</a>
        </div>

        

    </div>
</section>

{{-- ══ STATS ══ --}}
<div class="stats">
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="#2980d4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
        </div>
        <div>
            <div class="stat-number">5.000+</div>
            <div class="stat-label">Pelanggan Puas</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <svg viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                <polyline points="17 6 23 6 23 12"/>
            </svg>
        </div>
        <div>
            <div class="stat-number">10 Thn</div>
            <div class="stat-label">Pengalaman Kami</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div>
            <div class="stat-number">99%</div>
            <div class="stat-label">Kepuasan Pelanggan</div>
        </div>
    </div>
</div>

{{-- ══ SERVICES ══ --}}
<section id="service" class="section" style="padding-bottom: 20px;">
    <div class="section-header">
        <div class="section-tag">Layanan Kami</div>
        <h2 class="section-title">Pilih Layanan Terbaik</h2>
    </div>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="#2980d4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="18" rx="4"/>
                    <circle cx="12" cy="12" r="4"/>
                    <circle cx="12" cy="12" r="1"/>
                </svg>
            </div>
            <div class="service-name">Cuci + Kering</div>
            <p class="service-desc">Layanan cuci dan kering lengkap menggunakan mesin berteknologi tinggi. Pakaian bersih, kering, dan siap pakai dalam beberapa jam.</p>
        </div>
        <div class="service-card">
            <div class="service-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="#2980d4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3h18v4H3z"/>
                    <path d="M3 10h18v4H3z"/>
                    <path d="M3 17h18v4H3z"/>
                </svg>
            </div>
            <div class="service-name">Cuci + Setrika</div>
            <p class="service-desc">Pakaian dicuci bersih lalu disetrika rapi oleh tim profesional kami. Tampil percaya diri dengan pakaian bebas kusut setiap hari.</p>
        </div>
        <div class="service-card">
            <div class="service-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="#2980d4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="service-name">Layanan Ekspres</div>
            <p class="service-desc">Butuh pakaian bersih cepat? Layanan ekspres kami memproses cucian Anda dalam waktu 3 jam. Tersedia setiap hari termasuk hari libur.</p>
        </div>
    </div>
</section>

{{-- ══ FOOTER ══ --}}
<footer>
    <p>&copy; {{ date('Y') }} <strong>Laundry Service</strong>. Semua hak cipta dilindungi.</p>
</footer>

</body>
</html>
