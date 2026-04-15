@extends('layouts.app')
@section('title', 'À propos • Covoit+ | Covoiturage en Tunisie')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        *, *::before, *::after { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
        }
        :root {
            --green: #0ea66a;
            --green-dark: #0b8a58;
            --green-light: #e6f7f0;
            --green-mid: #cef0e0;
            --sand: #faf8f4;
            --ink: #0f1c14;
            --ink-mid: #3d5247;
            --ink-soft: #7a9186;
            --border: #e4ede8;
            --white: #ffffff;
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 36px;
            --shadow-sm: 0 1px 3px rgba(10,50,30,0.07), 0 4px 12px rgba(10,50,30,0.05);
            --shadow-md: 0 4px 16px rgba(10,50,30,0.1), 0 12px 36px rgba(10,50,30,0.07);
            --shadow-lg: 0 8px 32px rgba(10,50,30,0.12), 0 24px 64px rgba(10,50,30,0.08);
        }
        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: var(--white);
            -webkit-font-smoothing: antialiased;
            line-height: 1.7;
        }
        h1, h2, h3, h4 { 
            font-family: 'Sora', sans-serif; 
            font-weight: 600; 
        }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
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
        }
        .logo-mark {
            width: 38px; 
            height: 38px;
            background: var(--green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
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
        .nav-links a {
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            color: var(--ink-mid);
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            transition: all 0.18s;
        }
        .nav-links a:hover, .nav-links a.active {
            color: var(--ink);
            background: var(--green-light);
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-ghost, .btn-primary {
            font-size: 14px;
            font-weight: 500;
            padding: 9px 18px;
            border-radius: var(--radius-xl);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s;
        }
        .btn-ghost {
            color: var(--ink-mid);
            border: 1.5px solid var(--border);
            background: transparent;
        }
        .btn-ghost:hover { 
            border-color: var(--green); 
            color: var(--green-dark); 
        }
        .btn-primary {
            color: #fff;
            background: var(--green);
            border: none;
        }
        .btn-primary:hover { 
            background: var(--green-dark); 
            transform: translateY(-1px); 
        }

        /* About Hero */
        .about-hero {
            background: linear-gradient(rgba(15,28,20,0.78), rgba(15,28,20,0.78)), 
                        url('https://picsum.photos/id/1015/2000/900') center/cover no-repeat;
            color: #fff;
            padding: 140px 24px 100px;
            text-align: center;
            position: relative;
        }
        .about-hero h1 {
            font-size: 52px;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 20px;
        }
        .about-hero p {
            font-size: 20px;
            max-width: 680px;
            margin: 0 auto;
            opacity: 0.95;
        }

        /* Main Content */
        .about-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 80px 24px 100px;
        }

        .section {
            margin-bottom: 90px;
        }

        .section h2 {
            font-size: 36px;
            margin-bottom: 24px;
            color: var(--ink);
        }

        .section p {
            font-size: 17px;
            color: var(--ink-soft);
            max-width: 720px;
            margin-bottom: 28px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
            margin-top: 40px;
        }

        .value-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px 28px;
            transition: all 0.3s;
        }
        .value-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
            border-color: var(--green);
        }
        .value-card i {
            font-size: 42px;
            color: var(--green);
            margin-bottom: 20px;
        }
        .value-card h3 {
            font-size: 22px;
            margin-bottom: 12px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            background: var(--green-light);
            padding: 60px 40px;
            border-radius: var(--radius-xl);
            text-align: center;
            margin: 60px 0;
        }
        .stat-item h3 {
            font-size: 42px;
            color: var(--green-dark);
            margin-bottom: 8px;
        }
        .stat-item p {
            color: var(--ink-mid);
            font-weight: 500;
        }

        .team {
            text-align: center;
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 32px;
            margin-top: 50px;
        }
        .team-member {
            text-align: center;
        }
        .team-member img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 16px;
            border: 4px solid var(--green-light);
        }
        .team-member h4 {
            margin-bottom: 4px;
        }
        .team-member span {
            color: var(--green);
            font-size: 14px;
        }

        /* Footer */
        footer {
            background: var(--ink);
            color: #ddd;
            padding: 80px 24px 40px;
        }
        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 40px;
            border-top: 1px solid #33443c;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .footer-copy {
            color: #aaa;
        }
        .footer-socials a {
            color: #ddd;
            font-size: 20px;
            margin-left: 18px;
            transition: color 0.2s;
        }
        .footer-socials a:hover {
            color: var(--green);
        }

        @media (max-width: 768px) {
            .about-hero h1 { font-size: 42px; }
            .about-hero { padding: 100px 24px 80px; }
        }
    </style>
