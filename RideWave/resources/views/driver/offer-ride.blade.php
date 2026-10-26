﻿<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Post a Ride | RideWave</title>
    <meta content="#ffffff" name="theme-color"/>
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
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f8f2fa",
                        "on-background": "#1d1b20",
                        "on-surface-variant": "#5c5e63",
                        "primary-fixed": "#e9ddff",
                        "primary": "#4f378a"
                    },
                    fontFamily: {
                        sans: ["Plus Jakarta Sans", "sans-serif"],
                        "label-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-sm": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-sm": ["24px", {"lineHeight": "1.3", "fontWeight": "700"}],
                        "headline-md": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background:
                radial-gradient(circle at top left, rgba(242, 109, 93, 0.14), transparent 22%),
                radial-gradient(circle at 88% 10%, rgba(248, 46, 110, 0.1), transparent 18%),
                linear-gradient(180deg, #fff8f4 0%, #fffdfc 42%, #fff7f3 100%);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .offer-hero-panel {
            position: relative;
            border: 1px solid rgba(255, 232, 225, 0.9);
            background:
                radial-gradient(circle at 63% 24%, rgba(255, 212, 130, 0.36), transparent 18%),
                radial-gradient(circle at 88% 8%, rgba(248, 46, 110, 0.08), transparent 20%),
                linear-gradient(120deg, rgba(255, 252, 250, 1) 0%, rgba(255, 248, 245, 0.98) 46%, rgba(255, 239, 231, 0.84) 75%, rgba(255, 232, 221, 0.72) 100%);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.07);
        }

        .offer-hero-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 14% 12%, rgba(255, 255, 255, 0.96), transparent 28%),
                radial-gradient(circle at 54% 86%, rgba(255, 255, 255, 0.74), transparent 24%);
            pointer-events: none;
        }

        .offer-hero-copy {
            position: relative;
            z-index: 3;
        }

        .offer-hero-pill-grid {
            display: grid;
            gap: 1rem;
            max-width: 420px;
        }

        .offer-hero-feature-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            border: 1px solid rgba(226, 232, 240, 0.95);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.96);
            padding: 0.8rem 1.15rem;
            font-size: 0.88rem;
            font-weight: 800;
            color: #475569;
        }

        .offer-hero-layout {
            position: relative;
            display: grid;
            gap: 1.25rem;
            align-items: stretch;
        }

        .offer-hero-visual {
            position: relative;
            overflow: hidden;
            min-height: 260px;
            background: #e5e7eb;
            border-radius: 26px;
        }

        .hero-visual-media {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
            display: block;
        }

        .offer-hero-visual::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(255, 250, 247, 1) 0%, rgba(255, 250, 247, 0.98) 12%, rgba(255, 250, 247, 0.84) 23%, rgba(255, 250, 247, 0.5) 34%, rgba(255, 250, 247, 0.12) 45%, rgba(255, 250, 247, 0) 56%),
                radial-gradient(circle at 18% 24%, rgba(255, 214, 128, 0.56), transparent 20%);
            z-index: 1;
            pointer-events: none;
        }

        .offer-hero-visual::after {
            content: "";
            position: absolute;
            inset: auto auto -16% -20%;
            width: 64%;
            height: 58%;
            background:
                radial-gradient(circle at 46% 44%, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.94) 20%, rgba(255, 255, 255, 0.68) 36%, rgba(255, 255, 255, 0.24) 56%, rgba(255, 255, 255, 0) 76%);
            z-index: 2;
            pointer-events: none;
            filter: blur(10px);
        }

        @media (min-width: 1024px) {
            .offer-hero-layout {
                grid-template-columns: minmax(0, 1fr) minmax(0, 1.35fr);
                min-height: 336px;
            }

            .offer-hero-copy {
                max-width: none;
                padding: 0.55rem 0 0.55rem 0.35rem;
            }

            .offer-hero-pill-grid {
                grid-template-columns: repeat(2, minmax(0, max-content));
            }

            .offer-hero-visual {
                position: relative;
                min-height: 100%;
                border-radius: 22px;
            }
        }

        .metric-card {
            border: 1px solid rgba(226, 232, 240, 0.8);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
            backdrop-filter: blur(10px);
        }

        .section-shell {
            border: 1px solid rgba(226, 232, 240, 0.85);
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.05);
        }

        .amenity-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .amenity-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.55rem 0.85rem;
            border-radius: 999px;
            border: 1px solid #e2e8f0;
            background: rgba(255, 255, 255, 0.94);
            color: #475569;
            font-weight: 700;
            font-size: 0.84rem;
            cursor: pointer;
            transition: all 0.18s ease;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.03);
        }

        .amenity-input:checked + .amenity-pill {
            background: linear-gradient(135deg, rgba(242, 109, 93, 0.12), rgba(248, 46, 110, 0.08));
            border-color: rgba(248, 46, 110, 0.22);
            color: #ce2a63;
            box-shadow: 0 8px 18px rgba(248, 46, 110, 0.08);
        }

        .field-shell {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            min-height: 56px;
            border-radius: 0.95rem;
            border: 1px solid #e2e8f0;
            background: rgba(255, 255, 255, 0.98);
            padding: 0.75rem 0.9rem;
            transition: background-color 0.18s ease, border-color 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.86);
        }

        .field-shell > * {
            min-width: 0;
        }

        .field-shell:focus-within {
            background: #ffffff;
            border-color: rgba(248, 46, 110, 0.2);
            box-shadow: 0 0 0 4px rgba(248, 46, 110, 0.08);
            transform: translateY(-1px);
        }

        .city-option[hidden] {
            display: none;
        }

        .picker-shell {
            overflow: hidden;
        }

        .picker-display {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            pointer-events: none;
        }

        .native-picker-input {
            position: absolute;
            inset: 0;
            z-index: 2;
            width: 100%;
            height: 100%;
            appearance: none;
            -webkit-appearance: none;
            border: 0;
            background: transparent;
            opacity: 0;
            cursor: pointer;
        }

        .native-picker-input::-webkit-calendar-picker-indicator {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            opacity: 0;
            cursor: pointer;
        }

        .native-picker-input::-webkit-datetime-edit,
        .native-picker-input::-webkit-date-and-time-value {
            opacity: 0;
        }

        .picker-trigger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            color: #94a3b8;
            flex-shrink: 0;
        }

        .picker-value {
            display: block;
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f172a;
        }

        .picker-value.is-empty {
            color: #94a3b8;
            font-weight: 600;
        }

        html.dark body.driver-offer-ride-page {
            background:
                radial-gradient(circle at top left, rgba(244, 63, 94, 0.1), transparent 24%),
                radial-gradient(circle at 88% 10%, rgba(15, 23, 42, 0.78), transparent 20%),
                linear-gradient(180deg, #08111f 0%, #0b1220 42%, #08111f 100%);
        }

        html.dark .driver-offer-ride-page .offer-hero-panel {
            border-color: rgba(148, 163, 184, 0.2);
            background:
                radial-gradient(circle at 63% 24%, rgba(244, 63, 94, 0.1), transparent 20%),
                radial-gradient(circle at 88% 8%, rgba(148, 163, 184, 0.06), transparent 22%),
                linear-gradient(120deg, rgba(15, 23, 42, 0.92) 0%, rgba(15, 23, 42, 0.9) 46%, rgba(2, 6, 23, 0.9) 100%);
            box-shadow: 0 24px 56px rgba(2, 6, 23, 0.5);
        }

        html.dark .driver-offer-ride-page .offer-hero-visual::before {
            background:
                linear-gradient(90deg, rgba(8, 17, 31, 0.72) 0%, rgba(8, 17, 31, 0.54) 12%, rgba(8, 17, 31, 0.34) 24%, rgba(8, 17, 31, 0.2) 36%, rgba(8, 17, 31, 0.08) 46%, rgba(8, 17, 31, 0) 58%),
                radial-gradient(circle at 18% 24%, rgba(244, 63, 94, 0.16), transparent 22%);
        }

        html.dark .driver-offer-ride-page .offer-hero-visual::after {
            background:
                radial-gradient(circle at 46% 44%, rgba(8, 17, 31, 0.5) 0%, rgba(8, 17, 31, 0.42) 22%, rgba(8, 17, 31, 0.24) 40%, rgba(8, 17, 31, 0.12) 58%, rgba(8, 17, 31, 0) 76%);
        }

        html.dark .driver-offer-ride-page .offer-hero-feature-pill {
            border-color: rgba(148, 163, 184, 0.24);
            background: rgba(15, 23, 42, 0.86);
            color: #cbd5e1;
        }

        html.dark .driver-offer-ride-page .metric-card,
        html.dark .driver-offer-ride-page .section-shell {
            border-color: rgba(148, 163, 184, 0.2);
            background: rgba(15, 23, 42, 0.88);
            box-shadow: 0 22px 52px rgba(2, 6, 23, 0.5);
        }

        html.dark .driver-offer-ride-page .amenity-pill {
            border-color: rgba(148, 163, 184, 0.22);
            background: rgba(15, 23, 42, 0.86);
            color: #cbd5e1;
            box-shadow: none;
        }

        html.dark .driver-offer-ride-page .amenity-input:checked + .amenity-pill {
            background: rgba(244, 63, 94, 0.16);
            border-color: rgba(244, 63, 94, 0.36);
            color: #fecdd3;
        }

        html.dark .driver-offer-ride-page .field-shell {
            border-color: rgba(148, 163, 184, 0.22);
            background: #0b1220;
            box-shadow: none;
        }

        html.dark .driver-offer-ride-page .field-shell:focus-within {
            background: #111827;
            border-color: rgba(244, 63, 94, 0.35);
            box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.14);
        }

        html.dark .driver-offer-ride-page .picker-value:not(.is-empty) {
            color: #f8fafc;
        }

    </style>
    @include('partials.ridewave-theme')
    <style>
        .driver-offer-ride-page .hero-visual-media {
            opacity: 1 !important;
            filter: none !important;
            mask-image: none !important;
            -webkit-mask-image: none !important;
            transform: none !important;
        }
    </style>
