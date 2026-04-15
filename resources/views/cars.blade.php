@extends('layouts.app')
@section('title', 'Trouver un trajet • Covoit+')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* === TOUT LE CSS DE L'INDEX EST COPIÉ ICI POUR COHÉRENCE === */
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

        /* Main Content */
        .find-page {
            padding-top: 40px;
            background: var(--sand);
            min-height: calc(100vh - 68px);
        }
        .page-header {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px 40px;
            text-align: center;
        }
        .page-title {
            font-size: 42px;
            font-weight: 700;
            letter-spacing: -1.5px;
            color: var(--ink);
            margin-bottom: 12px;
        }
        .page-subtitle {
            font-size: 17px;
            color: var(--ink-soft);
            max-width: 520px;
            margin: 0 auto;
        }

        /* Search Card - Version Large */
        .search-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .main-search-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 40px 36px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            margin-bottom: 60px;
        }

        /* Réutilisation des classes existantes */
        .search-card-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search-field { position: relative; margin-bottom: 16px; }
        .search-field-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--green);
            font-size: 18px;
        }
        .search-input {
            width: 100%;
            padding: 18px 20px 18px 56px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            font-size: 16px;
            background: var(--sand);
            transition: all 0.2s;
        }
        .search-input:focus {
            border-color: var(--green);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(14, 166, 106, 0.12);
        }

        .search-cities { position: relative; }
        .search-swap-btn {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 48px;
            height: 48px;
            background: var(--white);
            border: 2px solid var(--green-mid);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 16px;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            z-index: 10;
            transition: all 0.3s ease;
        }
        .search-swap-btn:hover {
            background: var(--green);
            color: white;
            transform: translate(-50%, -50%) rotate(180deg);
        }

        .search-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 16px;
        }

        .advanced-section {
            background: var(--sand);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin: 28px 0;
        }

        .search-btn {
            width: 100%;
            background: var(--green);
            color: #fff;
            border: none;
            padding: 18px;
            border-radius: var(--radius-md);
            font-family: 'Sora', sans-serif;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.2s;
        }
        .search-btn:hover {
            background: var(--green-dark);
            transform: translateY(-3px);
        }

        /* Results Section */
        .results-header {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .results-count {
            font-size: 15px;
            color: var(--ink-mid);
        }

        .trips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 24px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Trip Card (réutilisé de l'index) */
        .trip-card {
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            transition: all 0.25s;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .trip-card:hover {
            border-color: var(--green);
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
        }

        /* Garder toutes les classes trip-* identiques à l'index */
        .trip-route, .trip-meta, .trip-footer, .trip-driver, .trip-price,
        .driver-avatar, .driver-name, .driver-rating, .trip-city, .trip-arrow {
            /* Elles sont déjà définies dans votre CSS d'origine */
        }

        @media (max-width: 768px) {
            .main-search-card { padding: 28px 20px; }
            .trips-grid { grid-template-columns: 1fr; }
            .page-title { font-size: 32px; }
        }
    </style>
</head>
@endpush

@section('content')

<!-- PAGE CONTENT -->
<div class="find-page">
    <div class="page-header">
        <h1 class="page-title">Trouver votre prochain trajet</h1>
        <p class="page-subtitle">Des milliers de covoiturages en Tunisie • Départ aujourd’hui et tous les jours</p>
    </div>

    <!-- Search Card -->
    <div class="search-container">
        <div class="main-search-card">
            <p class="search-card-title">
                <i class="fa-solid fa-magnifying-glass"></i>
                Où allez-vous ?
            </p>

            <form action="{{ route('cars') }}" method="GET">
                <div class="search-cities">
                    <div class="search-field">
                        <i class="fa-solid fa-circle-dot search-field-icon"></i>
                        <input class="search-input" type="text" name="pickup" id="pickup"
                               placeholder="Ville de départ (ex: Tunis)" 
                               value="{{ request('pickup') }}" required>
                    </div>

                    <div class="search-swap-btn" onclick="swapCities()" title="Inverser départ / arrivée">
                        <i class="fa-solid fa-arrow-up-down"></i>
                    </div>

                    <div class="search-field">
                        <i class="fa-solid fa-location-dot search-field-icon"></i>
                        <input class="search-input" type="text" name="dropoff" id="dropoff"
                               placeholder="Ville d'arrivée (ex: Sfax)" 
                               value="{{ request('dropoff') }}" required>
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
                               placeholder="Nombre de passagers" value="{{ request('places', 1) }}">
                    </div>
                </div>

                <div class="advanced-section">
                    <div class="filter-title" style="margin-bottom:14px;">Filtres avancés</div>
                    <!-- Vous pouvez réutiliser les chips, slider, etc. de l'index ici -->
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <label style="font-size:14px; color:var(--ink-mid);">
                            <input type="checkbox" name="no_smoking" {{ request()->has('no_smoking') ? 'checked' : '' }}> Non-fumeur
                        </label>
                        <label style="font-size:14px; color:var(--ink-mid);">
                            <input type="checkbox" name="women_only" {{ request()->has('women_only') ? 'checked' : '' }}> Femmes seulement
                        </label>
                    </div>
                </div>

                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Rechercher les trajets
                </button>
            </form>
        </div>
    </div>

    <!-- Results -->
    <div class="results-header">
        <div class="results-count">
            @if(isset($trajets))
                {{ $trajets->count() }} trajets trouvés
            @else
                {{ $trajet_count ?? 1240 }} trajets disponibles aujourd’hui
            @endif
        </div>
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
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ optional($trajet->date)->format('d M Y') }}</span>
                    </div>
                    <div class="trip-meta-item">
                        <i class="fa-regular fa-clock"></i>
                        <span>{{ $trajet->heure ?? '09:00' }}</span>
                    </div>
                    <div class="trip-meta-item">
                        <i class="fa-solid fa-user"></i>
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
                    <div class="trip-price">
                        {{ number_format($trajet->prix ?? 0, 0, ',', ' ') }} <span>DT</span>
                    </div>
                </div>
            </a>
        @empty
            <p style="grid-column:1/-1; text-align:center; padding:60px 20px; color:var(--ink-soft); font-size:17px;">
                Aucun trajet trouvé pour ces critères.<br>
                Essayez de modifier votre recherche.
            </p>
        @endforelse
    </div>
@push('scripts')
<script>
    function swapCities() {
        const pickup = document.getElementById('pickup');
        const dropoff = document.getElementById('dropoff');
        [pickup.value, dropoff.value] = [dropoff.value, pickup.value];
    }
</script>
@endpush
@endsection