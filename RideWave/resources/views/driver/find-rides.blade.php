<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ __('ui.driver_find_rides_title') }}</title>
    <meta content="#ffffff" name="theme-color"/>
    @include('partials.theme-init')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        surface: "#fffaf7",
                        blush: "#fff1eb",
                        coral: "#f26d5d",
                        berry: "#f82e6e",
                        ink: "#132238",
                        mist: "#eef4fb",
                    },
                    fontFamily: {
                        sans: ["Plus Jakarta Sans", "sans-serif"],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            background:
                radial-gradient(circle at top left, rgba(242, 109, 93, 0.18), transparent 28%),
                radial-gradient(circle at 85% 12%, rgba(248, 46, 110, 0.15), transparent 24%),
                linear-gradient(180deg, #fffaf7 0%, #ffffff 54%, #fff7f3 100%);
        }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
        .brand-gradient { background: linear-gradient(135deg, #f26d5d 0%, #f82e6e 100%); }
        .brand-shadow { box-shadow: 0 24px 60px rgba(248, 46, 110, 0.15); }
        .soft-shadow { box-shadow: 0 20px 55px rgba(19, 34, 56, 0.08); }
        .map-grid {
            background-image:
                linear-gradient(rgba(19, 34, 56, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(19, 34, 56, 0.05) 1px, transparent 1px);
            background-size: 28px 28px;
        }
        .picker-trigger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: none;
            background: transparent;
            color: #f82e6e;
            cursor: pointer;
        }
        .picker-trigger:focus-visible {
            outline: 2px solid rgba(248, 46, 110, 0.22);
            outline-offset: 4px;
            border-radius: 0.75rem;
        }
        .native-picker-input {
            appearance: none;
            -webkit-appearance: none;
            background: transparent;
        }
        .native-picker-input::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }
        .native-picker-input::-webkit-clear-button,
        .native-picker-input::-webkit-inner-spin-button {
            display: none;
        }
        .filter-chip-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 9999px;
            border: 1px solid #d7e0ec;
            background: #f8fafc;
            padding: 0.55rem 0.95rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: #5a6b82;
            transition: all 0.18s ease;
            cursor: pointer;
        }
        .filter-chip-input:checked + .filter-chip {
            border-color: rgba(248, 46, 110, 0.16);
            background: rgba(248, 46, 110, 0.08);
            color: #f82e6e;
        }
        .city-option[hidden] { display: none; }

        html.dark body.driver-find-rides-page {
            background:
                radial-gradient(circle at top left, rgba(244, 63, 94, 0.12), transparent 30%),
                radial-gradient(circle at 85% 12%, rgba(15, 23, 42, 0.88), transparent 26%),
                linear-gradient(180deg, #08111f 0%, #0b1220 55%, #08111f 100%);
        }

        html.dark .driver-find-rides-page .soft-shadow {
            box-shadow: 0 24px 60px rgba(2, 6, 23, 0.56);
        }

        html.dark .driver-find-rides-page .brand-shadow {
            box-shadow: 0 18px 46px rgba(190, 24, 93, 0.28);
        }

        html.dark .driver-find-rides-page .map-grid {
            background-image:
                linear-gradient(rgba(148, 163, 184, 0.12) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.12) 1px, transparent 1px);
        }

        html.dark .driver-find-rides-page .filter-chip {
            border-color: rgba(148, 163, 184, 0.24);
            background: rgba(15, 23, 42, 0.86);
            color: #cbd5e1;
        }

        html.dark .driver-find-rides-page .filter-chip-input:checked + .filter-chip {
            border-color: rgba(244, 63, 94, 0.36);
            background: rgba(244, 63, 94, 0.16);
            color: #fecdd3;
        }

        html.dark .driver-find-rides-page [class*='from-slate-50'][class*='to-rose-50/70'] {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(30, 41, 59, 0.9)) !important;
        }

        html.dark .driver-find-rides-page .text-slate-500 {
            color: #cbd5e1 !important;
        }

        html.dark .driver-find-rides-page .text-slate-400 {
            color: #a9b8cd !important;
        }

        html.dark .driver-find-rides-page .ride-result-card {
            background: linear-gradient(180deg, #0f172a 0%, #0b1220 100%) !important;
            border-color: rgba(148, 163, 184, 0.24) !important;
            box-shadow: 0 16px 36px rgba(2, 6, 23, 0.44);
        }

        html.dark .driver-find-rides-page .ride-result-card .border-t {
            border-color: rgba(148, 163, 184, 0.2) !important;
        }

        html.dark .driver-find-rides-page .ride-result-card .text-slate-600,
        html.dark .driver-find-rides-page .ride-result-card .text-slate-700 {
            color: #d5deeb !important;
        }

        html.dark .driver-find-rides-page .ride-result-card .text-slate-500,
        html.dark .driver-find-rides-page .ride-result-card .text-slate-400 {
            color: #b7c5d8 !important;
        }

        html.dark .driver-find-rides-page .ride-result-card input[type='number'] {
            background-color: #0b1220 !important;
            border-color: rgba(148, 163, 184, 0.28) !important;
            color: #f8fafc !important;
        }

        html.dark .driver-find-rides-page .ride-result-card a[href*='offer-ride'] {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(148, 163, 184, 0.24) !important;
            color: #d5deeb !important;
        }

        html.dark .driver-find-rides-page .ride-result-card a[href*='offer-ride']:hover {
            border-color: rgba(244, 63, 94, 0.4) !important;
            color: #fecdd3 !important;
        }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="driver-find-rides-page min-h-screen font-sans text-slate-800">
@php
    $ridePages = $rides->chunk(3)->values();
    $activeFilters = collect([
        $filters['depart'],
        $filters['destination'],
        $filters['date'],
        $filters['seats'],
        $filters['price_max'],
        $filters['time_from'],
        $filters['vehicle_type'],
        $filters['sort'],
        $filters['smoking_allowed'] ? 'smoking_allowed' : null,
        $filters['pets_allowed'] ? 'pets_allowed' : null,
        $filters['baggage_allowed'] ? 'baggage_allowed' : null,
        $filters['food_drinks_allowed'] ? 'food_drinks_allowed' : null,
        $filters['ac_included'] ? 'ac_included' : null,
    ])->filter(fn ($value) => filled($value))->count();
@endphp

@include('driver.partials.navbar', ['active' => 'find-rides'])

<main class="pb-16">
    <section class="px-6 pb-10 pt-10 lg:px-8">
        <div class="mx-auto max-w-screen-2xl">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700">{{ $errors->first() }}</div>
            @endif

            <div class="grid gap-5 xl:grid-cols-2">
                <div class="relative overflow-hidden rounded-[30px] border border-white/80 bg-white/85 p-5 soft-shadow lg:p-6">
                    <div class="absolute -left-12 top-0 h-40 w-40 rounded-full bg-orange-100 blur-3xl"></div>
                    <div class="absolute right-0 top-12 h-48 w-48 rounded-full bg-rose-100 blur-3xl"></div>
                    <div class="relative">
                        <span class="mb-3 inline-flex items-center gap-2 rounded-full bg-rose-50 px-3 py-1 text-[10px] font-extrabold uppercase tracking-[0.22em] text-rose-600">
                            <span class="material-symbols-outlined text-base">route</span>
                            {{ __('ui.driver_search') }}
                        </span>
                        <h1 class="max-w-3xl text-[1.75rem] font-black tracking-tight leading-[1.05] text-slate-900 sm:text-[2rem]">
                            {{ __('ui.find_rides_hero_title') }}
                        </h1>
                        <p class="mt-2.5 max-w-2xl text-[14px] leading-6 text-slate-500">
                            {{ __('ui.find_rides_hero_subtitle') }}
                        </p>

                        <div class="mt-5 grid gap-2.5 sm:grid-cols-2">
                            <div class="rounded-[20px] bg-slate-50 p-3.5">
                                <p class="text-[11px] font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ __('ui.rides_available') }}</p>
                                <p class="mt-1.5 text-[2rem] font-black text-slate-900">{{ $rides->count() }}</p>
                            </div>
                            <div class="rounded-[20px] bg-slate-50 p-3.5">
                                <p class="text-[11px] font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ __('ui.cities_covered') }}</p>
                                <p class="mt-1.5 text-[2rem] font-black text-slate-900">{{ collect($cities)->count() }}</p>
                            </div>
                        </div>

                        <div class="mt-5 flex flex-wrap gap-2.5">
                            <a class="inline-flex items-center gap-2 rounded-2xl brand-gradient px-4 py-2 text-sm font-bold text-white brand-shadow transition hover:scale-[1.01]" href="#search-panel">
                                <span class="material-symbols-outlined">search</span>
                                {{ __('ui.search') }}
                            </a>
                            <a class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 transition hover:border-rose-200 hover:text-rose-600" href="#ride-results">
                                <span class="material-symbols-outlined">view_carousel</span>
                                {{ __('ui.results') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-[30px] border border-white/80 bg-[#132238] p-4 text-white soft-shadow">
                    <div class="mb-3 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.22em] text-rose-200">{{ __('ui.tunisia_map') }}</p>
                            <h2 class="mt-1.5 text-base font-black">{{ __('ui.illustrated_route_view') }}</h2>
                        </div>
                        <div class="rounded-2xl bg-white/10 p-2.5">
                            <span class="material-symbols-outlined text-[20px] text-rose-200">map</span>
                        </div>
                    </div>
                    <div class="relative h-[220px] overflow-hidden rounded-[22px] border border-white/10 bg-[#0f1b2d]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_24%,rgba(255,255,255,0.08),transparent_30%),radial-gradient(circle_at_75%_28%,rgba(248,113,113,0.12),transparent_28%),linear-gradient(180deg,rgba(19,34,56,0.72),rgba(15,27,45,1))]"></div>

                        <div class="absolute left-4 top-2 h-[208px] w-[210px]">
                            <img
                                alt="Tunisia map"
                                class="h-full w-full object-contain drop-shadow-[0_16px_28px_rgba(2,6,23,0.35)]"
                                src="{{ asset('images/tunisia-map-clean.png') }}"
                            >
                            <svg aria-hidden="true" class="pointer-events-none absolute inset-0 h-full w-full" viewBox="0 0 210 208">
                                <path
                                    d="M100 40
                                       C106 54 110 69 115 86
                                       C119 101 126 118 132 138
                                       C136 154 141 170 146 188"
                                    fill="none"
                                    stroke="#f88b86"
                                    stroke-dasharray="7 8"
                                    stroke-linecap="round"
                                    stroke-width="4"
                                />
                                <circle cx="99" cy="40" r="6" fill="#f97363"/>
                                <circle cx="116" cy="89" r="6.5" fill="#f43f7d"/>
                                <circle cx="131" cy="132" r="6" fill="#7ccaf3"/>

                                <text x="54" y="30" fill="#f8fafc" font-size="9" font-weight="700">Bizerte</text>
                                <text x="122" y="79" fill="#f8fafc" font-size="9" font-weight="700">Tunis</text>
                                <text x="140" y="122" fill="#f8fafc" font-size="9" font-weight="700">Sousse</text>
                            </svg>
                        </div>

                        <div class="absolute right-4 top-5 rounded-[16px] bg-white px-4 py-3 text-slate-900 shadow-[0_16px_40px_rgba(2,6,23,0.18)]">
                            <p class="text-[13px] font-black leading-none">{{ __('ui.tunisia') }}</p>
                            <p class="mt-1 text-[11px] font-semibold text-slate-500">{{ __('ui.coastal_route_view') }}</p>
                        </div>

                        <div class="absolute bottom-5 right-4 max-w-[156px] rounded-[18px] bg-white px-4 py-3 text-slate-900 shadow-[0_18px_46px_rgba(2,6,23,0.2)]">
                            <p class="text-[13px] font-black">{{ __('ui.visual_route_cues') }}</p>
                            <div class="mt-2 space-y-1 text-[11px] font-semibold text-slate-500">
                                <p>Tunis -&gt; Sousse</p>
                                <p>Sousse -&gt; Sfax</p>
                                <p>{{ __('ui.searchable_cities_count') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-2 overflow-hidden rounded-[30px] border border-white/80 bg-white p-5 soft-shadow">
                    <p class="mb-3 text-[10px] font-extrabold uppercase tracking-[0.22em] text-rose-500">{{ __('ui.featured_routes') }}</p>
                    <div class="grid gap-2.5 md:grid-cols-3">
                        @forelse ($featuredRoutes as $featuredRoute)
                            <div class="rounded-[20px] border border-slate-100 bg-gradient-to-r from-slate-50 to-rose-50/70 p-3.5">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ __('ui.route') }}</p>
                                        <p class="mt-1.5 text-base font-black text-slate-900">{{ $featuredRoute->depart }} &rarr; {{ $featuredRoute->destination }}</p>
                                    </div>
                                    <a
                                        class="flex h-10 w-10 items-center justify-center rounded-2xl brand-gradient text-white transition hover:scale-[1.04]"
                                        href="{{ route('driver.find-rides', ['depart' => $featuredRoute->depart, 'destination' => $featuredRoute->destination]) }}#ride-results"
                                        aria-label="{{ __('ui.search_rides_from_to', ['from' => $featuredRoute->depart, 'to' => $featuredRoute->destination]) }}"
                                    >
                                        <span class="material-symbols-outlined text-[20px]">south_east</span>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 p-6 text-sm font-semibold text-slate-500 md:col-span-3">
                                Routes will appear here after matching rides are found.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 py-6 lg:px-8" id="search-panel">
        <div class="mx-auto max-w-screen-2xl rounded-[32px] border border-white/80 bg-white/90 p-5 soft-shadow lg:p-6">
            <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-[11px] font-extrabold uppercase tracking-[0.22em] text-rose-500">{{ __('ui.advanced_search') }}</p>
                    <h2 class="mt-2 text-2xl font-black text-slate-900">{{ __('ui.filter_rides') }}</h2>
                    <p class="mt-2 max-w-2xl text-slate-500">{{ __('ui.browse_or_type_city') }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm font-bold text-slate-500">
                    {{ $activeFilters }} {{ __('ui.active_filters') }}
                </div>
            </div>

            <form action="{{ route('driver.find-rides') }}" class="space-y-6" method="GET">
                <div class="grid gap-4 xl:grid-cols-[1.15fr_1.15fr_0.78fr_0.72fr]">
                    <div class="relative" data-city-select>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">{{ __('ui.departure') }}</label>
                        <div class="flex items-center gap-3 rounded-[22px] border border-slate-200 bg-slate-50 px-4 py-3.5 focus-within:border-rose-300 focus-within:bg-white">
                            <span class="material-symbols-outlined text-rose-500">trip_origin</span>
                            <input autocomplete="off" class="city-input w-full border-0 bg-transparent p-0 text-base font-bold text-slate-900 placeholder:text-slate-300 focus:ring-0" data-city-input name="depart" placeholder="{{ __('ui.choose_or_type_city') }}" type="text" value="{{ $filters['depart'] }}"/>
                            <button class="city-toggle text-slate-400 transition hover:text-slate-700" data-city-toggle tabindex="-1" type="button">
                                <span class="material-symbols-outlined">expand_more</span>
                            </button>
                        </div>
                        <div class="city-menu absolute left-0 right-0 top-full z-20 mt-2 hidden overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-2xl shadow-slate-900/10" data-city-menu>
                            <div class="max-h-72 overflow-y-auto py-2">
                                @foreach ($cities as $city)
                                    <button class="city-option flex w-full items-center justify-between px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-rose-50 hover:text-rose-600" data-city-option type="button" value="{{ $city }}">
                                        <span>{{ $city }}</span>
                                        <span class="material-symbols-outlined text-base">arrow_outward</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="relative" data-city-select>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">{{ __('ui.destination') }}</label>
                        <div class="flex items-center gap-3 rounded-[22px] border border-slate-200 bg-slate-50 px-4 py-3.5 focus-within:border-rose-300 focus-within:bg-white">
                            <span class="material-symbols-outlined text-rose-500">flag</span>
                            <input autocomplete="off" class="city-input w-full border-0 bg-transparent p-0 text-base font-bold text-slate-900 placeholder:text-slate-300 focus:ring-0" data-city-input name="destination" placeholder="{{ __('ui.choose_or_type_city') }}" type="text" value="{{ $filters['destination'] }}"/>
                            <button class="city-toggle text-slate-400 transition hover:text-slate-700" data-city-toggle tabindex="-1" type="button">
                                <span class="material-symbols-outlined">expand_more</span>
                            </button>
                        </div>
                        <div class="city-menu absolute left-0 right-0 top-full z-20 mt-2 hidden overflow-hidden rounded-[24px] border border-slate-200 bg-white shadow-2xl shadow-slate-900/10" data-city-menu>
                            <div class="max-h-72 overflow-y-auto py-2">
                                @foreach ($cities as $city)
                                    <button class="city-option flex w-full items-center justify-between px-4 py-3 text-left text-sm font-semibold text-slate-600 transition hover:bg-rose-50 hover:text-rose-600" data-city-option type="button" value="{{ $city }}">
                                        <span>{{ $city }}</span>
                                        <span class="material-symbols-outlined text-base">arrow_outward</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">Travel date</label>
                        <div class="flex items-center gap-3 rounded-[22px] border border-slate-200 bg-slate-50 px-4 py-3.5 focus-within:border-rose-300 focus-within:bg-white">
                            <input class="native-picker-input w-full border-0 bg-transparent p-0 text-base font-bold text-slate-900 focus:ring-0" data-picker-input name="date" type="date" value="{{ $filters['date'] }}"/>
                            <button aria-label="Open date picker" class="picker-trigger" data-picker-trigger type="button">
                                <span class="material-symbols-outlined text-rose-500">calendar_month</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button class="flex w-full items-center justify-center gap-2 rounded-[22px] brand-gradient px-5 py-3.5 text-base font-bold text-white brand-shadow transition hover:scale-[1.01]" type="submit">
                            <span class="material-symbols-outlined">search</span>
                            {{ __('ui.search') }}
                        </button>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">Minimum seats</label>
                        <div class="flex items-center gap-3 rounded-[22px] border border-slate-200 bg-slate-50 px-4 py-3.5 focus-within:border-rose-300 focus-within:bg-white">
                            <span class="material-symbols-outlined text-rose-500">airline_seat_recline_normal</span>
                            <input class="w-full border-0 bg-transparent p-0 text-base font-bold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="seat-filter-input" max="{{ $selectedSeatLimit }}" min="1" name="seats" placeholder="1" type="number" value="{{ $filters['seats'] }}"/>
                        </div>
                        <p class="mt-2 text-xs font-semibold text-slate-400" id="seat-filter-hint">
                            {{ $filters['vehicle_type'] !== '' ? 'Max for '.$vehicleTypes[$filters['vehicle_type']].': '.$selectedSeatLimit.' seats' : 'Up to '.$globalSeatLimit.' seats across all vehicle types' }}
                        </p>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">Max price (TND)</label>
                        <div class="flex items-center gap-3 rounded-[22px] border border-slate-200 bg-slate-50 px-4 py-3.5 focus-within:border-rose-300 focus-within:bg-white">
                            <span class="material-symbols-outlined text-rose-500">payments</span>
                            <input class="w-full border-0 bg-transparent p-0 text-base font-bold text-slate-900 placeholder:text-slate-300 focus:ring-0" min="0" name="price_max" placeholder="40" step="0.01" type="number" value="{{ $filters['price_max'] }}"/>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">Departure after</label>
                        <div class="flex items-center gap-3 rounded-[22px] border border-slate-200 bg-slate-50 px-4 py-3.5 focus-within:border-rose-300 focus-within:bg-white">
                            <input class="native-picker-input w-full border-0 bg-transparent p-0 text-base font-bold text-slate-900 focus:ring-0" data-picker-input name="time_from" type="time" value="{{ $filters['time_from'] }}"/>
                            <button aria-label="Open time picker" class="picker-trigger" data-picker-trigger type="button">
                                <span class="material-symbols-outlined text-rose-500">schedule</span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">{{ __('ui.sort_by') }}</label>
                        <div class="flex items-center gap-3 rounded-[22px] border border-slate-200 bg-slate-50 px-4 py-3.5 focus-within:border-rose-300 focus-within:bg-white">
                            <span class="material-symbols-outlined text-rose-500">sort</span>
                            <select class="w-full border-0 bg-transparent p-0 text-base font-bold text-slate-900 focus:ring-0" name="sort">
                                <option value="soonest" @selected($filters['sort'] === 'soonest')>Soonest departure</option>
                                <option value="price_low" @selected($filters['sort'] === 'price_low')>Lowest price</option>
                                <option value="price_high" @selected($filters['sort'] === 'price_high')>Highest price</option>
                                <option value="seats" @selected($filters['sort'] === 'seats')>Most seats left</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">Vehicle type</label>
                        <div class="flex items-center gap-3 rounded-[22px] border border-slate-200 bg-slate-50 px-4 py-3.5 focus-within:border-rose-300 focus-within:bg-white">
                            <span class="material-symbols-outlined text-rose-500">directions_car</span>
                            <select class="w-full border-0 bg-transparent p-0 text-base font-bold text-slate-900 focus:ring-0" id="vehicle-type-filter" name="vehicle_type">
                                <option value="">All vehicle types</option>
                                @foreach ($vehicleTypes as $vehicleTypeValue => $vehicleTypeLabel)
                                    <option value="{{ $vehicleTypeValue }}" @selected($filters['vehicle_type'] === $vehicleTypeValue)>{{ $vehicleTypeLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-3 block text-xs font-extrabold uppercase tracking-[0.2em] text-slate-400">Ride preferences</label>
                    <div class="flex flex-wrap gap-3">
                        <div>
                            <input @checked($filters['ac_included']) class="filter-chip-input" id="filter-ac-included" name="ac_included" type="checkbox" value="1">
                            <label class="filter-chip" for="filter-ac-included">
                                <span class="material-symbols-outlined text-[18px]">ac_unit</span>
                                AC Included
                            </label>
                        </div>
                        <div>
                            <input @checked($filters['pets_allowed']) class="filter-chip-input" id="filter-pets-allowed" name="pets_allowed" type="checkbox" value="1">
                            <label class="filter-chip" for="filter-pets-allowed">
                                <span class="material-symbols-outlined text-[18px]">pets</span>
                                Pet Friendly
                            </label>
                        </div>
                        <div>
                            <input @checked($filters['smoking_allowed']) class="filter-chip-input" id="filter-smoking-allowed" name="smoking_allowed" type="checkbox" value="1">
                            <label class="filter-chip" for="filter-smoking-allowed">
                                <span class="material-symbols-outlined text-[18px]">smoking_rooms</span>
                                Smoking allowed
                            </label>
                        </div>
                        <div>
                            <input @checked($filters['baggage_allowed']) class="filter-chip-input" id="filter-baggage-allowed" name="baggage_allowed" type="checkbox" value="1">
                            <label class="filter-chip" for="filter-baggage-allowed">
                                <span class="material-symbols-outlined text-[18px]">luggage</span>
                                Baggage allowed
                            </label>
                        </div>
                        <div>
                            <input @checked($filters['food_drinks_allowed']) class="filter-chip-input" id="filter-food-drinks-allowed" name="food_drinks_allowed" type="checkbox" value="1">
                            <label class="filter-chip" for="filter-food-drinks-allowed">
                                <span class="material-symbols-outlined text-[18px]">restaurant</span>
                                Food and drinks
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <a class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-bold text-slate-500 transition hover:border-rose-200 hover:text-rose-600" href="{{ route('driver.find-rides') }}">
                        <span class="material-symbols-outlined text-base">restart_alt</span>
                        Clear filters
                    </a>
                    <span class="rounded-full bg-rose-50 px-4 py-2 text-sm font-bold text-rose-600">Cities list: 24 Tunisian cities</span>
                </div>
            </form>
        </div>
    </section>

    <section class="px-6 py-8 lg:px-8" id="ride-results">
        <div class="mx-auto max-w-screen-2xl">
            <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="text-[11px] font-extrabold uppercase tracking-[0.22em] text-rose-500">Ride results</p>
                    <h2 class="mt-2 text-2xl font-black text-slate-900">Ride results</h2>
                    <p class="mt-2 max-w-2xl text-slate-500">Compact cards with the main trip details.</p>
                </div>
                <div class="rounded-2xl bg-white px-4 py-3 text-sm font-bold text-slate-500 soft-shadow">
                    {{ $rides->count() }} ride{{ $rides->count() === 1 ? '' : 's' }} found
                </div>
            </div>

            @if ($rides->isEmpty())
                <div class="rounded-[36px] border border-white/80 bg-white p-12 text-center soft-shadow">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-rose-50 text-rose-500">
                        <span class="material-symbols-outlined text-4xl">travel_explore</span>
                    </div>
                    <h3 class="mt-6 text-3xl font-black text-slate-900">No rides match these filters</h3>
                    <p class="mx-auto mt-3 max-w-xl text-slate-500">{{ __('ui.try_other_filters_hint') }}</p>
                </div>
            @else
                <div class="overflow-hidden rounded-[32px] border border-white/80 bg-white p-4 soft-shadow lg:p-5" data-carousel>
                    <div class="overflow-hidden">
                        <div class="flex transition-transform duration-500 ease-out" data-carousel-track>
                            @foreach ($ridePages as $pageIndex => $page)
                                <div class="min-w-full">
                                    <div class="grid gap-3 xl:grid-cols-3 items-start">
                                        @foreach ($page as $ride)
                                            <article class="ride-result-card flex h-full flex-col overflow-hidden rounded-[22px] border border-slate-100 bg-gradient-to-b from-white to-slate-50/60 p-3">
                                                <div class="mb-2.5 flex items-start justify-between gap-3">
                                                    <div>
                                                        <div class="mb-2 flex items-center gap-2">
                                                            <span class="rounded-full bg-rose-50 px-3 py-1 text-[10px] font-extrabold uppercase tracking-[0.18em] text-rose-600">Route {{ $pageIndex + 1 }}</span>
                                                            <span class="text-xs font-bold text-slate-400">RW-{{ $ride->id }}</span>
                                                        </div>
                                                        <h3 class="text-[1.05rem] font-black leading-tight text-slate-900">{{ $ride->depart }} <span class="text-rose-500">&rarr;</span> {{ $ride->destination }}</h3>
                                                    </div>
                                                    <div class="rounded-[16px] bg-slate-900 px-3 py-1.5 text-right text-white">
                                                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-white/60">{{ __('ui.price') }}</p>
                                                        <p class="mt-1 text-base font-black">{{ number_format($ride->prix, 2) }}</p>
                                                        <p class="text-xs font-semibold text-white/70">{{ __('ui.tnd_per_seat') }}</p>
                                                    </div>
                                                </div>

                                                <div class="mb-3 rounded-[18px] bg-[#132238] p-2.5 text-white">
                                                    <div class="flex items-center justify-between gap-3">
                                                        <div>
                                                            <p class="text-[10px] font-extrabold uppercase tracking-[0.2em] text-rose-200">{{ __('ui.route') }}</p>
                                                            <p class="mt-1 text-sm font-bold">{{ $ride->date->format('d M Y') }} {{ __('ui.at') }} {{ substr((string) $ride->heure, 0, 5) }}</p>
                                                        </div>
                                                        <svg aria-hidden="true" class="h-10 w-20" viewBox="0 0 96 48">
                                                            <path d="M8 35 C25 10, 38 12, 52 26 C62 36, 73 38, 88 14" fill="none" stroke="#f7b48e" stroke-dasharray="5 6" stroke-linecap="round" stroke-width="4"/>
                                                            <circle cx="10" cy="35" fill="#f26d5d" r="5"/>
                                                            <circle cx="89" cy="14" fill="#f82e6e" r="5"/>
                                                        </svg>
                                                    </div>
                                                </div>

                                                <div class="grid gap-2 sm:grid-cols-2">
                                                    <div class="rounded-[16px] bg-slate-50 p-2.5">
                                                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ __('ui.driver') }}</p>
                                                        <p class="mt-1 text-sm font-bold text-slate-900">{{ $ride->conducteur->name ?? __('ui.unknown_driver') }}</p>
                                                    </div>
                                                    <div class="rounded-[16px] bg-slate-50 p-2.5">
                                                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ __('ui.seats_left') }}</p>
                                                        <p class="mt-1 text-sm font-bold text-slate-900">{{ $ride->available_seats }}</p>
                                                    </div>
                                                    <div class="rounded-[16px] bg-slate-50 p-2.5">
                                                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ __('ui.departure') }}</p>
                                                        <p class="mt-1 text-sm font-bold text-slate-900">{{ $ride->depart }}</p>
                                                    </div>
                                                    <div class="rounded-[16px] bg-slate-50 p-2.5">
                                                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ __('ui.destination') }}</p>
                                                        <p class="mt-1 text-sm font-bold text-slate-900">{{ $ride->destination }}</p>
                                                    </div>
                                                    <div class="rounded-[16px] bg-slate-50 p-2.5 sm:col-span-2">
                                                        <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ __('ui.vehicle') }}</p>
                                                        <p class="mt-1 text-sm font-bold text-slate-900">
                                                            @if ($ride->vehicule)
                                                                {{ trim(($ride->vehicule->marque ?? '').' '.($ride->vehicule->modele ?? '')) }}
                                                                @if (!empty($ride->vehicule->immatriculation))
                                                                    - {{ $ride->vehicule->immatriculation }}
                                                                @endif
                                                            @else
                                                                {{ $vehicleTypes[$ride->vehicule?->type] ?? __('ui.not_specified') }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="mt-2.5 flex flex-wrap gap-2">
                                                    @if ($ride->ac_included)
                                                        <span class="filter-chip !cursor-default !border-rose-100 !bg-rose-50/70 !text-rose-600">
                                                            <span class="material-symbols-outlined text-[18px]">ac_unit</span>
                                                            AC
                                                        </span>
                                                    @endif
                                                    @if ($ride->pets_allowed)
                                                        <span class="filter-chip !cursor-default">
                                                            <span class="material-symbols-outlined text-[18px]">pets</span>
                                                            {{ __('ui.pets') }}
                                                        </span>
                                                    @endif
                                                    @if ($ride->smoking_allowed)
                                                        <span class="filter-chip !cursor-default">
                                                            <span class="material-symbols-outlined text-[18px]">smoking_rooms</span>
                                                            {{ __('ui.smoking') }}
                                                        </span>
                                                    @endif
                                                    @if ($ride->baggage_allowed)
                                                        <span class="filter-chip !cursor-default">
                                                            <span class="material-symbols-outlined text-[18px]">luggage</span>
                                                            {{ __('ui.baggage') }}
                                                        </span>
                                                    @endif
                                                    @if ($ride->food_drinks_allowed)
                                                        <span class="filter-chip !cursor-default">
                                                            <span class="material-symbols-outlined text-[18px]">restaurant</span>
                                                            {{ __('ui.food_drinks') }}
                                                        </span>
                                                    @endif
                                                    @if (! $ride->ac_included && ! $ride->pets_allowed && ! $ride->smoking_allowed && ! $ride->baggage_allowed && ! $ride->food_drinks_allowed)
                                                        <div class="flex items-center gap-2 rounded-[15px] bg-rose-50 px-3 py-1.5 text-[12px] font-semibold text-rose-700">
                                                            <span class="material-symbols-outlined text-base">lightbulb</span>
                                                            {{ __('ui.standard_ride_setup') }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="mt-2.5 flex flex-1 flex-col justify-end gap-2 border-t border-slate-100 pt-2.5">
                                                    <form action="{{ route('driver.bookings.store', $ride) }}" class="grid gap-2 sm:grid-cols-[72px_1fr]" method="POST">
                                                        @csrf
                                                        <input class="rounded-[13px] border border-slate-200 bg-white px-3 py-2 text-center text-sm font-bold text-slate-900 focus:border-rose-300 focus:ring-rose-200" max="{{ max(1, $ride->available_seats) }}" min="1" name="nb_places" type="number" value="1" @disabled($ride->available_seats === 0)>
                                                        <button class="inline-flex items-center justify-center gap-2 rounded-[13px] brand-gradient px-4 py-2 text-sm font-bold text-white transition hover:scale-[1.01] disabled:cursor-not-allowed disabled:opacity-50" type="submit" @disabled($ride->available_seats === 0)>
                                                            <span class="material-symbols-outlined text-base">directions_car</span>
                                                            {{ $ride->available_seats === 0 ? __('ui.ride_full') : __('ui.request_this_ride') }}
                                                        </button>
                                                    </form>

                                                    <div class="grid gap-2 sm:grid-cols-[1fr_auto]">
                                                        <a class="inline-flex items-center justify-center gap-2 rounded-[13px] border border-slate-200 px-4 py-2 text-sm font-bold text-slate-600 transition hover:border-rose-200 hover:text-rose-600" href="{{ route('driver.offer-ride.create') }}">
                                                            <span class="material-symbols-outlined text-base">add_road</span>
                                                            {{ __('ui.offer_similar_ride') }}
                                                        </a>
                                                        <button
                                                            class="inline-flex items-center justify-center gap-2 rounded-[13px] bg-gradient-to-r from-[#f26d5d] to-[#f82e6e] px-4 py-2 text-sm font-bold text-white transition hover:scale-[1.01]"
                                                            data-comments-toggle
                                                            type="button"
                                                        >
                                                            <span class="material-symbols-outlined text-base">chat</span>
                                                            {{ __('ui.comment') }}
                                                        </button>
                                                    </div>
                                                </div>

                                                @include('partials.ride-comments', ['ride' => $ride, 'collapsible' => true, 'openByDefault' => false])
                                            </article>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div class="flex items-center gap-2" data-carousel-dots>
                            @foreach ($ridePages as $pageIndex => $page)
                                <button aria-label="Go to page {{ $pageIndex + 1 }}" class="{{ $pageIndex === 0 ? 'w-10 bg-slate-900' : 'w-3 bg-slate-200' }} h-3 rounded-full transition-all" data-carousel-dot type="button"></button>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-bold text-slate-600 transition hover:border-slate-300 disabled:cursor-not-allowed disabled:opacity-40" data-carousel-prev type="button">
                                <span class="material-symbols-outlined text-base">west</span>
                                {{ __('ui.previous') }}
                            </button>
                            <button class="inline-flex items-center gap-2 rounded-full brand-gradient px-4 py-2 text-sm font-bold text-white transition disabled:cursor-not-allowed disabled:opacity-40" data-carousel-next type="button">
                                {{ __('ui.next') }}
                                <span class="material-symbols-outlined text-base">east</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</main>

<footer class="mt-12 border-t border-white/80 bg-white/80 px-6 py-10 backdrop-blur-sm lg:px-8">
    <div class="mx-auto flex max-w-screen-2xl flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xl font-black text-slate-900">RideWave</p>
            <p class="mt-2 text-sm font-semibold text-slate-500">{{ __('ui.find_rides_footer_subtitle') }}</p>
        </div>
        <div class="flex flex-wrap items-center gap-6 text-sm font-semibold text-slate-500">
            <a class="transition hover:text-rose-600" href="#">{{ __('ui.safety') }}</a>
            <a class="transition hover:text-rose-600" href="#">{{ __('ui.support') }}</a>
            <a class="transition hover:text-rose-600" href="#">{{ __('ui.terms') }}</a>
            <a class="transition hover:text-rose-600" href="#">{{ __('ui.privacy') }}</a>
        </div>
    </div>
</footer>

<script>
    const seatFilterInput = document.getElementById('seat-filter-input');
    const vehicleTypeFilter = document.getElementById('vehicle-type-filter');
    const seatFilterHint = document.getElementById('seat-filter-hint');
    const seatLimits = @json($seatLimits);
    const vehicleTypeLabels = @json($vehicleTypes);
    const globalSeatLimit = {{ $globalSeatLimit }};
    const seatLimitTemplate = @json(__('ui.max_for_type_seats_js'));
    const seatGlobalTemplate = @json(__('ui.up_to_seats_all_types_js'));

    function currentSeatFilterLimit() {
        const selectedVehicleType = vehicleTypeFilter?.value ?? '';

        return seatLimits[selectedVehicleType] ?? globalSeatLimit;
    }

    function normalizeSeatFilterValue() {
        if (!seatFilterInput) {
            return;
        }

        const rawValue = seatFilterInput.value.trim();

        if (rawValue === '') {
            return;
        }

        const parsedValue = Number.parseInt(rawValue, 10);

        if (Number.isNaN(parsedValue)) {
            seatFilterInput.value = '';

            return;
        }

        seatFilterInput.value = String(Math.min(currentSeatFilterLimit(), Math.max(1, parsedValue)));
    }

    function updateSeatFilterLimit() {
        if (!seatFilterInput || !seatFilterHint) {
            return;
        }

        const selectedVehicleType = vehicleTypeFilter?.value ?? '';
        const limit = currentSeatFilterLimit();

        seatFilterInput.max = String(limit);
        normalizeSeatFilterValue();
        seatFilterHint.textContent = selectedVehicleType
            ? seatLimitTemplate
                .replace(':type', vehicleTypeLabels[selectedVehicleType] ?? '')
                .replace(':limit', String(limit))
            : seatGlobalTemplate.replace(':limit', String(globalSeatLimit));
    }

    if (seatFilterInput) {
        seatFilterInput.addEventListener('input', normalizeSeatFilterValue);
    }

    if (vehicleTypeFilter) {
        vehicleTypeFilter.addEventListener('change', updateSeatFilterLimit);
    }

    updateSeatFilterLimit();

    document.querySelectorAll('[data-city-select]').forEach((selectRoot) => {
        const input = selectRoot.querySelector('[data-city-input]');
        const menu = selectRoot.querySelector('[data-city-menu]');
        const toggle = selectRoot.querySelector('[data-city-toggle]');
        const options = Array.from(selectRoot.querySelectorAll('[data-city-option]'));

        const filterOptions = () => {
            const term = input.value.trim().toLowerCase();
            let visibleCount = 0;

            options.forEach((option) => {
                const match = option.value.toLowerCase().includes(term);
                option.hidden = !match;
                if (match) {
                    visibleCount += 1;
                }
            });

            menu.classList.toggle('hidden', visibleCount === 0);
        };

        const openMenu = () => {
            menu.classList.remove('hidden');
            filterOptions();
        };

        const closeMenu = () => {
            menu.classList.add('hidden');
        };

        input.addEventListener('focus', openMenu);
        input.addEventListener('input', openMenu);
        toggle.addEventListener('click', () => {
            if (menu.classList.contains('hidden')) {
                openMenu();
                input.focus();
            } else {
                closeMenu();
            }
        });

        options.forEach((option) => {
            option.addEventListener('click', () => {
                input.value = option.value;
                closeMenu();
                input.dispatchEvent(new Event('input', { bubbles: true }));
            });
        });

        document.addEventListener('click', (event) => {
            if (!selectRoot.contains(event.target)) {
                closeMenu();
            }
        });
    });

    document.querySelectorAll('[data-picker-trigger]').forEach((button) => {
        const container = button.closest('div');
        const input = container?.querySelector('[data-picker-input]');

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

    document.querySelectorAll('[data-carousel]').forEach((carousel) => {
        const track = carousel.querySelector('[data-carousel-track]');
        const pages = Array.from(track.children);
        const prevButton = carousel.querySelector('[data-carousel-prev]');
        const nextButton = carousel.querySelector('[data-carousel-next]');
        const dots = Array.from(carousel.querySelectorAll('[data-carousel-dot]'));
        let index = 0;

        const updateCarousel = () => {
            track.style.transform = `translateX(-${index * 100}%)`;
            prevButton.disabled = index === 0;
            nextButton.disabled = index === pages.length - 1;

            dots.forEach((dot, dotIndex) => {
                dot.classList.toggle('w-10', dotIndex === index);
                dot.classList.toggle('bg-slate-900', dotIndex === index);
                dot.classList.toggle('w-3', dotIndex !== index);
                dot.classList.toggle('bg-slate-200', dotIndex !== index);
            });
        };

        prevButton.addEventListener('click', () => {
            index = Math.max(0, index - 1);
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            index = Math.min(pages.length - 1, index + 1);
            updateCarousel();
        });

        dots.forEach((dot, dotIndex) => {
            dot.addEventListener('click', () => {
                index = dotIndex;
                updateCarousel();
            });
        });

        updateCarousel();
    });

    document.querySelectorAll('[data-comments-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const card = button.closest('article');
            const panel = card?.querySelector('[data-comments-panel]');

            if (!panel) {
                return;
            }

            panel.classList.toggle('hidden');
        });
    });
</script>
@include('partials.theme-toggle-script')
</body>
</html>






