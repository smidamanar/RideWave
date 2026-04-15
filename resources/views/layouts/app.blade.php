<!doctype html>
<html lang="fr">
<head>
    <title>@yield('title', 'Covoit+ • Covoiturage en Tunisie')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    {{-- Legacy assets (kept for pages that still need them) --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* ═══════════════════════════════════════════
           DESIGN SYSTEM — shared by every page
        ═══════════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:      #0ea66a;
            --green-dark: #0b8a58;
            --green-light:#e6f7f0;
            --green-mid:  #cef0e0;
            --sand:       #faf8f4;
            --ink:        #0f1c14;
            --ink-mid:    #3d5247;
            --ink-soft:   #7a9186;
            --border:     #e4ede8;
            --white:      #ffffff;
            --radius-sm:  10px;
            --radius-md:  16px;
            --radius-lg:  24px;
            --radius-xl:  36px;
            --shadow-sm:  0 1px 3px rgba(10,50,30,.07), 0 4px 12px rgba(10,50,30,.05);
            --shadow-md:  0 4px 16px rgba(10,50,30,.10), 0 12px 36px rgba(10,50,30,.07);
            --shadow-lg:  0 8px 32px rgba(10,50,30,.12), 0 24px 64px rgba(10,50,30,.08);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: var(--white);
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, .brand { font-family: 'Sora', sans-serif; }

        /* ── Shared buttons ── */
        .btn-ghost {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
            color: var(--ink-mid);
            padding: 9px 18px;
            border-radius: var(--radius-xl);
            border: 1.5px solid var(--border);
            background: transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s;
        }
        .btn-ghost:hover {
            border-color: var(--green);
            color: var(--green-dark);
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            padding: 9px 22px;
            border-radius: var(--radius-xl);
            background: var(--green);
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.18s, transform 0.15s;
        }
        .btn-primary:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
        }
        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border: 1.5px solid var(--green);
            color: var(--green-dark);
            border-radius: var(--radius-xl);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.18s;
        }
        .btn-outline:hover { background: var(--green); color: #fff; }

        /* ── NAVBAR ── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            /* reset Bootstrap navbar padding */
            padding: 0;
        }
        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }
        .logo-mark {
            width: 38px; height: 38px;
            background: var(--green);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }
        .logo-text {
            font-family: 'Sora', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.5px;
        }
        .logo-text span { color: var(--green); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }
        .nav-links li.active > a,
        .nav-links a {
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            color: var(--ink-mid);
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            transition: color 0.18s, background 0.18s;
        }
        .nav-links li.active > a { color: var(--green); background: var(--green-light); }
        .nav-links a:hover { color: var(--ink); background: var(--green-light); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        /* Mobile toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--ink);
            cursor: pointer;
            padding: 6px;
        }
        .mobile-menu {
            display: none;
            padding: 12px 16px 20px;
            border-top: 1px solid var(--border);
            background: var(--white);
        }
        .mobile-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            font-size: 15px;
            font-weight: 500;
            color: var(--ink-mid);
            text-decoration: none;
            border-radius: var(--radius-sm);
            transition: background 0.15s;
        }
        .mobile-menu a:hover { background: var(--green-light); }

        /* ── FOOTER ── */
        footer {
            background: var(--ink);
            padding: 60px 24px 32px;
        }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }
        .footer-brand {
            font-size: 14px;
            color: rgba(255,255,255,0.45);
            line-height: 1.7;
            margin-top: 14px;
        }
        .footer-col-title {
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,0.9);
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul a {
            font-size: 14px;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            transition: color 0.15s;
        }
        .footer-col ul a:hover { color: #5de0a7; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .footer-copy { font-size: 13px; color: rgba(255,255,255,0.3); }
        .footer-socials { display: flex; gap: 10px; }
        .social-btn {
            width: 34px; height: 34px;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.4);
            font-size: 14px;
            text-decoration: none;
            transition: all 0.18s;
        }
        .social-btn:hover { border-color: rgba(93,224,167,0.5); color: #5de0a7; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .btn-ghost { display: none; }
            .footer-top { grid-template-columns: 1fr; gap: 24px; }
            .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
        }
        @media (max-width: 1024px) {
            .footer-top { grid-template-columns: 1fr 1fr; gap: 32px; }
        }
    </style>

    @stack('styles')
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<div class="site-wrap" id="home-section">

    {{-- ═══ NAVBAR ═══ --}}
    <nav class="navbar">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="nav-logo">
                <div class="logo-mark">🚗</div>
                <span class="logo-text">Covoit<span>+</span></span>
            </a>

            <ul class="nav-links">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="{{ request()->routeIs('services') ? 'active' : '' }}">
                    <a href="{{ route('services') }}">Services</a>
                </li>
                <li class="{{ request()->routeIs('cars') ? 'active' : '' }}">
                    <a href="{{ route('cars') }}">
                        <i class="fa-solid fa-magnifying-glass" style="font-size:11px;margin-right:4px;"></i>
                        Trouver un trajet
                    </a>
                </li>
                <li class="{{ request()->routeIs('blog') ? 'active' : '' }}">
                    <a href="{{ route('blog') }}">Blog</a>
                </li>
                <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}">À propos</a>
                </li>
            </ul>

            <div class="nav-actions">
                @auth
                    <a href="{{ route('profile.edit') }}" class="btn-ghost">
                        <i class="fa-solid fa-user" style="margin-right:6px;font-size:11px;"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-ghost">Se déconnecter</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost">Se connecter</a>
                    <a href="{{ route('register') }}" class="btn-primary">S'inscrire</a>
                @endauth
                <button class="mobile-toggle" onclick="toggleMenu()">
                    <i id="menu-icon" class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>

        <div class="mobile-menu" id="mobile-menu">
            <a href="{{ route('home') }}"><i class="fa-solid fa-house" style="color:var(--green);"></i> Accueil</a>
            <a href="{{ route('services') }}"><i class="fa-solid fa-check-to-slot" style="color:var(--green);"></i> Services</a>
            <a href="{{ route('cars') }}"><i class="fa-solid fa-magnifying-glass" style="color:var(--green);"></i> Trouver un trajet</a>
            <a href="{{ route('blog') }}"><i class="fa-solid fa-newspaper" style="color:var(--green);"></i> Blog</a>
            <a href="{{ route('about') }}"><i class="fa-solid fa-circle-info" style="color:var(--green);"></i> À propos</a>
            <a href="{{ route('trajets.create') }}"><i class="fa-solid fa-plus" style="color:var(--green);"></i> Proposer un trajet</a>
            @auth
                <a href="{{ route('profile.edit') }}"><i class="fa-solid fa-cog" style="color:var(--green);"></i> Mon profil</a>
                @if(Auth::user()->role === 'conducteur')
                    <a href="{{ route('vehicules.index') }}"><i class="fa-solid fa-car" style="color:var(--green);"></i> Mes véhicules</a>
                    <a href="{{ route('trajets.my') }}"><i class="fa-solid fa-road" style="color:var(--green);"></i> Mes trajets</a>
                @endif
                @if(Auth::user()->role === 'passager')
                    <a href="{{ route('reservations.my') }}"><i class="fa-solid fa-ticket" style="color:var(--green);"></i> Mes réservations</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="padding:8px 16px;">
                    @csrf
                    <button type="submit" style="background:none;border:none;font-size:15px;font-weight:500;color:var(--ink-mid);cursor:pointer;display:flex;align-items:center;gap:10px;">
                        <i class="fa-solid fa-right-from-bracket" style="color:var(--green);"></i> Se déconnecter
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket" style="color:var(--green);"></i> Se connecter</a>
                <a href="{{ route('register') }}"><i class="fa-solid fa-user-plus" style="color:var(--green);"></i> S'inscrire gratuitement</a>
            @endauth
        </div>
    </nav>

    {{-- ═══ PAGE CONTENT ═══ --}}
    @yield('content')

    {{-- ═══ FOOTER ═══ --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:34px;height:34px;background:var(--green);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;">🚗</div>
                        <span style="font-family:'Sora',sans-serif;font-size:18px;font-weight:700;color:#fff;letter-spacing:-0.5px;">Covoit<span style="color:#5de0a7;">+</span></span>
                    </div>
                    <p class="footer-brand">Covoiturage éco-responsable et sécurisé partout en Tunisie. Voyagez plus malin, ensemble.</p>
                </div>
                <div class="footer-col">
                    <p class="footer-col-title">Passager</p>
                    <ul>
                        <li><a href="{{ route('cars') }}">Trouver un trajet</a></li>
                        <li><a href="{{ Auth::check() ? route('reservations.my') : route('login') }}">Mes réservations</a></li>
                        <li><a href="#how-it-works">Comment ça marche</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <p class="footer-col-title">Conducteur</p>
                    <ul>
                        <li><a href="{{ Auth::check() ? route('trajets.create') : route('login') }}">Proposer un trajet</a></li>
                        <li><a href="{{ Auth::check() ? route('vehicules.index') : route('login') }}">Mes véhicules</a></li>
                        <li><a href="{{ Auth::check() ? route('trajets.my') : route('login') }}">Mes trajets</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <p class="footer-col-title">Covoit+</p>
                    <ul>
                        <li><a href="#">Sécurité</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('contact') }}">Nous contacter</a></li>
                        <li><a href="#">Conditions d'utilisation</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copy">© 2026 Covoit+ — Made with ❤️ in Tunis</p>
                <div class="footer-socials">
                    <a href="#" class="social-btn"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="social-btn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>

</div>{{-- .site-wrap --}}

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');
        const open = menu.style.display === 'block';
        menu.style.display = open ? 'none' : 'block';
        icon.className = open ? 'fa-solid fa-bars' : 'fa-solid fa-xmark';
    }
</script>

@stack('scripts')
</body>
</html>