@endpush

@section('content')

<!-- ABOUT HERO -->
<header class="about-hero">
    <div style="max-width: 800px; margin: 0 auto;">
        <span style="background: rgba(255,255,255,0.15); padding: 8px 22px; border-radius: 999px; font-size: 14px; font-weight: 500;">Depuis 2024 • Tunisie</span>
        <h1>Nous rendons le covoiturage simple, fiable et accessible à tous</h1>
        <p>Connecter les Tunisiens pour des trajets plus économiques, plus écologiques et plus humains.</p>
    </div>
</header>

<div class="about-container">

    <div class="section">
        <h2>Notre histoire</h2>
        <p>Covoit+ est né en Tunisie d’un constat simple : les trajets quotidiens sont trop chers, trop polluants et souvent solitaires.</p>
        <p>Nous avons créé une plateforme moderne de covoiturage qui met en relation conducteurs et passagers de manière sécurisée, tout en respectant les réalités tunisiennes : routes, culture, et modes de vie.</p>
    </div>

    <div class="section">
        <h2>Nos valeurs</h2>
        <div class="values-grid">
            <div class="value-card">
                <i class="fa-solid fa-leaf"></i>
                <h3>Écologie</h3>
                <p>Chaque trajet partagé réduit les émissions de CO₂ et contribue à un avenir plus vert pour la Tunisie.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-wallet"></i>
                <h3>Économie</h3>
                <p>Nous aidons les Tunisiens à économiser jusqu’à 60% sur leurs déplacements quotidiens ou longue distance.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-shield-halved"></i>
                <h3>Confiance & Sécurité</h3>
                <p>Vérification des profils, avis, et système de notation pour des trajets sereins.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-users"></i>
                <h3>Communauté</h3>
                <p>Nous croyons en la solidarité et les rencontres humaines que permet le covoiturage.</p>
            </div>
        </div>
    </div>

    <div class="stats">
        <div class="stat-item">
            <h3>{{ number_format($stats['trajets']) }}</h3>
            <p>Trajets partagés</p>
        </div>
        <div class="stat-item">
            <h3>{{ number_format($stats['conducteurs']) }}</h3>
            <p>Conducteurs</p>
        </div>
        <div class="stat-item">
            <h3>{{ number_format($stats['passagers']) }}</h3>
            <p>Passagers</p>
        </div>
        <div class="stat-item">
            <h3>{{ number_format($stats['reservations']) }}</h3>
            <p>Réservations</p>
        </div>
    </div>

    <div class="section team">
        <h2>Une équipe passionnée par la mobilité en Tunisie</h2>
        <div class="team-grid">
            <div class="team-member">
                <img src="https://picsum.photos/id/64/300/300" alt="Founder">
                <h4>Ahmed Ben Salah</h4>
                <span>Fondateur & CEO</span>
            </div>
            <div class="team-member">
                <img src="https://picsum.photos/id/201/300/300" alt="Co-founder">
                <h4>Leila Trabelsi</h4>
                <span>Directrice Opérations</span>
            </div>
            <div class="team-member">
                <img src="https://picsum.photos/id/251/300/300" alt="CTO">
                <h4>Mohamed Karray</h4>
                <span>Lead Developer</span>
            </div>
        </div>
    </div>

</div>

@endsection