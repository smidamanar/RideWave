@extends('layouts.app')
@section('title', 'Covoit+ • Covoiturage en Tunisie')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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
        }

        h1, h2, h3, .brand { font-family: 'Sora', sans-serif; }

        /* ───── NAVBAR ───── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
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
            flex-shrink: 0;
        }
        .logo-mark {
            width: 38px; height: 38px;
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
            transition: color 0.18s, background 0.18s;
        }
        .nav-links a:hover {
            color: var(--ink);
            background: var(--green-light);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }
        .btn-ghost {
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

        /* ───── HERO ───── */
.hero {
    background: var(--ink);
    position: relative;
    overflow: hidden;
    min-height: 560px;
    display: flex;
    align-items: center;
}
.hero-bg-photo {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0.15;
    z-index: 0;
    mix-blend-mode: luminosity;
}
        .hero-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.06;
            background-image: radial-gradient(circle, #fff 1.5px, transparent 1.5px);
            background-size: 28px 28px;
        }
        .hero-glow {
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14,166,106,0.4) 0%, transparent 70%);
            top: -200px; right: -100px;
            pointer-events: none;
        }
        .hero-glow-2 {
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14,166,106,0.18) 0%, transparent 70%);
            bottom: -100px; left: 50px;
            pointer-events: none;
        }
        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 24px;
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 480px;
            gap: 60px;
            align-items: center;
            width: 100%;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(14,166,106,0.18);
            border: 1px solid rgba(14,166,106,0.35);
            color: #5de0a7;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: 24px;
        }
        .pulse-dot {
            width: 8px; height: 8px;
            background: #5de0a7;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }
        .hero-title {
            font-size: 52px;
            font-weight: 700;
            line-height: 1.08;
            letter-spacing: -2px;
            color: #fff;
            margin-bottom: 20px;
        }
        .hero-title em {
            font-style: normal;
            color: #5de0a7;
        }
        .hero-subtitle {
            font-size: 17px;
            color: rgba(255,255,255,0.6);
            line-height: 1.6;
            max-width: 440px;
            margin-bottom: 36px;
        }
        .hero-stats {
            display: flex;
            gap: 32px;
        }
        .hero-stat-value {
            font-family: 'Sora', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
        }
        .hero-stat-label {
            font-size: 12px;
            color: rgba(255,255,255,0.45);
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ───── SEARCH CARD ───── */
        .search-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 32px 28px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            height: fit-content;
        }

        .search-card-title {
            font-size: 19px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-field {
            position: relative;
            margin-bottom: 12px;
        }

        .search-field-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--green);
            font-size: 17px;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 16px 18px 16px 52px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            background: var(--sand);
            transition: all 0.2s;
            outline: none;
        }

        .search-input:focus {
            border-color: var(--green);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(14, 166, 106, 0.1);
        }

        .search-input::placeholder { color: var(--ink-soft); }

        .search-cities {
            position: relative;
            margin-bottom: 20px;
        }

        .search-swap-btn {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 42px;
            height: 42px;
            background: var(--white);
            border: 2px solid var(--green-mid);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 14px;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
            z-index: 10;
        }

        .search-swap-btn:hover {
            background: var(--green);
            color: white;
            border-color: var(--green);
            transform: translate(-50%, -50%) rotate(180deg);
        }

        .search-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }

        .advanced-section {
            background: var(--sand);
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 24px;
        }

        .filter-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-mid);
            margin-bottom: 10px;
        }

        .vehicle-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 18px;
        }

        .chip {
            padding: 9px 18px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 999px;
            font-size: 13.5px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .chip.active,
        .chip:hover {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        .price-range {
            margin-bottom: 18px;
        }

        .price-label {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: var(--ink-soft);
            margin-bottom: 6px;
        }

        .price-slider {
            width: 100%;
            accent-color: var(--green);
            cursor: pointer;
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .option-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--ink-mid);
        }

        .option-item input {
            accent-color: var(--green);
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .search-btn {
            width: 100%;
            background: var(--green);
            color: #fff;
            border: none;
            padding: 17px;
            border-radius: var(--radius-md);
            font-family: 'Sora', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .search-btn:hover {
            background: var(--green-dark);
            transform: translateY(-2px);
        }

        .search-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 20px;
        }

        .search-tag {
            font-size: 13px;
            color: var(--green-dark);
            background: var(--green-light);
            padding: 6px 14px;
            border-radius: 999px;
            cursor: pointer;
            border: 1px solid var(--green-mid);
            transition: all 0.15s;
        }

        .search-tag:hover {
            background: var(--green-mid);
            color: white;
        }

        /* ───── TRUST BAR ───── */
        .trust-bar {
            background: var(--green-light);
            border-bottom: 1px solid var(--green-mid);
            padding: 14px 24px;
        }
        .trust-bar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        .trust-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--green-dark);
        }
        .trust-item i { font-size: 14px; }

        /* ───── SECTIONS ───── */
        .section { padding: 80px 24px; }
        .section-inner { max-width: 1200px; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 52px; }
        .section-label {
            display: inline-block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--green);
            margin-bottom: 10px;
        }
        .section-title {
            font-size: 34px;
            font-weight: 700;
            letter-spacing: -1px;
            color: var(--ink);
            margin-bottom: 12px;
        }
        .section-sub {
            font-size: 16px;
            color: var(--ink-soft);
            max-width: 480px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ───── TRIP CARDS ───── */
        .trips-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .trip-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px;
            transition: border-color 0.2s, transform 0.25s, box-shadow 0.25s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .trip-card:hover {
            border-color: var(--green);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }
        .trip-route {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }
        .trip-city {
            font-family: 'Sora', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--ink);
        }
        .trip-arrow {
            width: 28px; height: 28px;
            background: var(--green-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: var(--green);
            flex-shrink: 0;
        }
        .trip-meta {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
            font-size: 13px;
            color: var(--ink-soft);
        }
        .trip-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .trip-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }
        .trip-driver {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .driver-avatar {
            width: 34px; height: 34px;
            background: var(--green-mid);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: var(--green-dark);
            font-family: 'Sora', sans-serif;
        }
        .driver-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
        }
        .driver-rating {
            font-size: 12px;
            color: #f59e0b;
        }
        .trip-price {
            font-family: 'Sora', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--green);
        }
        .trip-price span {
            font-size: 13px;
            font-weight: 400;
            color: var(--ink-soft);
        }

        .trips-footer {
            text-align: center;
            margin-top: 36px;
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
        .btn-outline:hover {
            background: var(--green);
            color: #fff;
        }

        /* ───── HOW IT WORKS ───── */
        .hiw-bg { background: var(--sand); }
        .hiw-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0;
            position: relative;
        }
        .hiw-grid::before {
            content: '';
            position: absolute;
            top: 26px;
            left: 10%;
            right: 10%;
            height: 2px;
            background: linear-gradient(to right, var(--green-mid), var(--green), var(--green-mid));
            z-index: 0;
        }
        .hiw-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 0 12px;
            position: relative;
            z-index: 1;
        }
        .hiw-num {
            width: 52px; height: 52px;
            background: var(--white);
            border: 2.5px solid var(--green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sora', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--green);
            margin-bottom: 20px;
        }
        .hiw-step:first-child .hiw-num,
        .hiw-step:last-child .hiw-num {
            background: var(--green);
            color: #fff;
        }
        .hiw-icon {
            width: 48px; height: 48px;
            background: var(--green-light);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 14px;
        }
        .hiw-label {
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 6px;
        }
        .hiw-desc {
            font-size: 13px;
            color: var(--ink-soft);
            line-height: 1.5;
        }

        /* ───── DESTINATIONS ───── */
        .dest-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }
        .dest-card {
            background: var(--sand);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
        }
        .dest-card:hover {
            border-color: var(--green);
            background: var(--green-light);
        }
        .dest-route {
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 4px;
        }
        .dest-freq {
            font-size: 12px;
            color: var(--ink-soft);
        }
        .dest-price-tag {
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--green);
            background: var(--green-light);
            padding: 4px 12px;
            border-radius: 999px;
            border: 1px solid var(--green-mid);
        }

        /* ───── TESTIMONIALS ───── */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .testi-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
        }
        .testi-stars {
            color: #f59e0b;
            font-size: 14px;
            margin-bottom: 14px;
            letter-spacing: 2px;
        }
        .testi-quote {
            font-size: 15px;
            line-height: 1.65;
            color: var(--ink-mid);
            margin-bottom: 20px;
        }
        .testi-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .testi-avatar {
            width: 40px; height: 40px;
            background: var(--green-mid);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: var(--green-dark);
        }
        .testi-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
        }
        .testi-role {
            font-size: 12px;
            color: var(--ink-soft);
            margin-top: 2px;
        }

        /* ───── CTA BANNER ───── */
        .cta-section {
            background: var(--ink);
            margin: 0 24px 80px;
            border-radius: var(--radius-xl);
            padding: 60px 48px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 40px;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14,166,106,0.35) 0%, transparent 70%);
            right: -80px; top: -100px;
            pointer-events: none;
        }
        .cta-title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -1px;
            color: #fff;
            margin-bottom: 10px;
        }
        .cta-sub {
            font-size: 16px;
            color: rgba(255,255,255,0.55);
        }
        .cta-btns { display: flex; gap: 12px; flex-shrink: 0; }
        .btn-white {
            background: #fff;
            color: var(--green-dark);
            border: none;
            padding: 13px 26px;
            border-radius: var(--radius-xl);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s;
            white-space: nowrap;
        }
        .btn-white:hover { background: var(--green-light); }
        .btn-green-outline {
            background: transparent;
            color: #5de0a7;
            border: 1.5px solid rgba(93,224,167,0.4);
            padding: 13px 26px;
            border-radius: var(--radius-xl);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s;
            white-space: nowrap;
        }
        .btn-green-outline:hover {
            background: rgba(93,224,167,0.1);
            border-color: rgba(93,224,167,0.7);
        }

        /* ───── FOOTER ───── */
        footer {
            background: var(--ink);
            padding: 60px 24px 32px;
        }
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }
        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }
        .footer-brand { font-size: 14px; color: rgba(255,255,255,0.45); line-height: 1.7; margin-top: 14px; }
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
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.4);
            font-size: 14px;
            text-decoration: none;
            transition: all 0.18s;
        }
        .social-btn:hover {
            border-color: rgba(93,224,167,0.5);
            color: #5de0a7;
        }

        /* ───── MOBILE MENU ───── */
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

        @media (max-width: 1024px) {
            .trips-grid { grid-template-columns: repeat(2, 1fr); }
            .dest-grid { grid-template-columns: repeat(2, 1fr); }
            .hiw-grid { grid-template-columns: repeat(3, 1fr); gap: 28px; }
            .hiw-grid::before { display: none; }
            .footer-top { grid-template-columns: 1fr 1fr; gap: 32px; }
        }
        @media (max-width: 768px) {
            .hero-inner { grid-template-columns: 1fr; }
            .search-card { order: -1; }
            .hero-title { font-size: 36px; }
            .nav-links { display: none; }
            .mobile-toggle { display: block; }
            .trips-grid { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .dest-grid { grid-template-columns: 1fr; }
            .hiw-grid { grid-template-columns: 1fr 1fr; }
            .cta-section { grid-template-columns: 1fr; padding: 40px 28px; }
            .cta-btns { flex-direction: column; }
            .footer-top { grid-template-columns: 1fr; gap: 24px; }
            .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
            .section-title { font-size: 26px; }
            .btn-ghost { display: none; }
        }
    </style>
@endpush

@section('content')


<!-- ═══ HERO ═══ -->
<header class="hero">
    <div class="hero-pattern"></div>
    <div class="hero-bg-photo" style="background-image: url('{{ asset('images/hero.jpg') }}');"></div>
    <div class="hero-glow"></div>
    <div class="hero-glow-2"></div>
    <div class="hero-inner">
        <div>
            <div class="hero-badge">
                <div class="pulse-dot"></div>
                <span>+{{ $trajet_count ?? 2450 }} trajets disponibles aujourd'hui</span>
            </div>
            <h1 class="hero-title">
                Voyagez plus<br>malin avec<br><em>Covoit+</em>
            </h1>
            <p class="hero-subtitle">
                Le covoiturage éco-responsable, sécurisé et abordable partout en Tunisie. Trouvez ou proposez un trajet en quelques secondes.
            </p>
            <div class="hero-stats">
                <div>
                    <div class="hero-stat-value">{{ number_format($users_count, 0, ',', ' ') }}+</div>
                    <div class="hero-stat-label">Utilisateurs</div>
                </div>
                <div>
                    <div class="hero-stat-value">{{ number_format($average_rating, 1) }}★</div>
                    <div class="hero-stat-label">Note moyenne</div>
                </div>
                <div>
                    <div class="hero-stat-value">{{ $cities_covered }}</div>
                    <div class="hero-stat-label">Villes couvertes</div>
                </div>
            </div>
        </div>

        <!-- Search Card -->
        <div class="search-card">
            <p class="search-card-title">
                <i class="fa-solid fa-magnifying-glass"></i>
                Trouver un trajet
            </p>

            <form action="{{ route('cars') }}" method="GET">
                <div class="search-cities">
                    <div class="search-field">
                        <i class="fa-solid fa-circle-dot search-field-icon"></i>
                        <input class="search-input" type="text" name="pickup" id="pickup"
                               placeholder="D'où partez-vous ? (ex: Tunis)"
                               value="{{ request('pickup') }}">
                    </div>

                    <div class="search-swap-btn" type="button" onclick="swapCities()" title="Inverser">
                        <i class="fa-solid fa-arrow-up-down"></i>
                    </div>

                    <div class="search-field">
                        <i class="fa-solid fa-location-dot search-field-icon"></i>
                        <input class="search-input" type="text" name="dropoff" id="dropoff"
                               placeholder="Où allez-vous ? (ex: Sfax)"
                               value="{{ request('dropoff') }}">
                    </div>
                </div>

                <div class="search-row">
                    <div class="search-field">
                        <i class="fa-regular fa-calendar search-field-icon"></i>
                        <input class="search-input" type="date" name="journey_date"
                               value="{{ request('journey_date', now()->format('Y-m-d')) }}">
                    </div>
                    <div class="search-field">
                        <i class="fa-solid fa-user-group search-field-icon"></i>
                        <input class="search-input" type="number" name="places" min="1" max="8"
                               placeholder="Passagers" value="{{ request('places', 1) }}">
                    </div>
                </div>

                <div class="advanced-section">
                    <div class="filter-title">Type de véhicule</div>
                    <div class="vehicle-chips">
                        <div class="chip active" onclick="this.classList.toggle('active')">Tout</div>
                        <div class="chip" onclick="this.classList.toggle('active')">Voiture</div>
                        <div class="chip" onclick="this.classList.toggle('active')">Van</div>
                        <div class="chip" onclick="this.classList.toggle('active')">SUV</div>
                    </div>

                    <div class="price-range">
                        <div class="price-label">
                            <span>20 DT</span>
                            <span id="max-price-display">{{ request('max_price', 80) }} DT</span>
                        </div>
                        <input type="range" name="max_price" id="max_price"
                               min="20" max="150" value="{{ request('max_price', 80) }}" step="5"
                               class="price-slider"
                               oninput="document.getElementById('max-price-display').textContent = this.value + ' DT'">
                    </div>

                    <div class="options-grid">
                        <label class="option-item">
                            <input type="checkbox" name="no_smoking" {{ request()->has('no_smoking') ? 'checked' : '' }}>
                            Non-fumeur
                        </label>
                        <label class="option-item">
                            <input type="checkbox" name="women_only" {{ request()->has('women_only') ? 'checked' : '' }}>
                            Femmes seulement
                        </label>
                        <label class="option-item">
                            <input type="checkbox" name="luggage" {{ request()->has('luggage') ? 'checked' : '' }}>
                            Bagages acceptés
                        </label>
                    </div>
                </div>

                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Rechercher
                </button>
            </form>

            <div class="search-tags">
                <span class="search-tag" onclick="fillRoute('Tunis','Sfax')">Tunis → Sfax</span>
                <span class="search-tag" onclick="fillRoute('Tunis','Sousse')">Tunis → Sousse</span>
                <span class="search-tag" onclick="fillRoute('Sfax','Gabès')">Sfax → Gabès</span>
                <span class="search-tag" onclick="fillRoute('Tunis','Hammamet')">Tunis → Hammamet</span>
            </div>
        </div>
    </div>
</header>

<!-- ═══ TRUST BAR ═══ -->
<div class="trust-bar">
    <div class="trust-bar-inner">
        <div class="trust-item"><i class="fa-solid fa-shield-halved"></i> Conducteurs vérifiés</div>
        <div class="trust-item"><i class="fa-solid fa-leaf"></i> Réduction CO₂ mesurée</div>
        <div class="trust-item"><i class="fa-solid fa-headset"></i> Support 7j/7</div>
        <div class="trust-item"><i class="fa-solid fa-lock"></i> Paiement sécurisé</div>
        <div class="trust-item"><i class="fa-solid fa-star"></i> Note moyenne {{ number_format($average_rating, 1) }}/5</div>
    </div>
</div>


<!-- ═══ FEATURED TRIPS ═══ -->
<section class="section">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Aujourd'hui</span>
            <h2 class="section-title">Trajets en vedette</h2>
            <p class="section-sub">Des trajets vérifiés, avec des conducteurs notés par la communauté.</p>
        </div>

        <div class="trips-grid">
            @forelse($trajets ?? [] as $trajet)
            <a href="{{ route('trajets.show', $trajet) }}" class="trip-card">
                <div class="trip-route">
                    <div class="trip-city">{{ $trajet->depart }}</div>
                    <div class="trip-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="trip-city">{{ $trajet->destination }}</div>
                </div>
                <div class="trip-meta">
                    <div class="trip-meta-item">
                        <i class="fa-regular fa-calendar" style="font-size:12px;"></i>
                        <span>{{ optional($trajet->date)->format('d/m/Y') ?? $trajet->date }}</span>
                    </div>
                    <div class="trip-meta-item">
                        <i class="fa-regular fa-clock" style="font-size:12px;"></i>
                        <span>{{ $trajet->heure ?? '09:00' }}</span>
                    </div>
                    <div class="trip-meta-item">
                        <i class="fa-solid fa-user" style="font-size:12px;"></i>
                        <span>{{ $trajet->nb_places ?? 3 }} places</span>
                    </div>
                </div>
                <div class="trip-footer">
                    <div class="trip-driver">
                        <div class="driver-avatar">{{ substr($trajet->conducteur->name ?? 'C', 0, 1) }}</div>
                        <div>
                            <div class="driver-name">{{ $trajet->conducteur->name ?? 'Conducteur vérifié' }}</div>
                            <div class="driver-rating">★★★★★</div>
                        </div>
                    </div>
                    <div class="trip-price">{{ number_format($trajet->prix, 0, ',', ' ') }} <span>DT</span></div>
                </div>
            </a>
            @empty
            <!-- Placeholder cards for demo -->
            @foreach([['Tunis','Sfax','07:30','25','Sami B.','3'],['Sousse','Gabès','08:00','18','Mariem K.','2'],['Tunis','Hammamet','09:15','12','Yassine T.','4']] as $demo)
            <div class="trip-card" style="cursor:default;">
                <div class="trip-route">
                    <div class="trip-city">{{ $demo[0] }}</div>
                    <div class="trip-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="trip-city">{{ $demo[1] }}</div>
                </div>
                <div class="trip-meta">
                    <div class="trip-meta-item">
                        <i class="fa-regular fa-calendar" style="font-size:12px;"></i>
                        <span>Aujourd'hui</span>
                    </div>
                    <div class="trip-meta-item">
                        <i class="fa-regular fa-clock" style="font-size:12px;"></i>
                        <span>{{ $demo[2] }}</span>
                    </div>
                    <div class="trip-meta-item">
                        <i class="fa-solid fa-user" style="font-size:12px;"></i>
                        <span>{{ $demo[5] }} places</span>
                    </div>
                </div>
                <div class="trip-footer">
                    <div class="trip-driver">
                        <div class="driver-avatar">{{ substr($demo[4], 0, 1) }}</div>
                        <div>
                            <div class="driver-name">{{ $demo[4] }}</div>
                            <div class="driver-rating">★★★★★</div>
                        </div>
                    </div>
                    <div class="trip-price">{{ $demo[3] }} <span>DT</span></div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>

        <div class="trips-footer">
            <a href="{{ route('cars') }}" class="btn-outline">
                Voir tous les trajets <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>


<!-- ═══ HOW IT WORKS ═══ -->
<section class="section hiw-bg" id="how-it-works">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Simple & rapide</span>
            <h2 class="section-title">Comment ça marche ?</h2>
            <p class="section-sub">Voyagez ensemble en cinq étapes simples.</p>
        </div>

        <div class="hiw-grid">
            <div class="hiw-step">
                <div class="hiw-num">1</div>
                <div class="hiw-icon">🔍</div>
                <div class="hiw-label">Cherchez</div>
                <div class="hiw-desc">Entrez votre destination et la date souhaitée</div>
            </div>
            <div class="hiw-step">
                <div class="hiw-num">2</div>
                <div class="hiw-icon">✅</div>
                <div class="hiw-label">Choisissez</div>
                <div class="hiw-desc">Comparez les trajets, conducteurs et tarifs</div>
            </div>
            <div class="hiw-step">
                <div class="hiw-num">3</div>
                <div class="hiw-icon">📲</div>
                <div class="hiw-label">Réservez</div>
                <div class="hiw-desc">En deux clics, instantanément et en toute sécurité</div>
            </div>
            <div class="hiw-step">
                <div class="hiw-num">4</div>
                <div class="hiw-icon">🚗</div>
                <div class="hiw-label">Voyagez</div>
                <div class="hiw-desc">Rencontrez votre conducteur au point de départ</div>
            </div>
            <div class="hiw-step">
                <div class="hiw-num">5</div>
                <div class="hiw-icon">⭐</div>
                <div class="hiw-label">Notez</div>
                <div class="hiw-desc">Aidez la communauté en laissant votre avis</div>
            </div>
        </div>
    </div>
</section>


<!-- ═══ POPULAR DESTINATIONS ═══ -->
<section class="section">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Populaires</span>
            <h2 class="section-title">Destinations fréquentes</h2>
            <p class="section-sub">Les trajets les plus empruntés sur Covoit+</p>
        </div>

        <div class="dest-grid">
            @forelse($popularRoutes ?? [] as $route)
            <a href="{{ route('cars') }}?pickup={{ urlencode($route->depart) }}&dropoff={{ urlencode($route->destination) }}" class="dest-card">
                <div>
                    <div class="dest-route">{{ $route->depart }} → {{ $route->destination }}</div>
                    <div class="dest-freq">{{ $route->route_count }} trajets</div>
                </div>
                <div class="dest-price-tag">dès {{ number_format($route->min_price, 0, ',', ' ') }} DT</div>
            </a>
            @empty
            @foreach([['Tunis','Sfax','20 trajets/jour','dès 25 DT'],['Tunis','Sousse','15 trajets/jour','dès 15 DT'],['Sfax','Gabès','8 trajets/jour','dès 18 DT'],['Tunis','Monastir','12 trajets/jour','dès 20 DT'],['Sousse','Mahdia','6 trajets/jour','dès 10 DT'],['Tunis','Hammamet','10 trajets/jour','dès 12 DT'],['Sfax','Tunis','20 trajets/jour','dès 25 DT'],['Tunis','Bizerte','7 trajets/jour','dès 14 DT']] as $d)
            <a href="{{ route('cars') }}?pickup={{ urlencode($d[0]) }}&dropoff={{ urlencode($d[1]) }}" class="dest-card">
                <div>
                    <div class="dest-route">{{ $d[0] }} → {{ $d[1] }}</div>
                    <div class="dest-freq">{{ $d[2] }}</div>
                </div>
                <div class="dest-price-tag">{{ $d[3] }}</div>
            </a>
            @endforeach
            @endforelse
        </div>
    </div>
</section>


<!-- ═══ TESTIMONIALS ═══ -->
<section class="section" style="background: var(--sand);">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Avis utilisateurs</span>
            <h2 class="section-title">Ce qu'ils en pensent</h2>
            <p class="section-sub">Des milliers de voyageurs satisfaits chaque semaine.</p>
        </div>

        <div class="testimonials-grid">
            @forelse($avis as $review)
            <div class="testi-card">
                <div class="testi-stars">{{ str_repeat('★', $review->note) }}{{ str_repeat('☆', 5 - $review->note) }}</div>
                <p class="testi-quote">« {{ $review->commentaire ?? 'Avis positif sur le trajet.' }} »</p>
                <div class="testi-author">
                    <div class="testi-avatar">{{ substr($review->reservation->user->name, 0, 2) }}</div>
                    <div>
                        <div class="testi-name">{{ $review->reservation->user->name }}</div>
                        <div class="testi-role">Passager — {{ $review->reservation->trajet->depart }} → {{ $review->reservation->trajet->destination }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote">« J'ai trouvé un trajet en 2 minutes et économisé 45 DT par rapport au bus. L'application est vraiment intuitive ! »</p>
                <div class="testi-author">
                    <div class="testi-avatar">RZ</div>
                    <div>
                        <div class="testi-name">Roua Zayen</div>
                        <div class="testi-role">Passagère — Tunis → Sousse</div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote">« J'ai rempli mes 4 places en moins de 24h. En tant que conductrice, c'est l'outil parfait pour partager les frais. »</p>
                <div class="testi-author">
                    <div class="testi-avatar">YD</div>
                    <div>
                        <div class="testi-name">Yasmine Dhieb</div>
                        <div class="testi-role">Conductrice — Sfax → Gabès</div>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote">« La meilleure façon de voyager en Tunisie. Je fais confiance à Covoit+ à 100% — les conducteurs sont toujours sérieux. »</p>
                <div class="testi-author">
                    <div class="testi-avatar">MS</div>
                    <div>
                        <div class="testi-name">Manar Smida</div>
                        <div class="testi-role">Passagère régulière</div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>


<!-- ═══ CTA BANNER ═══ -->
<div style="max-width:1200px; margin:0 auto;">
    <div class="cta-section">
        <div style="position:relative;z-index:1;">
            <h2 class="cta-title">Proposez votre prochain trajet</h2>
            <p class="cta-sub">Partagez les frais, réduisez votre empreinte carbone et rencontrez de nouvelles personnes.</p>
        </div>
        <div class="cta-btns" style="position:relative;z-index:1;">
            <a href="{{ route('trajets.create') }}" class="btn-white">Proposer un trajet</a>
            <a href="{{ route('register') }}" class="btn-green-outline">S'inscrire gratuitement</a>
        </div>
    </div>
</div>


<script>
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');
        const open = menu.style.display === 'block';
        menu.style.display = open ? 'none' : 'block';
        icon.className = open ? 'fa-solid fa-bars' : 'fa-solid fa-xmark';
    }

    function swapCities() {
        const p = document.querySelector('input[name="pickup"]');
        const d = document.querySelector('input[name="dropoff"]');
        [p.value, d.value] = [d.value, p.value];
    }

    function fillRoute(from, to) {
        const p = document.querySelector('input[name="pickup"]');
        const d = document.querySelector('input[name="dropoff"]');
        if (p) p.value = from;
        if (d) d.value = to;
        p.focus();
    }
</script>
@endsection
