<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="#ffffff" name="theme-color"/>
    <title>@yield('title', 'RideWave Admin Portal')</title>
    @include('partials.theme-init')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              colors: {
                "secondary-fixed": "#e1e2e8",
                "on-background": "#1d1b20",
                "surface": "#fdf7ff",
                "secondary-container": "#e1e2e8",
                "on-primary-fixed-variant": "#4f378a",
                "surface-variant": "#e6e0e9",
                "on-secondary-fixed": "#191c20",
                "on-tertiary-fixed": "#07006c",
                "surface-tint": "#6750a4",
                "primary-fixed-dim": "#cfbcff",
                "on-tertiary-fixed-variant": "#2f2ebe",
                "on-tertiary": "#ffffff",
                "on-primary": "#ffffff",
                "surface-dim": "#ded8e0",
                "surface-container": "#f2ecf4",
                "secondary-fixed-dim": "#c5c6cc",
                "surface-container-lowest": "#ffffff",
                "primary-container": "#6750a4",
                "outline-variant": "#cbc4d2",
                "primary-fixed": "#e9ddff",
                "tertiary-container": "#494bd6",
                "inverse-on-surface": "#f5eff7",
                "inverse-primary": "#cfbcff",
                "tertiary-fixed-dim": "#c0c1ff",
                "inverse-surface": "#322f35",
                "secondary": "#5c5e63",
                "background": "#fdf7ff",
                "error-container": "#ffdad6",
                "on-error-container": "#93000a",
                "tertiary-fixed": "#e1e0ff",
                "surface-container-low": "#f8f2fa",
                "on-surface": "#1d1b20",
                "primary": "#4f378a",
                "surface-container-high": "#ece6ee",
                "surface-container-highest": "#e6e0e9",
                "outline": "#7a7582",
                "on-surface-variant": "#494551",
                "on-primary-container": "#e0d2ff",
                "on-primary-fixed": "#22005d",
                "on-secondary-container": "#626469",
                "on-tertiary-container": "#d6d5ff",
                "error": "#ba1a1a",
                "tertiary": "#2f2ebe",
                "on-secondary-fixed-variant": "#44474b",
                "surface-bright": "#fdf7ff",
                "on-error": "#ffffff",
                "on-secondary": "#ffffff"
              },
              borderRadius: {
                DEFAULT: "0.25rem",
                lg: "0.5rem",
                xl: "0.75rem",
                full: "9999px"
              },
              spacing: {
                xs: "4px",
                sm: "12px",
                xl: "64px",
                gutter: "16px",
                base: "8px",
                margin: "20px",
                md: "24px",
                lg: "40px"
              },
              fontFamily: {
                "headline-md": ["Plus Jakarta Sans"],
                "body-lg": ["Plus Jakarta Sans"],
                "label-md": ["Plus Jakarta Sans"],
                "body-md": ["Plus Jakarta Sans"],
                "display-lg": ["Plus Jakarta Sans"],
                "headline-sm": ["Plus Jakarta Sans"]
              },
              fontSize: {
                "headline-md": ["32px", { lineHeight: "1.2", letterSpacing: "-0.01em", fontWeight: "700" }],
                "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
                "label-md": ["14px", { lineHeight: "1.4", letterSpacing: "0.05em", fontWeight: "600" }],
                "body-md": ["16px", { lineHeight: "1.6", fontWeight: "400" }],
                "display-lg": ["48px", { lineHeight: "1.1", letterSpacing: "-0.02em", fontWeight: "800" }],
                "headline-sm": ["24px", { lineHeight: "1.3", fontWeight: "700" }]
              }
            },
          },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .gradient-brand {
            background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .soft-elevation {
            box-shadow: 0 4px 20px rgba(248, 46, 110, 0.05);
        }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="bg-[#F8FAFC] font-body-md text-on-background antialiased min-h-screen">
@php
    $navItems = [
        ['key' => 'dashboard', 'label' => __('ui.dashboard'), 'icon' => 'dashboard', 'route' => route('admin.dashboard')],
        ['key' => 'users', 'label' => __('ui.user_moderation'), 'icon' => 'group', 'route' => route('admin.users')],
        ['key' => 'trips', 'label' => __('ui.trip_validation'), 'icon' => 'verified_user', 'route' => route('admin.trips')],
        ['key' => 'fleet', 'label' => __('ui.fleet_status'), 'icon' => 'directions_car', 'route' => route('admin.fleet')],
        ['key' => 'analytics', 'label' => __('ui.analytics'), 'icon' => 'analytics', 'route' => route('admin.analytics')],
    ];
@endphp
<nav class="fixed left-0 top-0 bottom-0 w-64 flex flex-col p-6 z-50 bg-white border-r border-slate-100 shadow-sm font-['Plus_Jakarta_Sans'] font-medium text-sm">
    <div class="mb-10">
        <a class="inline-block text-3xl font-black tracking-tight gradient-text" href="{{ route('admin.dashboard') }}">RideWave</a>
        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">{{ __('ui.admin_portal') }}</p>
    </div>
    <div class="space-y-1 flex-1">
        @foreach ($navItems as $item)
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all active:scale-[0.98] {{ ($navActive ?? '') === $item['key'] ? 'text-rose-600 bg-rose-50 border-r-4 border-rose-500' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50' }}" href="{{ $item['route'] }}">
                <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                {{ $item['label'] }}
            </a>
        @endforeach
    </div>
    <div class="mt-auto pt-6 border-t border-slate-100">
        <a class="flex items-center gap-3 rounded-xl px-2 py-2 transition-all hover:bg-slate-50 active:scale-[0.99]" href="{{ route('admin.profile.edit') }}">
            @if (auth()->user()->profile_photo_path)
                <img alt="Admin Profile" class="w-10 h-10 rounded-full border-2 border-rose-100 object-cover" src="{{ route('admin.profile.photo') }}"/>
            @else
                <div class="w-10 h-10 rounded-full border-2 border-rose-100 gradient-brand flex items-center justify-center text-sm font-black text-white">
                    {{ auth()->user()->profileInitial() }}
                </div>
            @endif
            <div class="overflow-hidden">
                <p class="text-sm font-bold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-500 truncate">Senior Controller</p>
            </div>
        </a>
    </div>
</nav>

<main class="ml-64 min-h-screen">
    <header class="sticky top-0 w-full z-40 flex justify-between items-center px-8 h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-[0_4px_20px_rgba(248,46,110,0.05)] font-['Plus_Jakarta_Sans'] antialiased">
        <div class="flex items-center gap-4 flex-1">
            <form action="{{ route('admin.search') }}" class="relative w-full max-w-md" method="GET">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">search</span>
                <input class="w-full pl-10 pr-4 py-2 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 transition-all" name="q" placeholder="{{ __('ui.search_placeholder') }}" type="text" value="{{ $query ?? request('q', '') }}"/>
            </form>
        </div>
        <div class="flex items-center gap-4">
            @include('partials.language-switcher')
            @include('partials.theme-toggle-button')
            <a class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-500 hover:bg-slate-50 transition-all active:scale-95" href="{{ route('admin.trips') }}">
                <span class="material-symbols-outlined">notifications</span>
            </a>
            <a class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-500 hover:bg-slate-50 transition-all active:scale-95" href="{{ route('admin.analytics') }}">
                <span class="material-symbols-outlined">settings</span>
            </a>
            <div class="h-8 w-[1px] bg-slate-100 mx-2"></div>
            <div class="gradient-brand text-white px-4 py-2 rounded-xl text-sm font-bold shadow-md">
                {{ __('ui.system_status') }}: {{ $systemStatus ?? __('ui.optimal') }}
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-4 py-2 rounded-xl border border-slate-200 text-slate-700 text-sm font-bold hover:bg-slate-50 transition-all" type="submit">{{ __('ui.logout') }}</button>
            </form>
        </div>
    </header>

    @if (session('success'))
        <div class="px-8 pt-6">
            <div class="rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="px-8 pt-6">
            <div class="rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700">{{ $errors->first() }}</div>
        </div>
    @endif

    <div class="p-8 space-y-8">
        @yield('content')
    </div>
</main>

@hasSection('fab')
    @yield('fab')
@endif
@include('partials.theme-toggle-script')
</body>
</html>


