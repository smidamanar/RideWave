<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="theme-color" content="#ffffff">
    @include('partials.theme-init')
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #f8fafc; color: #0f172a; }
        a { color: inherit; text-decoration: none; }
        .topbar { position: sticky; top: 0; z-index: 10; display: flex; justify-content: space-between; align-items: center; gap: 16px; padding: 18px 28px; background: #ffffff; border-bottom: 1px solid #e2e8f0; }
        .brand { font-size: 24px; font-weight: 700; color: #0f766e; }
        .nav { display: flex; gap: 18px; align-items: center; flex-wrap: wrap; }
        .toolbar { display: flex; align-items: center; gap: 12px; }
        .nav a { padding: 8px 12px; border-radius: 999px; color: #475569; }
        .nav a.active { background: #ccfbf1; color: #115e59; font-weight: 700; }
        .profile-wrap { position: relative; }
        .profile-name { border: 0; background: #f1f5f9; padding: 10px 14px; border-radius: 999px; cursor: pointer; font-weight: 600; }
        .profile-menu { display: none; position: absolute; right: 0; top: 100%; padding-top: 8px; min-width: 200px; }
        .profile-menu-panel { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08); overflow: hidden; }
        .profile-wrap:hover .profile-menu { display: block; }
        .profile-menu a, .profile-menu button { display: block; width: 100%; text-align: left; padding: 12px 14px; background: #ffffff; border: 0; cursor: pointer; font-size: 14px; }
        .profile-menu a:hover, .profile-menu button:hover { background: #f8fafc; }
        .container { max-width: 1120px; margin: 0 auto; padding: 28px; }
        .hero { margin-bottom: 24px; }
        .hero h1 { margin: 0 0 8px; font-size: 32px; }
        .hero p { margin: 0; color: #475569; }
        .grid { display: grid; gap: 18px; }
        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
        .card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; padding: 20px; box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05); }
        .card h2, .card h3 { margin-top: 0; }
        .metric { font-size: 30px; font-weight: 700; margin: 8px 0 0; }
        .list { display: grid; gap: 12px; margin-top: 14px; }
        .row { display: flex; justify-content: space-between; gap: 12px; align-items: center; padding: 14px; border: 1px solid #e2e8f0; border-radius: 12px; background: #ffffff; }
        .muted { color: #64748b; }
        .field { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
        .field-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
        input, select { padding: 12px 14px; border-radius: 10px; border: 1px solid #cbd5e1; }
        button, .button-link { border: 0; border-radius: 10px; padding: 11px 16px; font-weight: 600; cursor: pointer; background: #0f766e; color: #ffffff; display: inline-block; }
        .button-link.secondary, button.secondary { background: #e2e8f0; color: #0f172a; }
        .danger { background: #b91c1c; color: #ffffff; }
        .flash { margin-bottom: 18px; padding: 12px 14px; border-radius: 10px; }
        .flash.success { background: #dcfce7; color: #166534; }
        .flash.error { background: #fee2e2; color: #991b1b; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; background: #ecfeff; color: #155e75; font-size: 12px; font-weight: 700; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        .theme-toggle { display: inline-flex; align-items: center; justify-content: center; width: 42px; height: 42px; border: 1px solid #e2e8f0; border-radius: 999px; padding: 0; background: #ffffff; color: #0f172a; cursor: pointer; }
        .theme-toggle .material-symbols-outlined { font-size: 20px; }
        html[data-theme='dark'] body { background: #08111f; color: #e2e8f0; }
        html[data-theme='dark'] .topbar,
        html[data-theme='dark'] .card,
        html[data-theme='dark'] .row,
        html[data-theme='dark'] .profile-menu-panel { background: #0f172a; border-color: #233042; }
        html[data-theme='dark'] .nav a { color: #94a3b8; }
        html[data-theme='dark'] .nav a.active { background: rgba(20, 184, 166, 0.18); color: #99f6e4; }
        html[data-theme='dark'] .profile-name,
        html[data-theme='dark'] input,
        html[data-theme='dark'] select,
        html[data-theme='dark'] .button-link.secondary,
        html[data-theme='dark'] button.secondary { background: #1e293b; color: #e2e8f0; border-color: #334155; }
        html[data-theme='dark'] .muted,
        html[data-theme='dark'] .hero p,
        html[data-theme='dark'] .profile-menu a,
        html[data-theme='dark'] .profile-menu button,
        html[data-theme='dark'] .table th,
        html[data-theme='dark'] .table td { color: #94a3b8; }
        html[data-theme='dark'] .theme-toggle { background: #0f172a; color: #f8fafc; border-color: #233042; }
        @media (max-width: 860px) {
            .topbar { flex-direction: column; align-items: flex-start; }
            .nav { width: 100%; }
        }
    </style>
</head>
<body>
@php
    $user = auth()->user();
    $role = $user->canonicalRole();
    $logoRoute = route($user->homeRouteName());
    $menu = match ($role) {
        'passenger' => [
            ['label' => __('ui.home'), 'route' => route('passenger.home'), 'active' => request()->routeIs('passenger.home')],
            ['label' => __('ui.find_rides'), 'route' => route('passenger.find-rides'), 'active' => request()->routeIs('passenger.find-rides')],
        ],
        'driver' => [
            ['label' => __('ui.home'), 'route' => route('driver.home'), 'active' => request()->routeIs('driver.home')],
            ['label' => __('ui.find_rides'), 'route' => route('driver.find-rides'), 'active' => request()->routeIs('driver.find-rides')],
            ['label' => __('ui.offer_ride'), 'route' => route('driver.offer-ride.create'), 'active' => request()->routeIs('driver.offer-ride.*')],
            ['label' => __('ui.fleet'), 'route' => route('driver.fleet'), 'active' => request()->routeIs('driver.fleet*')],
        ],
        default => [],
    };
    $profileMenu = match ($role) {
        'passenger' => [
            ['label' => __('ui.history'), 'route' => route('passenger.history')],
            ['label' => __('ui.manage_profile'), 'route' => route('passenger.profile.edit')],
        ],
        'driver' => [
            ['label' => __('ui.history'), 'route' => route('driver.history')],
            ['label' => __('ui.dashboard'), 'route' => route('driver.dashboard')],
            ['label' => __('ui.manage_profile'), 'route' => route('driver.profile.edit')],
        ],
        default => [
            ['label' => __('ui.dashboard'), 'route' => route('admin.dashboard')],
        ],
    };
@endphp
    <header class="topbar">
        <a class="brand" href="{{ $logoRoute }}">{{ config('app.name') }}</a>
        <nav class="nav">
            @foreach ($menu as $item)
                <a class="{{ $item['active'] ? 'active' : '' }}" href="{{ $item['route'] }}">{{ $item['label'] }}</a>
            @endforeach
        </nav>
        <div class="toolbar">
            @include('partials.language-switcher')
            @include('partials.theme-toggle-button')
            <div class="profile-wrap">
                <button class="profile-name" type="button">{{ $user->name }}</button>
                <div class="profile-menu">
                    <div class="profile-menu-panel">
                        @foreach ($profileMenu as $item)
                            <a href="{{ $item['route'] }}">{{ $item['label'] }}</a>
                        @endforeach
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">{{ __('ui.logout') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="container">
        @if (session('success'))
            <div class="flash success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="flash error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="flash error">{{ $errors->first() }}</div>
        @endif
        @yield('content')
    </main>
    @include('partials.theme-toggle-script')
</body>
</html>

