<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>RideWave | Fleet Management</title>
    <meta content="#ffffff" name="theme-color"/>
    @include('partials.theme-init')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(242, 109, 93, 0.16), transparent 30%),
                radial-gradient(circle at 85% 12%, rgba(248, 46, 110, 0.12), transparent 24%),
                linear-gradient(180deg, #fffaf7 0%, #ffffff 56%, #fff7f3 100%);
        }
        .brand-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); }
        .card-shadow { box-shadow: 0 14px 36px rgba(15, 23, 42, 0.08); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
        .field-shell {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 0.85rem;
            padding: 0.65rem 0.85rem;
            transition: all 0.18s ease;
        }
        .field-shell:focus-within {
            border-color: rgba(248, 46, 110, 0.3);
            box-shadow: 0 0 0 4px rgba(248, 46, 110, 0.08);
            background: #ffffff;
        }
        .horizontal-fleet {
            scroll-behavior: smooth;
            scroll-snap-type: x proximity;
            -webkit-overflow-scrolling: touch;
        }
        .horizontal-fleet::-webkit-scrollbar {
            height: 8px;
        }
        .horizontal-fleet::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .horizontal-fleet::-webkit-scrollbar-track {
            background: transparent;
        }

        html.dark body.driver-fleet-page {
            background:
                radial-gradient(circle at top left, rgba(244, 63, 94, 0.12), transparent 32%),
                radial-gradient(circle at 85% 12%, rgba(15, 23, 42, 0.9), transparent 26%),
                linear-gradient(180deg, #08111f 0%, #0b1220 56%, #08111f 100%);
        }

        html.dark .driver-fleet-page .card-shadow {
            box-shadow: 0 22px 56px rgba(2, 6, 23, 0.55);
        }

        html.dark .driver-fleet-page .field-shell {
            border-color: rgba(148, 163, 184, 0.22);
            background: #0b1220;
        }

        html.dark .driver-fleet-page .field-shell:focus-within {
            border-color: rgba(244, 63, 94, 0.35);
            box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.14);
            background: #111827;
        }

        html.dark .driver-fleet-page .horizontal-fleet::-webkit-scrollbar-thumb {
            background: #334155;
        }

        html.dark .driver-fleet-page [class*='bg-slate-950'] {
            background-color: #020617 !important;
        }

        html.dark .driver-fleet-page [class*='bg-slate-900'] {
            background-color: #0f172a !important;
        }

        html.dark .driver-fleet-page [class*='bg-slate-100'] {
            background-color: rgba(30, 41, 59, 0.75) !important;
        }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="driver-fleet-page text-slate-900">
@include('driver.partials.navbar', ['active' => 'fleet'])

@php
    $vehicleCount = $vehicles->count();
    $totalSeats = (int) $vehicles->sum('places');
    $averageSeats = $vehicleCount > 0 ? number_format($totalSeats / $vehicleCount, 1) : '0';
    $editingVehicle = $editingVehicle ?? null;
    $isEditing = $editingVehicle !== null;
    $selectedType = old('type', $editingVehicle?->type ?? 'car');
    $selectedSeatLimit = $seatLimits[$selectedType] ?? 5;
    $photoStatusText = $isEditing && $editingVehicle?->photo_path ? 'Keep current photo' : 'No file chosen';
    $isHorizontalFleet = $vehicleCount > 3;
@endphp

<main class="mx-auto max-w-screen-xl px-4 pb-10 pt-6 sm:px-6 lg:px-8">
    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="mb-4 rounded-xl border border-rose-100 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">{{ $errors->first() }}</div>
    @endif

    <header class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-rose-600">Driver fleet</p>
            <h1 class="mt-1 text-3xl font-black tracking-tight">Manage your vehicles</h1>
            <p class="mt-1 text-sm text-slate-500">Add your vehicle details once, then use them when publishing rides.</p>
        </div>
        <a class="inline-flex items-center gap-2 rounded-xl brand-gradient px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-rose-500/20" href="{{ $isEditing ? route('driver.fleet') : '#vehicle-form' }}">
            <span class="material-symbols-outlined text-base">add_circle</span>
            {{ $isEditing ? 'Add new vehicle' : 'Add vehicle' }}
        </a>
    </header>

    <section class="grid gap-4 lg:grid-cols-12">
        <aside class="relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-4 card-shadow lg:col-span-4">
            <div class="absolute -right-8 -top-10 h-24 w-24 rounded-full bg-rose-100/70 blur-2xl"></div>
            <div class="absolute -left-8 bottom-6 h-20 w-20 rounded-full bg-orange-100/70 blur-2xl"></div>
            <div class="relative">
                <span class="inline-flex rounded-full bg-rose-50 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.16em] text-rose-600">Quick start</span>
                <h2 class="mt-2 text-lg font-black text-slate-900">Your first fleet setup</h2>
                <p class="mt-1 text-sm text-slate-500">Follow this once and your vehicles will be ready for every new ride.</p>

                <div class="relative mt-3 overflow-hidden rounded-xl border border-slate-800/40 bg-slate-950 p-3">
                    <div class="absolute -left-4 top-1/2 h-14 w-14 -translate-y-1/2 rounded-full bg-orange-400/25 blur-xl"></div>
                    <div class="absolute -right-3 top-2 h-16 w-16 rounded-full bg-rose-500/25 blur-xl"></div>
                    <svg aria-hidden="true" class="relative h-20 w-full" viewBox="0 0 280 80">
                        <defs>
                            <linearGradient id="guideLine" x1="0" x2="1" y1="0" y2="0">
                                <stop offset="0%" stop-color="#F26D5D"/>
                                <stop offset="100%" stop-color="#F82E6E"/>
                            </linearGradient>
                        </defs>
                        <path d="M16 60 C72 12, 138 68, 264 20" fill="none" stroke="url(#guideLine)" stroke-linecap="round" stroke-width="3"/>
                        <circle cx="18" cy="60" fill="#fff" r="5"/>
                        <circle cx="94" cy="31" fill="#fff" r="4"/>
                        <circle cx="172" cy="50" fill="#fff" r="4"/>
                        <circle cx="264" cy="20" fill="#fff" r="5"/>
                    </svg>
                    <p class="relative mt-1 text-[11px] font-semibold uppercase tracking-[0.16em] text-rose-100">4 quick steps to publish your first ride</p>
                </div>

                <div class="mt-3 space-y-2.5 text-sm">
                    <div class="flex gap-2.5 rounded-xl border border-slate-100 bg-slate-50/80 p-2.5">
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-slate-900 text-[11px] font-black text-white">1</span>
                        <p class="text-slate-600">Fill vehicle details: <span class="font-semibold text-slate-900">brand, model, year, color, plate, seats</span>.</p>
                    </div>
                    <div class="flex gap-2.5 rounded-xl border border-slate-100 bg-slate-50/80 p-2.5">
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-slate-900 text-[11px] font-black text-white">2</span>
                        <p class="text-slate-600">Pick the <span class="font-semibold text-slate-900">vehicle type first</span> so the seat limit is set automatically.</p>
                    </div>
                    <div class="flex gap-2.5 rounded-xl border border-slate-100 bg-slate-50/80 p-2.5">
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-slate-900 text-[11px] font-black text-white">3</span>
                        <p class="text-slate-600">Click <span class="font-semibold text-slate-900">Save vehicle</span>. It appears instantly in the list below.</p>
                    </div>
                    <div class="flex gap-2.5 rounded-xl border border-slate-100 bg-slate-50/80 p-2.5">
                        <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-slate-900 text-[11px] font-black text-white">4</span>
                        <p class="text-slate-600">Go to <a class="font-bold text-rose-600 hover:underline" href="{{ route('driver.offer-ride.create') }}">Offer a Ride</a> and choose your vehicle.</p>
                    </div>
                </div>

                <div class="mt-3 rounded-xl border border-slate-100 bg-slate-50 p-3">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Seat limits</p>
                        <span class="rounded-full bg-white px-2 py-0.5 text-[10px] font-bold uppercase tracking-[0.14em] text-slate-500 border border-slate-200">Auto checked</span>
                    </div>
                    <div class="mt-2 grid grid-cols-2 gap-2 text-xs">
                        @foreach ($vehicleTypes as $vehicleTypeValue => $vehicleTypeLabel)
                            <div class="rounded-lg border border-slate-100 bg-white px-2.5 py-2">
                                <p class="font-medium text-slate-600">{{ $vehicleTypeLabel }}</p>
                                <p class="mt-0.5 font-black text-slate-900">{{ $seatLimits[$vehicleTypeValue] ?? 5 }} seats max</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>

        <div class="lg:col-span-8 space-y-3">
            <section class="rounded-2xl border border-slate-800/70 bg-slate-950 p-3 card-shadow">
                <div class="grid gap-2 sm:grid-cols-3">
                    <article class="rounded-xl border border-rose-300/20 bg-[#1F263A] px-3 py-2.5">
                        <div class="flex items-center justify-between">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-rose-200/80">Vehicles</p>
                            <span class="material-symbols-outlined text-sm text-rose-200/70">directions_car</span>
                        </div>
                        <p class="mt-1 text-lg font-black text-rose-50">{{ $vehicleCount }}</p>
                    </article>
                    <article class="rounded-xl border border-green-300/20 bg-[#1F263A] px-3 py-2.5">
                        <div class="flex items-center justify-between">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-green-200/80">Total seats</p>
                            <span class="material-symbols-outlined text-sm text-green-200/70">airline_seat_recline_extra</span>
                        </div>
                        <p class="mt-1 text-lg font-black text-green-50">{{ $totalSeats }}</p>
                    </article>
                    <article class="rounded-xl border border-indigo-300/20 bg-[#1F263A] px-3 py-2.5">
                        <div class="flex items-center justify-between">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-indigo-200/85">Avg seats/vehicle</p>
                            <span class="material-symbols-outlined text-sm text-indigo-200/70">analytics</span>
                        </div>
                        <p class="mt-1 text-lg font-black text-indigo-50">{{ $averageSeats }}</p>
                    </article>
                </div>
            </section>

            <section class="rounded-2xl border border-slate-100 bg-white p-4 card-shadow" id="vehicle-form">
            <div>
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-start gap-2.5">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-500">
                            <span class="material-symbols-outlined text-base">garage_home</span>
                        </span>
                        <div>
                            <h2 class="text-lg font-black text-slate-900">{{ $isEditing ? 'Edit vehicle' : 'Add a vehicle' }}</h2>
                            <p class="mt-1 text-sm text-slate-500">
                                {{ $isEditing ? 'Update details so riders can still identify your vehicle at pickup.' : 'Keep details accurate so riders can identify your vehicle at pickup.' }}
                            </p>
                        </div>
                    </div>
                    <span class="hidden rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.14em] text-slate-500 sm:inline-flex">{{ $isEditing ? 'Edit mode' : '6 fields' }}</span>
                </div>

                <div class="mt-3 flex items-start gap-2 rounded-xl border border-slate-100 bg-slate-50/80 px-3 py-2 text-xs text-slate-600">
                    <span class="material-symbols-outlined text-sm text-rose-500">tips_and_updates</span>
                    @if ($isEditing)
                        Editing <span class="font-semibold text-slate-900">{{ $editingVehicle->marque }} {{ $editingVehicle->modele }}</span>. Change fields, then click update.
                    @else
                        Start with <span class="font-semibold text-slate-900">Vehicle type</span>, then fill details top to bottom.
                    @endif
                </div>

                <form action="{{ $isEditing ? route('driver.fleet.update', $editingVehicle) : route('driver.fleet.store') }}" class="mt-4 grid gap-3 sm:grid-cols-2 sm:gap-4" enctype="multipart/form-data" method="POST">
                    @csrf
                    @if ($isEditing)
                        @method('PUT')
                    @endif
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="type"><span class="text-rose-500">*</span> Vehicle type</label>
                        <div class="field-shell flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">category</span>
                            <select class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 focus:ring-0" id="type" name="type" required>
                                @foreach ($vehicleTypes as $vehicleTypeValue => $vehicleTypeLabel)
                                    <option value="{{ $vehicleTypeValue }}" @selected($selectedType === $vehicleTypeValue)>{{ $vehicleTypeLabel }}</option>
                                @endforeach
                            </select>
                            <span class="material-symbols-outlined text-base text-slate-400">expand_more</span>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="marque"><span class="text-rose-500">*</span> Brand</label>
                        <div class="field-shell flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">branding_watermark</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="marque" name="marque" placeholder="Toyota" type="text" value="{{ old('marque', $editingVehicle->marque ?? '') }}" required>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="modele"><span class="text-rose-500">*</span> Model</label>
                        <div class="field-shell flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">directions_car</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="modele" name="modele" placeholder="Corolla" type="text" value="{{ old('modele', $editingVehicle->modele ?? '') }}" required>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="annee"><span class="text-rose-500">*</span> Year</label>
                        <div class="field-shell flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">calendar_month</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="annee" max="{{ date('Y') + 1 }}" min="1990" name="annee" placeholder="2024" type="number" value="{{ old('annee', $editingVehicle->annee ?? '') }}" required>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="couleur"><span class="text-rose-500">*</span> Color</label>
                        <div class="field-shell flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">palette</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="couleur" name="couleur" placeholder="White" type="text" value="{{ old('couleur', $editingVehicle->couleur ?? '') }}" required>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="immatriculation"><span class="text-rose-500">*</span> Plate number</label>
                        <div class="field-shell flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">badge</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold uppercase tracking-wide text-slate-900 placeholder:text-slate-300 focus:ring-0" id="immatriculation" name="immatriculation" placeholder="123-TUN-456" type="text" value="{{ old('immatriculation', $editingVehicle->immatriculation ?? '') }}" required>
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="places"><span class="text-rose-500">*</span> Seats</label>
                        <div class="field-shell flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">airline_seat_recline_extra</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="places" max="{{ $selectedSeatLimit }}" min="1" name="places" type="number" value="{{ old('places', $editingVehicle->places ?? 4) }}" required>
                        </div>
                        <p class="mt-1.5 text-xs font-semibold text-slate-400" id="seat-limit-hint">Max seats for this type: {{ $selectedSeatLimit }}</p>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="photo">Car photo</label>
                        <div class="field-shell flex flex-wrap items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">photo_camera</span>
                            <input accept="image/jpeg,image/png,image/jpg,image/webp" class="sr-only" id="photo" name="photo" type="file">
                            <label class="inline-flex shrink-0 cursor-pointer items-center rounded-lg bg-slate-900 px-3 py-1.5 text-xs font-bold text-white" for="photo">Choose file</label>
                            <p class="min-w-0 flex-1 truncate text-sm font-semibold text-slate-600" id="photo-file-status">{{ $photoStatusText }}</p>
                            <div class="hidden shrink-0 items-center gap-2 rounded-lg border border-slate-200 bg-white/95 px-2 py-1" id="photo-preview-wrap">
                                <img alt="Selected car photo preview" class="h-10 w-14 rounded-md border border-slate-200 bg-white object-cover" id="photo-preview-image" src="">
                                <p class="max-w-[110px] truncate text-[11px] font-semibold text-slate-600" id="photo-preview-name"></p>
                            </div>
                        </div>
                        <p class="mt-1.5 text-xs font-semibold text-slate-400">Optional. JPG, PNG, or WEBP up to 3MB.</p>
                    </div>

                    <div class="sm:col-span-2 flex justify-end gap-2 pt-1">
                        @if ($isEditing)
                            <a class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-600 transition hover:bg-slate-50" href="{{ route('driver.fleet') }}">
                                <span class="material-symbols-outlined text-base">close</span>
                                Cancel
                            </a>
                        @endif
                        <button class="inline-flex items-center justify-center gap-2 rounded-xl brand-gradient px-4 py-2 text-sm font-bold text-white shadow-md shadow-rose-500/20" type="submit">
                            <span class="material-symbols-outlined text-base">save</span>
                            {{ $isEditing ? 'Update vehicle' : 'Save vehicle' }}
                        </button>
                    </div>
                </form>
            </div>
            </section>
        </div>
    </section>

    <section class="mt-4 rounded-2xl border border-slate-100 bg-white p-4 card-shadow">
        <div class="mb-3 flex items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-black text-slate-900">Registered vehicles</h2>
                <p class="text-sm text-slate-500">Use this list to verify details and remove outdated entries.</p>
            </div>
            <span class="rounded-full bg-slate-900 px-3 py-1 text-xs font-bold text-white">{{ $vehicleCount }}</span>
        </div>

        <div
            class="{{ $isHorizontalFleet ? 'horizontal-fleet -mx-1 flex gap-3 overflow-x-auto px-1 pb-2' : 'grid gap-3 sm:grid-cols-2 xl:grid-cols-3' }}"
            data-scroll-mode="{{ $isHorizontalFleet ? 'horizontal' : 'grid' }}"
            id="fleet-cards-scroller"
        >
            @forelse($vehicles as $vehicle)
                @php
                    $seatRatio = max(1, min(100, (int) round(($vehicle->places / max(1, $vehicle->maxSeats())) * 100)));
                @endphp
                <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_16px_30px_rgba(15,23,42,0.08)] {{ $isHorizontalFleet ? 'snap-start shrink-0 w-[calc(100%-0.25rem)] sm:w-[320px] lg:w-[340px]' : '' }} {{ $isEditing && $editingVehicle->id === $vehicle->id ? 'ring-2 ring-rose-300' : '' }}">
                    <div class="relative h-40 w-full bg-slate-100">
                        @if ($vehicle->photo_path)
                            <img alt="{{ $vehicle->marque }} {{ $vehicle->modele }}" class="h-full w-full object-cover" src="{{ route('driver.fleet.photo', $vehicle) }}">
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-700 via-slate-800 to-slate-900">
                                <span class="material-symbols-outlined text-5xl text-white/80">directions_car</span>
                            </div>
                        @endif
                        <span class="absolute right-3 top-3 rounded-full bg-emerald-100 px-2.5 py-1 text-[10px] font-black uppercase tracking-[0.16em] text-emerald-700">Active</span>
                        <span class="absolute left-3 top-3 rounded-full bg-white/90 px-2.5 py-1 text-[10px] font-black uppercase tracking-[0.16em] text-slate-700">{{ $vehicleTypes[$vehicle->type] ?? ucfirst($vehicle->type) }}</span>
                    </div>

                    <div class="p-3.5">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="truncate text-xl font-black leading-tight text-slate-900">{{ $vehicle->marque }} {{ $vehicle->modele }}</p>
                                <p class="mt-0.5 truncate text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">{{ $vehicle->immatriculation }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-black text-rose-500">{{ $vehicle->places }}</p>
                                <p class="-mt-0.5 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">seats</p>
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-2 text-xs">
                            <div class="rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-2">
                                <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Color</p>
                                <p class="mt-0.5 truncate text-sm font-bold text-slate-700">{{ $vehicle->couleur }}</p>
                            </div>
                            <div class="rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-2">
                                <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Year</p>
                                <p class="mt-0.5 text-sm font-bold text-slate-700">{{ $vehicle->annee }}</p>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="flex items-center justify-between text-[11px] font-semibold text-slate-500">
                                <span>Seat limit usage</span>
                                <span>{{ $seatRatio }}%</span>
                            </div>
                            <div class="mt-1 h-1.5 overflow-hidden rounded-full bg-slate-200">
                                <div class="h-full rounded-full bg-emerald-500" style="width: {{ $seatRatio }}%"></div>
                            </div>
                            <p class="mt-1.5 text-[11px] font-semibold text-slate-400">Type limit: {{ $vehicle->maxSeats() }} seats</p>
                        </div>

                        <div class="mt-3 grid grid-cols-[1fr_auto_auto] gap-2">
                            <a class="inline-flex items-center justify-center gap-1 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-[11px] font-bold text-slate-700 transition hover:bg-slate-100" href="{{ route('driver.offer-ride.create') }}">
                                <span class="material-symbols-outlined text-sm">route</span>
                                Offer ride
                            </a>
                            <a class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-[11px] font-bold text-slate-700 transition hover:bg-slate-50" href="{{ route('driver.fleet.edit', $vehicle) }}">
                                Edit
                            </a>
                            <form action="{{ route('driver.fleet.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Remove this vehicle from your fleet?');">
                                @csrf
                                @method('DELETE')
                                <button class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-3 py-2 text-[11px] font-bold text-white transition hover:bg-slate-800" type="submit">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="sm:col-span-2 xl:col-span-3 rounded-xl border border-dashed border-slate-200 bg-slate-50 px-5 py-8 text-center">
                    <p class="text-base font-black text-slate-900">No vehicles added yet</p>
                    <p class="mt-1 text-sm text-slate-500">Start with the form above. Your first saved vehicle will appear here.</p>
                </div>
            @endforelse
        </div>
    </section>
</main>

@include('driver.partials.footer')

<script>
    const vehicleTypeInput = document.getElementById('type');
    const placesInput = document.getElementById('places');
    const seatLimitHint = document.getElementById('seat-limit-hint');
    const photoInput = document.getElementById('photo');
    const photoFileStatus = document.getElementById('photo-file-status');
    const photoPreviewWrap = document.getElementById('photo-preview-wrap');
    const photoPreviewImage = document.getElementById('photo-preview-image');
    const photoPreviewName = document.getElementById('photo-preview-name');
    const fleetCardsScroller = document.getElementById('fleet-cards-scroller');
    const seatLimits = @json($seatLimits);
    let photoObjectUrl = null;

    function updateFleetSeatLimit() {
        if (!vehicleTypeInput || !placesInput || !seatLimitHint) {
            return;
        }

        const selectedType = vehicleTypeInput.value || 'car';
        const maxSeats = seatLimits[selectedType] ?? 5;
        const currentSeats = parseInt(placesInput.value || '1', 10);

        placesInput.max = String(maxSeats);
        placesInput.value = String(Math.min(Math.max(1, currentSeats), maxSeats));
        seatLimitHint.textContent = `Max seats for this type: ${maxSeats}`;
    }

    function updatePhotoPreview() {
        if (!photoInput || !photoFileStatus || !photoPreviewWrap || !photoPreviewImage || !photoPreviewName) {
            return;
        }

        if (photoObjectUrl) {
            URL.revokeObjectURL(photoObjectUrl);
            photoObjectUrl = null;
        }

        const selectedFile = photoInput.files && photoInput.files.length > 0 ? photoInput.files[0] : null;

        if (!selectedFile || !selectedFile.type.startsWith('image/')) {
            photoFileStatus.textContent = 'No file chosen';
            photoPreviewWrap.classList.add('hidden');
            photoPreviewImage.removeAttribute('src');
            photoPreviewName.textContent = '';
            return;
        }

        photoObjectUrl = URL.createObjectURL(selectedFile);
        photoFileStatus.textContent = selectedFile.name;
        photoPreviewImage.src = photoObjectUrl;
        photoPreviewName.textContent = selectedFile.name;
        photoPreviewWrap.classList.remove('hidden');
    }

    if (vehicleTypeInput && placesInput && seatLimitHint) {
        vehicleTypeInput.addEventListener('change', updateFleetSeatLimit);
        updateFleetSeatLimit();
    }

    if (photoInput && photoFileStatus && photoPreviewWrap && photoPreviewImage && photoPreviewName) {
        photoInput.addEventListener('change', updatePhotoPreview);
    }

    if (fleetCardsScroller && fleetCardsScroller.dataset.scrollMode === 'horizontal') {
        fleetCardsScroller.addEventListener('wheel', (event) => {
            if (Math.abs(event.deltaY) <= Math.abs(event.deltaX)) {
                return;
            }

            if (fleetCardsScroller.scrollWidth <= fleetCardsScroller.clientWidth) {
                return;
            }

            event.preventDefault();
            fleetCardsScroller.scrollBy({
                left: event.deltaY,
                behavior: 'smooth',
            });
        }, { passive: false });
    }
</script>
@include('partials.theme-toggle-script')
</body>
</html>