</head>
<body class="driver-offer-ride-page min-h-screen font-body-md text-on-background">
@php
    $defaultSeats = (int) old('nb_places', 3);
    $defaultPrice = (float) old('prix', 0);
    $defaultBase = $defaultSeats * $defaultPrice;
    $defaultDate = old('date');
    $defaultTime = old('heure');
    $defaultDateLabel = filled($defaultDate) ? \Illuminate\Support\Carbon::parse($defaultDate)->format('d/m/Y') : 'dd/mm/yyyy';
    $defaultTimeLabel = filled($defaultTime) ? substr((string) $defaultTime, 0, 5) : '--:--';
@endphp

@include('driver.partials.navbar', ['active' => 'offer-ride'])

<main class="mx-auto max-w-screen-2xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
    @if ($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700">{{ $errors->first() }}</div>
    @endif

    @if ($vehicles->isEmpty())
        <div class="mb-6 rounded-2xl border border-amber-100 bg-amber-50 px-5 py-4 text-sm font-semibold text-amber-700">
            Add a vehicle in your fleet before publishing a ride.
            <a class="ml-2 underline" href="{{ route('driver.fleet') }}">Open fleet</a>
        </div>
    @endif

    <div class="grid gap-5 xl:grid-cols-[minmax(0,1.8fr)_410px]">
        <div class="space-y-6">
            <section class="offer-hero-panel overflow-hidden rounded-[32px] p-5 sm:p-6">
                <div class="offer-hero-layout">
                    <div class="offer-hero-copy px-1 sm:px-2">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-rose-100 bg-white px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-[0.22em] text-rose-500 shadow-sm">
                                <span class="material-symbols-outlined text-[14px]">add_road</span>
                                Post a ride
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-900 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.16em] text-white">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                Driver mode
                            </span>
                        </div>

                        <h1 class="mt-5 max-w-[25rem] text-[1.85rem] font-black leading-[0.98] tracking-tight text-slate-900 sm:text-[2.35rem]">
                            <span class="block">Publish a ride</span>
                            <span class="block">
                                <span class="bg-gradient-to-r from-[#F26D5D] to-[#F82E6E] bg-clip-text text-transparent">cleaner</span>
                                and more
                            </span>
                            <span class="block">elegant.</span>
                        </h1>

                        <p class="mt-4 max-w-[28rem] text-[0.96rem] font-medium leading-7 text-slate-600 sm:text-[1rem]">
                            Define the route, date, price, and preferences in one simple, readable flow.
                        </p>

                        <div class="offer-hero-pill-grid mt-6">
                            <span class="offer-hero-feature-pill">
                                <span class="material-symbols-outlined text-[16px] text-rose-500">route</span>
                                Simple route
                            </span>
                            <span class="offer-hero-feature-pill">
                                <span class="material-symbols-outlined text-[16px] text-rose-500">event_seat</span>
                                Clear seats
                            </span>
                            <span class="offer-hero-feature-pill">
                                <span class="material-symbols-outlined text-[16px] text-rose-500">payments</span>
                                Visible pricing
                            </span>
                        </div>
                    </div>

                    <div class="offer-hero-visual mt-6 lg:mt-0">
                        <img
                            alt="Scenic mountain road with a car"
                            class="hero-visual-media"
                            decoding="sync"
                            loading="eager"
                            src="{{ url('images/scenic-drive-winding-mountain-road-with-car.jpg') }}"
                        >
                    </div>
                </div>
            </section>

            <form action="{{ route('driver.offer-ride.store') }}" method="POST">
                @csrf

                <div class="section-shell overflow-hidden rounded-[30px]">
                    <section class="p-5 sm:p-7">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-500 shadow-sm">
                                <span class="material-symbols-outlined text-[22px]">directions_car</span>
                            </div>
                            <div>
                                <h2 class="text-[1.15rem] font-black text-slate-900 sm:text-[1.35rem]">1. Trip setup</h2>
                                <p class="mt-1 text-sm font-medium text-slate-500">Choose the vehicle, schedule, price, and number of seats.</p>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 md:grid-cols-3">
                            <div>
                                <label class="mb-2 block text-[12px] font-extrabold uppercase tracking-[0.18em] text-slate-400"><span class="text-rose-500">*</span> Vehicle</label>
                                <div class="field-shell">
                                    <span class="material-symbols-outlined text-slate-400 flex-shrink-0">directions_car</span>
                                    <select class="w-full border-0 bg-transparent p-0 text-sm font-bold text-slate-900 focus:ring-0" id="vehicule_id" name="vehicule_id" required>
                                        <option value="">Select a vehicle</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option
                                                data-seats="{{ $vehicle->allowedSeatCount() }}"
                                                data-type-label="{{ $vehicleTypes[$vehicle->type] ?? ucfirst($vehicle->type) }}"
                                                value="{{ $vehicle->id }}"
                                                @selected(old('vehicule_id') == $vehicle->id)
                                            >
                                                {{ $vehicle->marque }} {{ $vehicle->modele }} - {{ $vehicleTypes[$vehicle->type] ?? ucfirst($vehicle->type) }} - {{ $vehicle->immatriculation }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-[12px] font-extrabold uppercase tracking-[0.18em] text-slate-400"><span class="text-rose-500">*</span> Departure date</label>
                                <div class="field-shell picker-shell">
                                    <div class="picker-display">
                                        <span class="material-symbols-outlined picker-trigger text-slate-400 flex-shrink-0">calendar_today</span>
                                        <span class="picker-value text-sm {{ filled($defaultDate) ? '' : 'is-empty' }}" data-picker-display data-empty-value="dd/mm/yyyy">{{ $defaultDateLabel }}</span>
                                    </div>
                                    <input class="native-picker-input" data-picker-input name="date" type="date" value="{{ $defaultDate }}" required/>
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-[12px] font-extrabold uppercase tracking-[0.18em] text-slate-400"><span class="text-rose-500">*</span> Departure time</label>
                                <div class="field-shell picker-shell">
                                    <div class="picker-display">
                                        <span class="material-symbols-outlined picker-trigger text-slate-400 flex-shrink-0">schedule</span>
                                        <span class="picker-value text-sm {{ filled($defaultTime) ? '' : 'is-empty' }}" data-picker-display data-empty-value="--:--">{{ $defaultTimeLabel }}</span>
                                    </div>
                                    <input class="native-picker-input" data-picker-input name="heure" type="time" value="{{ $defaultTime }}" required/>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4 grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-[12px] font-extrabold uppercase tracking-[0.18em] text-slate-400"><span class="text-rose-500">*</span> Number of seats</label>
                                <input id="seat-input" name="nb_places" type="hidden" value="{{ $defaultSeats }}">
                                <div class="field-shell justify-between">
                                    <button class="flex h-8 w-8 items-center justify-center rounded-xl bg-rose-50 text-rose-500 shadow-sm transition active:scale-95" data-action="decrement-seats" type="button">
                                        <span class="material-symbols-outlined text-[15px]">remove</span>
                                    </button>
                                    <span class="text-2xl font-black leading-none text-slate-900" id="seat-count">{{ $defaultSeats }}</span>
                                    <button class="flex h-8 w-8 items-center justify-center rounded-xl bg-rose-50 text-rose-500 shadow-sm transition active:scale-95" data-action="increment-seats" type="button">
                                        <span class="material-symbols-outlined text-[15px]">add</span>
                                    </button>
                                </div>
                                <p class="mt-2 text-sm font-medium text-slate-400" id="seat-max-hint">Select a vehicle to see the seat limit.</p>
                            </div>

                            <div>
                                <label class="mb-2 block text-[12px] font-extrabold uppercase tracking-[0.18em] text-slate-400"><span class="text-rose-500">*</span> Price per passenger</label>
                                <div class="field-shell">
                                    <span class="inline-flex h-8 min-w-[64px] items-center justify-center rounded-xl bg-slate-50 px-3 text-sm font-black text-slate-500 flex-shrink-0">TND</span>
                                    <input class="w-full border-0 bg-transparent p-0 text-2xl font-black text-slate-700 placeholder:text-slate-300 focus:ring-0" id="price-input" min="0" name="prix" placeholder="0.00" step="0.01" type="number" value="{{ old('prix') }}" required/>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="border-t border-slate-200 p-5 sm:p-7">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-500 shadow-sm">
                                <span class="material-symbols-outlined text-[22px]">route</span>
                            </div>
                            <div>
                                <h2 class="text-[1.15rem] font-black text-slate-900 sm:text-[1.35rem]">2. Route and preferences</h2>
                                <p class="mt-1 text-sm font-medium text-slate-500">Choose departure, destination, and amenities passengers prefer.</p>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 lg:grid-cols-2">
                            <div class="relative" data-city-select>
                                <label class="mb-2 block text-[12px] font-extrabold uppercase tracking-[0.18em] text-slate-400"><span class="text-rose-500">*</span> Departure city</label>
                                <div class="field-shell">
                                    <span class="material-symbols-outlined text-slate-400 flex-shrink-0 text-[18px]">trip_origin</span>
                                    <input autocomplete="off" class="city-input w-full border-0 bg-transparent p-0 text-sm font-bold text-slate-900 placeholder:text-slate-300 focus:ring-0" data-city-input name="depart" placeholder="Choose a city" type="text" value="{{ old('depart') }}" required/>
                                    <button class="city-toggle text-slate-400 transition hover:text-slate-700 flex-shrink-0" data-city-toggle tabindex="-1" type="button">
                                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                                    </button>
                                </div>
                                <div class="city-menu absolute left-0 right-0 top-full z-20 mt-2 hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/8" data-city-menu>
                                    <div class="max-h-60 overflow-y-auto py-2">
                                        @foreach ($cities as $city)
                                            <button class="city-option flex w-full items-center justify-between px-4 py-2.5 text-left text-sm font-semibold text-slate-600 transition hover:bg-rose-50 hover:text-rose-600" data-city-option type="button" value="{{ $city }}">
                                                <span>{{ $city }}</span>
                                                <span class="material-symbols-outlined text-[16px]">arrow_outward</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="relative" data-city-select>
                                <label class="mb-2 block text-[12px] font-extrabold uppercase tracking-[0.18em] text-slate-400"><span class="text-rose-500">*</span> Destination city</label>
                                <div class="field-shell">
                                    <span class="material-symbols-outlined text-rose-500 flex-shrink-0 text-[18px]">flag</span>
                                    <input autocomplete="off" class="city-input w-full border-0 bg-transparent p-0 text-sm font-bold text-slate-900 placeholder:text-slate-300 focus:ring-0" data-city-input name="destination" placeholder="Choose a city" type="text" value="{{ old('destination') }}" required/>
                                    <button class="city-toggle text-slate-400 transition hover:text-slate-700 flex-shrink-0" data-city-toggle tabindex="-1" type="button">
                                        <span class="material-symbols-outlined text-[20px]">expand_more</span>
                                    </button>
                                </div>
                                <div class="city-menu absolute left-0 right-0 top-full z-20 mt-2 hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/8" data-city-menu>
                                    <div class="max-h-60 overflow-y-auto py-2">
                                        @foreach ($cities as $city)
                                            <button class="city-option flex w-full items-center justify-between px-4 py-2.5 text-left text-sm font-semibold text-slate-600 transition hover:bg-rose-50 hover:text-rose-600" data-city-option type="button" value="{{ $city }}">
                                                <span>{{ $city }}</span>
                                                <span class="material-symbols-outlined text-[16px]">arrow_outward</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 rounded-2xl border border-rose-100 bg-rose-50/70 px-4 py-3 text-sm font-medium text-slate-600">
                            Open the city list or type a few letters to jump quickly to destinations from the Find Rides page.
                        </div>

                        <div class="mt-6 flex flex-wrap gap-2.5">
                            <div>
                                <input @checked(old('ac_included')) class="amenity-input" id="ac_included" name="ac_included" type="checkbox" value="1">
                                <label class="amenity-pill" for="ac_included">
                                    <span class="material-symbols-outlined text-[16px]">ac_unit</span>
                                    AC included
                                </label>
                            </div>
                            <div>
                                <input @checked(old('pets_allowed')) class="amenity-input" id="pets_allowed" name="pets_allowed" type="checkbox" value="1">
                                <label class="amenity-pill" for="pets_allowed">
                                    <span class="material-symbols-outlined text-[16px]">pets</span>
                                    Pet friendly
                                </label>
                            </div>
                            <div>
                                <input @checked(old('smoking_allowed')) class="amenity-input" id="smoking_allowed" name="smoking_allowed" type="checkbox" value="1">
                                <label class="amenity-pill" for="smoking_allowed">
                                    <span class="material-symbols-outlined text-[16px]">smoking_rooms</span>
                                    Smoking allowed
                                </label>
                            </div>
                            <div>
                                <input @checked(old('baggage_allowed', true)) class="amenity-input" id="baggage_allowed" name="baggage_allowed" type="checkbox" value="1">
                                <label class="amenity-pill" for="baggage_allowed">
                                    <span class="material-symbols-outlined text-[16px]">luggage</span>
                                    Baggage allowed
                                </label>
                            </div>
                            <div>
                                <input @checked(old('food_drinks_allowed')) class="amenity-input" id="food_drinks_allowed" name="food_drinks_allowed" type="checkbox" value="1">
                                <label class="amenity-pill" for="food_drinks_allowed">
                                    <span class="material-symbols-outlined text-[16px]">restaurant</span>
                                    Food &amp; drinks
                                </label>
                            </div>
                        </div>
                    </section>

                    <div class="flex justify-center border-t border-slate-200 p-5 sm:p-7">
                        <button class="inline-flex w-full max-w-[320px] items-center justify-center gap-3 rounded-[18px] bg-gradient-to-r from-[#F26D5D] to-[#F82E6E] px-5 py-3.5 text-sm font-black text-white shadow-[0_18px_30px_rgba(248,46,110,0.18)] transition hover:scale-[1.01] active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-50" type="submit" @disabled($vehicles->isEmpty())>
                            Publish ride
                            <span class="material-symbols-outlined">rocket_launch</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <aside class="space-y-4 xl:sticky xl:top-24 xl:self-start">
            <div class="metric-card rounded-[28px] p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-[1.15rem] font-black text-slate-900 sm:text-[1.3rem]">Trip preview</h3>
                        <p class="mt-2 text-sm font-medium text-slate-500">Route, seats, and pricing shown clearly as you edit.</p>
                    </div>
                    <span class="material-symbols-outlined rounded-2xl bg-rose-50 p-3 text-rose-500">map</span>
                </div>

                <div class="mt-6 space-y-4 text-sm">
                    <div class="flex items-center justify-between gap-3 text-slate-500">
                        <span class="font-semibold">Vehicle</span>
                        <span class="font-bold text-slate-400" id="summary-vehicle">--</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 text-slate-500">
                        <span class="font-semibold">Available seats</span>
                        <span class="font-bold text-slate-400" id="summary-seats">{{ $defaultSeats }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3 text-slate-500">
                        <span class="font-semibold">Price per passenger</span>
                        <span class="font-bold text-slate-400">TND <span id="summary-price">{{ number_format($defaultPrice, 2) }}</span></span>
                    </div>
                </div>

                <div class="mt-6 rounded-[18px] bg-gradient-to-r from-[#F26D5D] to-[#F82E6E] px-5 py-4 text-white shadow-[0_14px_26px_rgba(248,46,110,0.16)]">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-lg font-black">Potential total</span>
                        <span class="text-2xl font-black">TND <span id="earn-total">{{ number_format($defaultBase * 0.95, 2) }}</span></span>
                    </div>
                </div>

                <div class="mt-4 rounded-[18px] border border-slate-100 bg-slate-50/90 px-4 py-4">
                    <p class="text-[11px] font-extrabold uppercase tracking-[0.18em] text-slate-400">Route</p>
                    <div class="mt-2 flex items-center justify-between gap-3">
                        <p class="font-bold text-slate-900" data-summary-route>Departure -> Destination</p>
                        <span class="material-symbols-outlined rounded-xl bg-rose-50 p-2 text-rose-500">route</span>
                    </div>
                </div>

                <div class="hidden">
                    <span id="earn-seat-count">{{ $defaultSeats }}</span>
                    <span id="earn-base">{{ number_format($defaultBase, 2) }}</span>
                    <span id="earn-fee">{{ number_format($defaultBase * 0.05, 2) }}</span>
                </div>
            </div>

            <div class="metric-card rounded-[28px] p-5">
                <h3 class="text-[1.1rem] font-black text-slate-900">Quick stats</h3>

                <div class="mt-5 space-y-4">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined rounded-2xl bg-sky-50 p-2.5 text-sky-500">directions_car</span>
                            <span class="font-semibold text-slate-700">Available vehicles</span>
                        </div>
                        <span class="text-2xl font-black text-slate-900">{{ $vehicles->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined rounded-2xl bg-emerald-50 p-2.5 text-emerald-500">location_city</span>
                            <span class="font-semibold text-slate-700">Ready destinations</span>
                        </div>
                        <span class="text-2xl font-black text-slate-900">{{ count($cities) }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined rounded-2xl bg-violet-50 p-2.5 text-violet-500">groups</span>
                            <span class="font-semibold text-slate-700">Potential passengers</span>
                        </div>
                        <span class="text-2xl font-black text-slate-900">150+</span>
                    </div>
                </div>
            </div>

            <div class="rounded-[24px] border border-sky-100 bg-sky-50/80 px-5 py-5 shadow-[0_10px_24px_rgba(59,130,246,0.05)]">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined rounded-2xl bg-white p-3 text-sky-500 shadow-sm">support_agent</span>
                    <div>
                        <h3 class="text-lg font-black text-slate-900">Need help?</h3>
                        <p class="mt-1 text-sm font-medium text-slate-500">Check the guide or contact support.</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</main>

<footer class="w-full border-t border-slate-200/80 bg-white/70 py-12 backdrop-blur-sm">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-8 md:flex-row">
        <div class="flex flex-col items-center gap-2 md:items-start">
            <span class="text-xl font-bold tracking-tight text-slate-900">RideWave</span>
            <span class="text-xs uppercase tracking-widest text-slate-500">&copy; 2024 RideWave Carpooling. All rights reserved.</span>
        </div>
        <nav class="flex flex-wrap justify-center gap-8">
            <a class="text-xs uppercase tracking-widest text-slate-500 underline underline-offset-4 opacity-80 transition-all hover:text-slate-900 hover:opacity-100" href="#">Privacy Policy</a>
            <a class="text-xs uppercase tracking-widest text-slate-500 underline underline-offset-4 opacity-80 transition-all hover:text-slate-900 hover:opacity-100" href="#">Terms of Service</a>
            <a class="text-xs uppercase tracking-widest text-slate-500 underline underline-offset-4 opacity-80 transition-all hover:text-slate-900 hover:opacity-100" href="#">Safety Guidelines</a>
            <a class="text-xs uppercase tracking-widest text-slate-500 underline underline-offset-4 opacity-80 transition-all hover:text-slate-900 hover:opacity-100" href="#">Contact Us</a>
        </nav>
    </div>
</footer>

<script>
    const vehicleSelect = document.getElementById('vehicule_id');
    const seatInput = document.getElementById('seat-input');
    const seatCount = document.getElementById('seat-count');
    const seatMaxHint = document.getElementById('seat-max-hint');
    const earnSeatCount = document.getElementById('earn-seat-count');
    const priceInput = document.getElementById('price-input');
    const earnBase = document.getElementById('earn-base');
    const earnFee = document.getElementById('earn-fee');
    const earnTotal = document.getElementById('earn-total');
    const summaryVehicle = document.getElementById('summary-vehicle');
    const summarySeats = document.getElementById('summary-seats');
    const summaryPrice = document.getElementById('summary-price');
    const summaryRoutes = Array.from(document.querySelectorAll('[data-summary-route]'));
    const departInput = document.querySelector('input[name="depart"]');
    const destinationInput = document.querySelector('input[name="destination"]');

    function currentVehicleSeatLimit() {
        const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

        if (!selectedOption || !selectedOption.dataset.seats) {
            return 1;
        }

        return Math.max(1, parseInt(selectedOption.dataset.seats, 10));
    }

    function currentVehicleTypeLabel() {
        const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

        if (!selectedOption || !selectedOption.dataset.typeLabel) {
            return 'vehicle';
        }

        return selectedOption.dataset.typeLabel;
    }

    function currentVehicleSummaryLabel() {
        const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];

        if (!selectedOption || !selectedOption.value) {
            return 'Not selected';
        }

        return selectedOption.textContent.split(' - ')[0].trim() || currentVehicleTypeLabel();
    }

    function updateSnapshotRoute() {
        const depart = departInput?.value.trim() || 'Departure';
        const destination = destinationInput?.value.trim() || 'Destination';

        summaryRoutes.forEach((summaryRoute) => {
            summaryRoute.textContent = `${depart} -> ${destination}`;
        });
    }

    function syncPickerDisplays() {
        document.querySelectorAll('[data-picker-shell], .picker-shell').forEach((pickerShell) => {
            const input = pickerShell.querySelector('[data-picker-input]');
            const display = pickerShell.querySelector('[data-picker-display]');

            if (!input || !display || input.dataset.pickerBound === 'true') {
                return;
            }

            const syncDisplay = () => {
                const emptyValue = display.dataset.emptyValue ?? '';
                let formattedValue = input.value;

                if (input.type === 'date' && input.value) {
                    const [year, month, day] = input.value.split('-');
                    formattedValue = [day, month, year].filter(Boolean).join('/');
                }

                if (input.type === 'time' && input.value) {
                    formattedValue = input.value.slice(0, 5);
                }

                display.textContent = formattedValue || emptyValue;
                display.classList.toggle('is-empty', !input.value);
            };

            input.addEventListener('input', syncDisplay);
            input.addEventListener('change', syncDisplay);
            input.dataset.pickerBound = 'true';
            syncDisplay();
        });
    }

    function updateEarnings() {
        const maxSeats = currentVehicleSeatLimit();
        const seats = Math.min(maxSeats, Math.max(1, parseInt(seatInput.value || '1', 10)));
        const price = Math.max(0, parseFloat(priceInput.value || '0'));
        const base = seats * price;
        const fee = base * 0.05;
        const total = base - fee;

        seatInput.value = seats;
        seatCount.textContent = seats;
        seatMaxHint.textContent = vehicleSelect.value
            ? `Max seats for this ${currentVehicleTypeLabel().toLowerCase()}: ${maxSeats}`
            : 'Select a vehicle to see the seat limit.';
        earnSeatCount.textContent = seats;
        earnBase.textContent = base.toFixed(2);
        earnFee.textContent = fee.toFixed(2);
        earnTotal.textContent = total.toFixed(2);
        summarySeats.textContent = seats;
        summaryPrice.textContent = price.toFixed(2);
        summaryVehicle.textContent = currentVehicleSummaryLabel();
    }

    document.querySelector('[data-action="decrement-seats"]').addEventListener('click', () => {
        seatInput.value = Math.max(1, parseInt(seatInput.value || '1', 10) - 1);
        updateEarnings();
    });

    document.querySelector('[data-action="increment-seats"]').addEventListener('click', () => {
        seatInput.value = Math.min(currentVehicleSeatLimit(), parseInt(seatInput.value || '1', 10) + 1);
        updateEarnings();
    });

    vehicleSelect.addEventListener('change', updateEarnings);
    priceInput.addEventListener('input', updateEarnings);

    [departInput, destinationInput].forEach((input) => {
        input?.addEventListener('input', updateSnapshotRoute);
    });

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
        input.addEventListener('input', () => {
            openMenu();
            updateSnapshotRoute();
        });

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

    syncPickerDisplays();
    updateEarnings();
    updateSnapshotRoute();
</script>
@include('partials.theme-toggle-script')
</body>
</html>


