<!DOCTYPE html>

<html class="light scroll-smooth" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="#ffffff" name="theme-color"/>
<title>{{ __('ui.home_title') }}</title>
@include('partials.theme-init')
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-fixed-variant": "#4f378a",
                        "surface-bright": "#fdf7ff",
                        "on-tertiary-container": "#d6d5ff",
                        "primary-fixed": "#e9ddff",
                        "on-background": "#1d1b20",
                        "on-error": "#ffffff",
                        "secondary-fixed": "#e1e2e8",
                        "outline": "#7a7582",
                        "tertiary-container": "#494bd6",
                        "secondary-fixed-dim": "#c5c6cc",
                        "on-surface": "#1d1b20",
                        "on-secondary-fixed": "#191c20",
                        "on-error-container": "#93000a",
                        "inverse-primary": "#cfbcff",
                        "secondary": "#5c5e63",
                        "on-tertiary": "#ffffff",
                        "surface": "#fdf7ff",
                        "inverse-on-surface": "#f5eff7",
                        "on-primary-fixed": "#22005d",
                        "on-secondary": "#ffffff",
                        "surface-container-low": "#f8f2fa",
                        "tertiary-fixed": "#e1e0ff",
                        "on-secondary-container": "#626469",
                        "background": "#fdf7ff",
                        "surface-container": "#f2ecf4",
                        "surface-variant": "#e6e0e9",
                        "surface-container-high": "#ece6ee",
                        "surface-dim": "#ded8e0",
                        "primary-fixed-dim": "#cfbcff",
                        "on-primary-container": "#e0d2ff",
                        "tertiary": "#2f2ebe",
                        "error-container": "#ffdad6",
                        "surface-container-highest": "#e6e0e9",
                        "surface-tint": "#6750a4",
                        "error": "#ba1a1a",
                        "on-tertiary-fixed": "#07006c",
                        "on-primary": "#ffffff",
                        "primary-container": "#6750a4",
                        "outline-variant": "#cbc4d2",
                        "tertiary-fixed-dim": "#c0c1ff",
                        "on-tertiary-fixed-variant": "#2f2ebe",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed-variant": "#44474b",
                        "primary": "#4f378a",
                        "secondary-container": "#e1e2e8",
                        "inverse-surface": "#322f35",
                        "on-surface-variant": "#494551"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "lg": "40px",
                        "margin": "20px",
                        "sm": "12px",
                        "xl": "64px",
                        "md": "24px",
                        "xs": "4px",
                        "base": "8px",
                        "gutter": "16px"
                    },
                    "fontFamily": {
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-sm": ["24px", {"lineHeight": "1.3", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-md": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .brand-gradient {
            background: linear-gradient(to right, #F26D5D, #F82E6E);
        }
        .brand-text-gradient {
            background: linear-gradient(to right, #F26D5D, #F82E6E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .wheel-icon {
            width: 1.5rem;
            height: 1.5rem;
            display: block;
        }
        .city-field {
            position: relative;
        }
        .city-input {
            width: 100%;
            border: none;
            padding: 0;
            background: transparent;
            font-weight: 700;
            color: inherit;
            outline: none;
        }
        .city-input::placeholder {
            color: #94a3b8;
        }
        .city-menu {
            position: absolute;
            top: calc(100% + 0.75rem);
            left: 0;
            right: 0;
            z-index: 80;
            display: none;
            max-height: 16rem;
            overflow-y: auto;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
            backdrop-filter: blur(10px);
        }
        .city-menu.is-open {
            display: block;
        }
        .city-option,
        .city-empty {
            width: 100%;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
        }
        .city-option {
            border: none;
            background: transparent;
            color: #0f172a;
            font-weight: 700;
            text-align: left;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .city-option:hover,
        .city-option.is-active {
            background: rgba(244, 63, 94, 0.08);
            color: #e11d48;
        }
        .city-empty {
            color: #64748b;
            font-weight: 600;
        }
        .date-trigger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: none;
            background: transparent;
            color: #f43f5e;
            cursor: pointer;
        }
        .date-trigger:focus-visible {
            outline: 2px solid rgba(244, 63, 94, 0.3);
            outline-offset: 4px;
            border-radius: 0.75rem;
        }
        .date-input {
            appearance: none;
            -webkit-appearance: none;
            background: transparent;
        }
        .date-input::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }
        .date-input::-webkit-clear-button,
        .date-input::-webkit-inner-spin-button {
            display: none;
        }
        .nav-active {
            color: #F82E6E !important;
            font-weight: 700;
        }
        #main-header {
            transition: all 0.3s ease;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
@include('partials.ridewave-theme')
</head>
<body class="bg-surface-container-lowest font-body-md text-on-surface">
<!-- TopNavBar -->
<header class="fixed top-0 w-full z-[120] bg-transparent border-b border-transparent" id="main-header">
<div class="flex justify-between items-center h-16 px-6 max-w-7xl mx-auto">
<div class="flex items-center gap-8">
<a class="text-2xl font-black bg-gradient-to-r from-[#F26D5D] to-[#F82E6E] bg-clip-text text-transparent font-['Plus_Jakarta_Sans'] tracking-tight" href="#">RideWave</a>
<nav class="hidden md:flex gap-6 items-center">
<a class="nav-link text-slate-600 hover:text-rose-500 transition-colors font-['Plus_Jakarta_Sans'] tracking-tight" href="#find-rides" id="nav-find-rides">{{ __('ui.find_rides') }}</a>
<a class="nav-link text-slate-600 hover:text-rose-500 transition-colors font-['Plus_Jakarta_Sans'] tracking-tight" href="#how-it-works" id="nav-how-it-works">{{ __('ui.how_it_works') }}</a>
<a class="nav-link text-slate-600 hover:text-rose-500 transition-colors font-['Plus_Jakarta_Sans'] tracking-tight" href="#advantages" id="nav-advantages">{{ __('ui.advantages') }}</a>
<a class="nav-link text-slate-600 hover:text-rose-500 transition-colors font-['Plus_Jakarta_Sans'] tracking-tight" href="#community" id="nav-community">{{ __('ui.community') }}</a>
</nav>
</div>
<div class="flex items-center gap-4">
@include('partials.language-switcher')
@include('partials.theme-toggle-button')
<a href="{{ route('login') }}" class="hidden lg:inline-flex px-4 py-2 text-slate-600 hover:bg-slate-50 rounded-lg transition-all active:scale-95 duration-200">{{ __('ui.login') }}</a>
<a href="{{ route('register') }}" class="brand-gradient text-white px-6 py-2 rounded-full font-bold shadow-lg shadow-rose-500/20 active:scale-95 transition-all">{{ __('ui.get_started') }}</a>
</div>
</div>
</header>
<main class="pt-16 pb-24 md:pb-0">
<!-- Hero Section -->
<section class="relative min-h-[90vh] flex flex-col items-center justify-center px-6 py-10 lg:py-0 overflow-visible scroll-mt-24" id="find-rides">
<div class="absolute inset-0 z-0">
<div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-rose-100/30 blur-[120px] rounded-full"></div>
<div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-orange-100/30 blur-[120px] rounded-full"></div>
</div>
<div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-10 md:mb-16">
<div class="text-left">
<span class="inline-block px-4 py-1.5 rounded-full bg-rose-50 text-rose-600 font-label-md text-label-md mb-6 uppercase tracking-widest">Share the Ride, Split the Cost</span>
<h1 class="text-[3.5rem] sm:text-[4.25rem] lg:text-display-lg font-display-lg text-on-background mb-4 md:mb-6 leading-[1.05]">
                        Your Daily Journey, <br/><span class="brand-text-gradient">Redefined.</span>
</h1>
<p class="text-lg md:text-body-lg font-body-lg text-secondary max-w-lg mb-6 md:mb-8">
                        Join thousands of professionals commuting together. Safe, sustainable, and way more social than driving alone.
                    </p>
<div class="flex flex-wrap gap-4">
<a class="brand-gradient text-white px-6 md:px-8 py-3.5 md:py-4 rounded-2xl font-bold text-base md:text-lg shadow-xl shadow-rose-500/30 active:scale-95 transition-all inline-flex items-center justify-center" href="{{ route('register') }}">Start Carpooling</a>
<a class="bg-white border-2 border-slate-100 text-slate-600 px-6 md:px-8 py-3.5 md:py-4 rounded-2xl font-bold text-base md:text-lg hover:border-rose-200 transition-all flex items-center gap-2" href="#how-it-works">
<span class="material-symbols-outlined" data-icon="play_circle">play_circle</span>
                            How it works
                        </a>
</div>
</div>
<div class="hero-visual relative max-w-md lg:max-w-none mx-auto w-full">
<img alt="Modern carpooling illustration with diverse professionals" class="hero-visual-image relative z-10 w-full h-[240px] sm:h-[320px] lg:h-auto rounded-[2rem] object-cover object-center shadow-[0_30px_80px_rgba(248,46,110,0.18)]" src="{{ asset('images/hero.jpg') }}"/>
</div>
</div>
<!-- Search Bar Component -->
<div class="relative z-20 w-full max-w-5xl mb-12 overflow-visible">
<form action="{{ auth()->check() ? (auth()->user()->isDriver() ? route('driver.find-rides') : route('passenger.find-rides')) : route('login') }}" class="relative overflow-visible bg-white rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.08)] p-4 md:p-6 grid grid-cols-1 md:grid-cols-4 gap-4 items-center" method="GET">
@guest
<input name="redirect_search" type="hidden" value="1"/>
@endguest
<div class="city-field flex flex-col gap-1 px-4 border-r border-slate-100" data-city-field>
<label class="text-xs font-bold text-slate-400 uppercase tracking-tighter">{{ __('ui.leaving_from') }}</label>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-rose-500" data-icon="location_on">location_on</span>
<input autocomplete="off" class="city-input text-body-md" data-city-input name="depart" placeholder="{{ __('ui.type_tunisian_city') }}" type="text"/>
</div>
<div class="city-menu" data-city-menu></div>
</div>
<div class="city-field flex flex-col gap-1 px-4 border-r border-slate-100" data-city-field>
<label class="text-xs font-bold text-slate-400 uppercase tracking-tighter">{{ __('ui.going_to') }}</label>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-rose-500" data-icon="near_me">near_me</span>
<input autocomplete="off" class="city-input text-body-md" data-city-input name="destination" placeholder="{{ __('ui.type_tunisian_city') }}" type="text"/>
</div>
<div class="city-menu" data-city-menu></div>
</div>
<div class="flex flex-col gap-1 px-4 border-r border-slate-100">
<label class="text-xs font-bold text-slate-400 uppercase tracking-tighter">{{ __('ui.date') }}</label>
<div class="flex items-center gap-2">
<button aria-label="Open date picker" class="date-trigger" data-date-trigger type="button">
<span class="material-symbols-outlined text-rose-500" data-icon="calendar_today">calendar_today</span>
</button>
<input class="date-input w-full border-none p-0 focus:ring-0 text-body-md font-bold placeholder:text-slate-300" data-date-input name="date" placeholder="{{ __('ui.select_date') }}" type="date"/>
</div>
</div>
<div class="px-4">
<button class="brand-gradient w-full py-4 rounded-xl text-white font-bold text-lg shadow-xl shadow-rose-500/30 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2" type="submit">
<span class="material-symbols-outlined" data-icon="search">search</span>
                            {{ __('ui.find_rides') }}
                        </button>
</div>
</form>
</div>
<!-- How It Works Section -->
<section id="how-it-works">
<div class="relative z-10 w-full max-w-7xl mx-auto py-16 px-6">
<div class="text-center mb-12">
<h2 class="text-headline-md font-headline-md text-on-background">Getting started is easy</h2>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
<!-- For Passengers -->
<div class="bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] border border-white shadow-sm">
<div class="flex items-center gap-4 mb-10">
<div class="w-12 h-12 rounded-2xl brand-gradient flex items-center justify-center text-white">
<span class="material-symbols-outlined" data-icon="person">person</span>
</div>
<h3 class="text-headline-sm font-bold">For Passengers</h3>
</div>
<div class="space-y-10">
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-rose-500 flex items-center justify-center font-bold text-rose-600">1</div>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined brand-text-gradient font-bold" data-icon="search">search</span>
<h4 class="font-bold text-lg">Search</h4>
</div>
<p class="text-secondary">Enter your origin, destination, and preferred travel date to see available rides.</p>
</div>
</div>
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-rose-500 flex items-center justify-center font-bold text-rose-600">2</div>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined brand-text-gradient font-bold" data-icon="event_available">event_available</span>
<h4 class="font-bold text-lg">Book</h4>
</div>
<p class="text-secondary">Select your preferred driver, review their profile, and secure your seat instantly.</p>
</div>
</div>
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-rose-500 flex items-center justify-center font-bold text-rose-600">3</div>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined brand-text-gradient font-bold" data-icon="directions_car">directions_car</span>
<h4 class="font-bold text-lg">Ride</h4>
</div>
<p class="text-secondary">Meet your driver at the pickup point and enjoy a comfortable, social commute.</p>
</div>
</div>
</div>
</div>
<!-- For Drivers -->
<div class="bg-white/60 backdrop-blur-md p-8 rounded-[2.5rem] border border-white shadow-sm">
<div class="flex items-center gap-4 mb-10">
<div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white brand-gradient">
<svg aria-hidden="true" class="wheel-icon" fill="none" viewBox="0 0 24 24">
<circle cx="12" cy="12" r="7" stroke="currentColor" stroke-width="2"/>
<circle cx="12" cy="12" r="2" fill="currentColor"/>
<path d="M12 5v5M5.5 10.5l4.4 2.1M18.5 10.5l-4.4 2.1M8.8 18l1.8-4M15.2 18l-1.8-4" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
</svg>
</div>
<h3 class="text-headline-sm font-bold">For Drivers</h3>
</div>
<div class="space-y-10">
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-slate-900 flex items-center justify-center font-bold text-slate-900">1</div>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined brand-text-gradient font-bold" data-icon="add_location">add_location</span>
<h4 class="font-bold text-lg">Post</h4>
</div>
<p class="text-secondary">List your upcoming trip details, empty seats, and price per passenger.</p>
</div>
</div>
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-slate-900 flex items-center justify-center font-bold text-slate-900">2</div>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined brand-text-gradient font-bold" data-icon="how_to_reg">how_to_reg</span>
<h4 class="font-bold text-lg">Review</h4>
</div>
<p class="text-secondary">Check booking requests and verify passenger profiles before accepting.</p>
</div>
</div>
<div class="flex gap-6">
<div class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-slate-900 flex items-center justify-center font-bold text-slate-900">3</div>
<div>
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined brand-text-gradient font-bold" data-icon="payments">payments</span>
<h4 class="font-bold text-lg">Earn</h4>
</div>
<p class="text-secondary">Complete the ride and receive your earnings directly to your RideWave wallet.</p>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Trust Badges -->
</section>
<!-- Features Bento Grid / Advantages -->
<section class="py-xl scroll-mt-24" id="advantages">
<div class="max-w-7xl mx-auto px-6">
<div class="text-center mb-16">
<h2 class="text-headline-md font-headline-md text-on-background mb-4">The RideWave Advantage</h2>
<p class="text-body-md text-secondary max-w-xl mx-auto">Built with security and social connection at the core, transforming how you perceive your daily commute.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 grid-rows-2 gap-6 h-auto md:h-[600px]">
<!-- Passenger Main -->
<div class="md:col-span-2 bg-slate-900 rounded-3xl p-10 flex flex-col justify-between relative overflow-hidden group">
<div class="relative z-10">
<span class="text-rose-400 font-bold uppercase tracking-widest text-xs mb-4 block">For Passengers</span>
<h3 class="text-headline-md font-headline-md text-white mb-4">First-Class Travel at Coach Pricing</h3>
<p class="text-slate-400 max-w-sm">Enjoy premium vehicles, vetted drivers, and door-to-door convenience for a fraction of the cost of ride-hailing services.</p>
</div>
<div class="mt-8">
<button class="bg-white text-slate-950 px-6 py-3 rounded-xl font-bold hover:bg-rose-50 transition-colors">Book Your Seat</button>
</div>
<div class="absolute right-[-50px] bottom-[-50px] w-96 h-96 bg-gradient-to-br from-rose-500/20 to-orange-500/0 blur-3xl rounded-full"></div>
</div>
<!-- Driver Main -->
<div class="bg-surface-container rounded-3xl p-10 flex flex-col justify-center relative overflow-hidden group border border-slate-100">
<span class="text-rose-600 font-bold uppercase tracking-widest text-xs mb-4 block">Trusted Drivers</span>
<h3 class="text-headline-sm font-headline-sm text-on-surface mb-4">Turn Miles into Earnings</h3>
<p class="text-secondary text-sm mb-6">Offset your fuel costs and car maintenance by sharing empty seats with verified members of your community.</p>
<ul class="space-y-3">
<li class="flex items-center gap-2 text-sm font-bold text-on-surface">
<span class="material-symbols-outlined text-rose-500 text-[18px]" data-icon="check_circle">check_circle</span> Verified Passengers
                            </li>
<li class="flex items-center gap-2 text-sm font-bold text-on-surface">
<span class="material-symbols-outlined text-rose-500 text-[18px]" data-icon="check_circle">check_circle</span> Automated Tolls
                            </li>
<li class="flex items-center gap-2 text-sm font-bold text-on-surface">
<span class="material-symbols-outlined text-rose-500 text-[18px]" data-icon="check_circle">check_circle</span> Schedule Control
                            </li>
</ul>
</div>
<!-- Trust Card -->
<div class="bg-rose-50 rounded-3xl p-10 flex flex-col items-center text-center justify-center border border-rose-100">
<div class="w-16 h-16 rounded-2xl brand-gradient flex items-center justify-center text-white mb-6 shadow-lg shadow-rose-500/20">
<span class="material-symbols-outlined text-[32px]" data-icon="verified_user">verified_user</span>
</div>
<h3 class="text-headline-sm font-headline-sm text-on-surface mb-2">Maximum Safety</h3>
<p class="text-secondary text-sm">Every rider and driver undergoes identity verification and real-time ride tracking.</p>
</div>
<!-- Eco Card -->
<div class="md:col-span-2 bg-surface-container-highest rounded-3xl p-10 flex items-center justify-between overflow-hidden group">
<div class="max-w-md">
<h3 class="text-headline-sm font-headline-sm text-on-surface mb-4">Impact the Planet</h3>
<p class="text-secondary">By carpooling with RideWave, you're helping reduce traffic congestion and CO2 emissions. Join thousands of users making their city greener.</p>
</div>
<div class="hidden lg:block">
<div class="relative">
<div class="w-32 h-32 bg-green-500/10 rounded-full blur-2xl absolute inset-0 animate-pulse"></div>
<span class="material-symbols-outlined text-[120px] text-green-500/40 relative z-10" data-icon="eco">eco</span>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Community Section / Testimonials -->
<section class="py-xl bg-surface-container-low/50 scroll-mt-24" id="community">
<div class="max-w-7xl mx-auto px-6">
<div class="text-center mb-16">
<span class="inline-block px-4 py-1 rounded-full bg-rose-50 text-rose-600 font-bold text-[10px] uppercase tracking-[0.2em] mb-4">Testimonials</span>
<h2 class="text-headline-md font-headline-md text-on-background mb-4">What our community says</h2>
<p class="text-body-md text-secondary max-w-xl mx-auto">Real experiences from our growing network of commuters and drivers.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Testimonial 1 -->
<div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
<span class="material-symbols-outlined text-[64px]" data-icon="format_quote">format_quote</span>
</div>
<div class="flex gap-1 mb-6">
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="text-on-surface-variant font-medium leading-relaxed mb-8 italic">"RideWave has completely changed my morning routine. I've met some incredible professionals and cut my commute costs by 60%!"</p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden border-2 border-rose-100">
<img alt="Sarah J." class="w-full h-full object-cover" src="{{ asset('images/person_1.jpg') }}"/>
</div>
<div>
<h4 class="font-bold text-on-surface">Sarah Jenkins</h4>
<p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Passenger</p>
</div>
</div>
</div>
<!-- Testimonial 2 -->
<div class="bg-white p-8 rounded-[2rem] shadow-sm border-2 border-rose-100/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
<span class="material-symbols-outlined text-[64px]" data-icon="format_quote">format_quote</span>
</div>
<div class="flex gap-1 mb-6">
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="text-on-surface-variant font-medium leading-relaxed mb-8 italic">"As a driver, I love the verification process. It's safe, easy to use, and I'm basically getting my gas money back every single week."</p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden border-2 border-rose-100">
<img alt="Marcus T." class="w-full h-full object-cover" src="{{ asset('images/person_2.jpg') }}"/>
</div>
<div>
<h4 class="font-bold text-on-surface">Marcus Thornton</h4>
<p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Verified Driver</p>
</div>
</div>
</div>
<!-- Testimonial 3 -->
<div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
<span class="material-symbols-outlined text-[64px]" data-icon="format_quote">format_quote</span>
</div>
<div class="flex gap-1 mb-6">
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px] brand-text-gradient font-variation-fill" style="font-variation-settings: 'FILL' 1;">star_half</span>
</div>
<p class="text-on-surface-variant font-medium leading-relaxed mb-8 italic">"The door-to-door convenience is unbeatable. No more waiting for late buses or overpriced taxis. Highly recommended for daily travel."</p>
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden border-2 border-rose-100">
<img alt="Elena R." class="w-full h-full object-cover" src="{{ asset('images/person_3.jpg') }}"/>
</div>
<div>
<h4 class="font-bold text-on-surface">Elena Rodriguez</h4>
<p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Passenger</p>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-slate-50 border-t border-slate-200 py-12">
<div class="flex flex-col md:flex-row justify-between items-center px-6 md:px-12 max-w-7xl mx-auto gap-8">
<div class="flex flex-col items-center md:items-start gap-4">
<span class="text-xl font-bold text-slate-900">RideWave</span>
<p class="text-slate-600 text-sm tracking-tight">&copy; 2024 RideWave. Moving forward, together.</p>
</div>
<div class="flex flex-wrap justify-center gap-x-8 gap-y-4">
<a class="text-slate-600 text-sm hover:text-slate-900 transition-colors" href="#">Privacy Policy</a>
<a class="text-slate-600 text-sm hover:text-slate-900 transition-colors" href="#">Terms of Service</a>
<a class="text-slate-600 text-sm hover:text-slate-900 transition-colors" href="#">Safety Guidelines</a>
<a class="text-slate-600 text-sm hover:text-slate-900 transition-colors" href="#">Support</a>
</div>
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#F82E6E] cursor-pointer transition-all">
<span class="material-symbols-outlined text-lg" data-icon="share">share</span>
</div>
<div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#F82E6E] cursor-pointer transition-all">
<span class="material-symbols-outlined text-lg" data-icon="public">public</span>
</div>
</div>
</div>
</footer>
<!-- Bottom Nav for Mobile -->
<div class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t border-slate-100 z-50 flex justify-around items-center h-20 px-4 shadow-[0_-10px_40px_rgba(0,0,0,0.05)]">
<a class="flex flex-col items-center gap-1 text-rose-600" href="#find-rides">
<span class="material-symbols-outlined" data-icon="explore" style="font-variation-settings: 'FILL' 1;">explore</span>
<span class="text-[10px] font-bold uppercase tracking-widest">Find</span>
</a>
<a class="flex flex-col items-center gap-1 text-slate-400" href="#how-it-works">
<span class="material-symbols-outlined" data-icon="help">help</span>
<span class="text-[10px] font-bold uppercase tracking-widest">How</span>
</a>
<a class="flex flex-col items-center gap-1 text-slate-400" href="#advantages">
<span class="material-symbols-outlined" data-icon="verified_user">verified_user</span>
<span class="text-[10px] font-bold uppercase tracking-widest">Trust</span>
</a>
<a class="flex flex-col items-center gap-1 text-slate-400" href="#community">
<span class="material-symbols-outlined" data-icon="forum">forum</span>
<span class="text-[10px] font-bold uppercase tracking-widest">Social</span>
</a>
</div>
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const header = document.getElementById('main-header');
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section[id]');
            const tunisianCities = [
                'Tunis',
                'Sfax',
                'Sousse',
                'Kairouan',
                'Bizerte',
                'Gabes',
                'Ariana',
                'Gafsa',
                'Monastir',
                'Ben Arous',
                'Nabeul',
                'Mahdia',
                'Medenine',
                'Tozeur',
                'Kasserine',
                'Jendouba',
                'Beja',
                'Kebili',
                'Siliana',
                'Zaghouan',
                'Manouba',
                'Tataouine',
                'El Kef',
                'Hammamet'
            ];

            const syncHeader = () => {
                if (!header) {
                    return;
                }

                const scrollPos = window.scrollY;

                if (scrollPos > 50) {
                    header.classList.remove('bg-transparent', 'border-transparent');
                    header.classList.add('bg-white/95', 'backdrop-blur-sm', 'border-slate-100', 'shadow-[0_4px_20px_rgba(248,46,110,0.08)]');
                } else {
                    header.classList.add('bg-transparent', 'border-transparent');
                    header.classList.remove('bg-white/95', 'backdrop-blur-sm', 'border-slate-100', 'shadow-[0_4px_20px_rgba(248,46,110,0.08)]');
                }

                let current = '';

                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;

                    if (scrollPos >= sectionTop - 100 && scrollPos < sectionTop + sectionHeight - 100) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach((link) => {
                    link.classList.remove('nav-active');

                    const href = link.getAttribute('href')?.replace('#', '');

                    if (href === current) {
                        link.classList.add('nav-active');
                    }
                });
            };

            syncHeader();
            window.addEventListener('scroll', syncHeader, { passive: true });

            document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');

                    if (targetId === '#') {
                        return;
                    }

                    e.preventDefault();

                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 64,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            const setupCityAutocomplete = (field) => {
                const input = field.querySelector('[data-city-input]');
                const menu = field.querySelector('[data-city-menu]');

                if (!input || !menu) {
                    return;
                }

                let activeIndex = -1;
                let visibleCities = [...tunisianCities];

                const syncActiveOption = () => {
                    menu.querySelectorAll('.city-option').forEach((option, index) => {
                        option.classList.toggle('is-active', index === activeIndex);
                    });
                };

                const selectCity = (city) => {
                    input.value = city;
                    menu.classList.remove('is-open');
                };

                const renderOptions = (query = '') => {
                    const normalizedQuery = query.trim().toLowerCase();
                    visibleCities = tunisianCities.filter((city) => city.toLowerCase().includes(normalizedQuery));
                    activeIndex = visibleCities.length ? 0 : -1;

                    if (!visibleCities.length) {
                        menu.innerHTML = '<div class="city-empty">No matching city</div>';
                        menu.classList.add('is-open');
                        return;
                    }

                    menu.innerHTML = visibleCities.map((city, index) => `
                        <button class="city-option${index === activeIndex ? ' is-active' : ''}" type="button" data-city-option="${city}">
                            ${city}
                        </button>
                    `).join('');

                    menu.classList.add('is-open');
                };

                input.addEventListener('focus', () => {
                    renderOptions(input.value);
                });

                input.addEventListener('input', () => {
                    renderOptions(input.value);
                });

                input.addEventListener('keydown', (event) => {
                    if (!menu.classList.contains('is-open')) {
                        return;
                    }

                    if (event.key === 'ArrowDown') {
                        event.preventDefault();
                        if (visibleCities.length) {
                            activeIndex = (activeIndex + 1) % visibleCities.length;
                            syncActiveOption();
                        }
                    }

                    if (event.key === 'ArrowUp') {
                        event.preventDefault();
                        if (visibleCities.length) {
                            activeIndex = (activeIndex - 1 + visibleCities.length) % visibleCities.length;
                            syncActiveOption();
                        }
                    }

                    if (event.key === 'Enter' && activeIndex >= 0 && visibleCities[activeIndex]) {
                        event.preventDefault();
                        selectCity(visibleCities[activeIndex]);
                    }

                    if (event.key === 'Escape') {
                        menu.classList.remove('is-open');
                    }
                });

                menu.addEventListener('click', (event) => {
                    const option = event.target.closest('[data-city-option]');

                    if (!option) {
                        return;
                    }

                    selectCity(option.dataset.cityOption);
                    input.focus();
                });
            };

            document.querySelectorAll('[data-city-field]').forEach(setupCityAutocomplete);

            document.querySelectorAll('[data-date-trigger]').forEach((button) => {
                const container = button.closest('div');
                const input = container?.querySelector('[data-date-input]');

                if (!input) {
                    return;
                }

                button.addEventListener('click', () => {
                    if (typeof input.showPicker === 'function') {
                        input.showPicker();
                    } else {
                        input.focus();
                        input.click();
                    }
                });
            });

            document.addEventListener('click', (event) => {
                document.querySelectorAll('[data-city-field]').forEach((field) => {
                    if (!field.contains(event.target)) {
                        field.querySelector('[data-city-menu]')?.classList.remove('is-open');
                    }
                });
            });
        });
    </script>
@include('partials.theme-toggle-script')
</body></html>

