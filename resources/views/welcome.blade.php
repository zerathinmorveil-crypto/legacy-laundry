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
            color: var(--text-dark);
            min-height: 100vh;
            background: #0f172a;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: linear-gradient(45deg, #667eea, #764ba2, #2980d4, #6ee7b7);
            animation: gradientMove 12s ease infinite;
            filter: blur(80px);
            opacity: 0.4;
            z-index: 0;
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
            padding: 60px 48px 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 40px;
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

        {{-- Right: Illustration --}}
        <div class="hero-illustration">
            <svg viewBox="0 0 520 480" xmlns="http://www.w3.org/2000/svg">
                <!-- Background blob -->
                <ellipse cx="300" cy="240" rx="210" ry="220" fill="white" opacity="0.55"/>

                <!-- Shelf / wall unit -->
                <rect x="310" y="60" width="140" height="14" rx="5" fill="#a8c4e0"/>
                <rect x="318" y="74" width="34" height="40" rx="4" fill="#6ba3cf"/>
                <rect x="357" y="74" width="22" height="40" rx="4" fill="#7fb5d8"/>
                <rect x="384" y="74" width="26" height="40" rx="4" fill="#5490c2"/>
                <!-- Detergent bottles on shelf -->
                <rect x="320" y="50" width="14" height="22" rx="4" fill="#f97316"/>
                <rect x="338" y="52" width="12" height="20" rx="4" fill="#2980d4"/>
                <rect x="354" y="53" width="10" height="19" rx="4" fill="#34d399"/>

                <!-- Washing machine body -->
                <rect x="280" y="230" width="160" height="170" rx="18" fill="#2980d4"/>
                <rect x="288" y="238" width="144" height="154" rx="14" fill="#1a5fa8"/>
                <!-- Door -->
                <circle cx="360" cy="315" r="55" fill="#4a9fd4"/>
                <circle cx="360" cy="315" r="46" fill="#c2d8ef"/>
                <circle cx="360" cy="315" r="38" fill="#5aaede"/>
                <circle cx="360" cy="315" r="28" fill="#2980d4"/>
                                <!-- Door shine -->
                <ellipse cx="348" cy="302" rx="10" ry="7" fill="white" opacity="0.35" transform="rotate(-20 348 302)"/>
                <!-- Controls -->
                <circle cx="300" cy="248" r="6" fill="#f97316"/>
                <rect x="312" y="243" width="30" height="10" rx="5" fill="#6ba3cf"/>
                <!-- Feet -->
                <rect x="300" y="398" width="20" height="12" rx="4" fill="#145089"/>
                <rect x="400" y="398" width="20" height="12" rx="4" fill="#145089"/>

                <!-- Stacked folded clothes (on machine top) -->
                <rect x="290" y="210" width="80" height="14" rx="4" fill="#f97316"/>
                <rect x="293" y="197" width="74" height="14" rx="4" fill="#34d399"/>
                <rect x="296" y="184" width="68" height="14" rx="4" fill="#fbbf24"/>

                <!-- Laundry basket (left floor) -->
                <path d="M80 380 Q70 370 75 340 L145 340 Q150 370 140 380 Z" fill="#4a9fd4"/>
                <rect x="73" y="338" width="76" height="10" rx="5" fill="#2980d4"/>
                <!-- Clothes sticking out -->
                <path d="M85 340 Q95 320 105 338" stroke="#f97316" stroke-width="8" fill="none" stroke-linecap="round"/>
                <path d="M110 340 Q120 318 130 340" stroke="#34d399" stroke-width="7" fill="none" stroke-linecap="round"/>

                <!-- Small orange basket (center floor) -->
                <path d="M185 390 Q175 375 180 350 L240 350 Q245 375 235 390 Z" fill="#f97316" opacity="0.85"/>
                <rect x="178" y="348" width="68" height="9" rx="4" fill="#ea6510"/>

                <!-- Detergent bottle floor -->
                <rect x="255" y="356" width="22" height="44" rx="6" fill="#fde68a"/>
                <rect x="260" y="350" width="12" height="10" rx="3" fill="#fbbf24"/>

                <!-- Laundry basket with clothes (right of machine) -->
                <path d="M455 390 Q444 374 448 348 L510 348 Q515 374 504 390 Z" fill="#4a9fd4"/>
                <rect x="446" y="346" width="70" height="10" rx="5" fill="#2980d4"/>
                <path d="M460 348 Q470 328 480 348" stroke="#f97316" stroke-width="8" fill="none" stroke-linecap="round"/>
                <path d="M484 348 Q494 325 504 348" stroke="#34d399" stroke-width="8" fill="none" stroke-linecap="round"/>

                <!-- Floor line -->
                <rect x="50" y="400" width="450" height="6" rx="3" fill="#a8c4e0" opacity="0.6"/>

                <!-- Green leaf left -->
                <ellipse cx="60" cy="350" rx="40" ry="55" fill="#4caf50" transform="rotate(25 60 350)"/>
                <ellipse cx="40" cy="360" rx="28" ry="45" fill="#66bb6a" transform="rotate(-15 40 360)"/>

                <!-- Green leaf right -->
                <ellipse cx="490" cy="345" rx="38" ry="52" fill="#4caf50" transform="rotate(-20 490 345)"/>
                <ellipse cx="510" cy="355" rx="26" ry="42" fill="#66bb6a" transform="rotate(12 510 355)"/>

                <!-- Woman character -->
                <!-- Body (jeans) -->
                <rect x="165" y="290" width="50" height="100" rx="10" fill="#3a6ea8"/>
                <!-- Legs -->
                <rect x="165" y="365" width="22" height="45" rx="8" fill="#2d5a8a"/>
                <rect x="193" y="365" width="22" height="45" rx="8" fill="#2d5a8a"/>
                <!-- Shoes -->
                <ellipse cx="176" cy="410" rx="16" ry="8" fill="#1a3a5c"/>
                <ellipse cx="204" cy="410" rx="16" ry="8" fill="#1a3a5c"/>
                <!-- Torso / shirt -->
                <rect x="160" y="230" width="60" height="70" rx="12" fill="#f97316"/>
                <!-- Arms -->
                <rect x="140" y="235" width="24" height="55" rx="10" fill="#f97316"/>
                <rect x="216" y="235" width="24" height="55" rx="10" fill="#f97316"/>
                <!-- Hands -->
                <ellipse cx="152" cy="295" rx="12" ry="10" fill="#f5cba7"/>
                <ellipse cx="228" cy="295" rx="12" ry="10" fill="#f5cba7"/>
                <!-- Head -->
                <circle cx="190" cy="205" r="34" fill="#f5cba7"/>
                <!-- Hair -->
                <path d="M158 195 Q165 150 200 148 Q235 150 222 195 Q215 170 190 168 Q165 170 158 195Z" fill="#8b4513"/>
                <path d="M222 195 Q240 220 225 240" stroke="#8b4513" stroke-width="14" fill="none" stroke-linecap="round"/>
                <!-- Sunglasses -->
                <rect x="170" y="200" width="20" height="12" rx="5" fill="#145089" opacity="0.85"/>
                <rect x="196" y="200" width="20" height="12" rx="5" fill="#145089" opacity="0.85"/>
                <line x1="190" y1="206" x2="196" y2="206" stroke="#145089" stroke-width="2"/>
                <!-- Mouth -->
                <path d="M182 220 Q190 228 198 220" stroke="#c0805a" stroke-width="2" fill="none" stroke-linecap="round"/>

                <!-- Laundry basket held by woman -->
                <path d="M135 260 Q128 248 130 228 L175 228 Q178 248 170 260 Z" fill="#f97316"/>
                <rect x="127" y="226" width="52" height="9" rx="4" fill="#ea6510"/>
                <!-- Colorful clothes in basket -->
                <path d="M136 228 Q143 212 151 228" stroke="#34d399" stroke-width="6" fill="none" stroke-linecap="round"/>
                <path d="M152 228 Q159 210 167 228" stroke="#3b82f6" stroke-width="6" fill="none" stroke-linecap="round"/>
                <path d="M144 228 Q150 215 156 228" stroke="#fbbf24" stroke-width="5" fill="none" stroke-linecap="round"/>
            </svg>
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