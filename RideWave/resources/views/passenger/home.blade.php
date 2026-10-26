<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Passenger Home | RideWave</title>
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
                        rosewave: "#F82E6E",
                        sunset: "#F26D5D"
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); }
        .brand-text-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .card-shadow { box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="bg-[#fdf7ff] text-slate-900">
@include('passenger.partials.navbar', ['active' => 'home'])
<main class="pb-16">
    <section class="relative overflow-hidden px-6 pt-16 pb-12">
        <div class="absolute inset-0">
            <div class="absolute top-[-10%] left-[-10%] w-[45%] h-[45%] bg-rose-100/40 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-[-15%] right-[-10%] w-[50%] h-[50%] bg-orange-100/40 blur-[140px] rounded-full"></div>
        </div>
        <div class="relative max-w-7xl mx-auto">
            @if (session('success'))
                <div class="mb-8 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>
            @endif
            <div class="grid grid-cols-1 lg:grid-cols-[1.15fr_0.85fr] gap-12 items-center">
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-rose-50 text-rose-600 text-[10px] font-bold uppercase tracking-[0.2em] mb-5">Passenger Home</span>
                    <h1 class="text-5xl md:text-6xl font-black tracking-tight leading-[1.02] mb-6">Welcome back. Your <span class="brand-text-gradient">RideWave home</span> is ready.</h1>
                    <p class="text-lg text-slate-500 max-w-2xl mb-8">See available rides, track upcoming reservations, and jump back in with a lighter home experience inspired by the landing page.</p>
                    <div class="flex flex-wrap gap-4">
                        <a class="brand-gradient text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl shadow-rose-500/20 transition-all hover:scale-[1.02]" href="{{ route('passenger.find-rides') }}">Find a Ride</a>
                        <a class="bg-white border-2 border-slate-100 text-slate-600 px-8 py-4 rounded-2xl font-bold text-lg hover:border-rose-200 transition-all flex items-center gap-2" href="{{ route('passenger.history') }}">
                            <span class="material-symbols-outlined">history</span>
                            View History
                        </a>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-[32px] border border-white/80 bg-white/85 card-shadow min-h-[360px]">
                    <img
                        alt="Carpool illustration"
                        class="h-full w-full object-cover"
                        src="{{ url('images/hero.jpg') }}"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-slate-900/15 to-transparent"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-[28px] p-7 border border-slate-100 card-shadow">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined">travel_explore</span>
                </div>
                <h2 class="text-xl font-extrabold mb-2">Explore premium rides</h2>
                <p class="text-slate-500">Browse verified routes and seat availability with one click.</p>
            </div>
            <div class="bg-white rounded-[28px] p-7 border border-slate-100 card-shadow">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined">event_available</span>
                </div>
                <h2 class="text-xl font-extrabold mb-2">Manage reservations</h2>
                <p class="text-slate-500">Keep your booking flow organized with a cleaner RideWave home.</p>
            </div>
            <div class="bg-white rounded-[28px] p-7 border border-slate-100 card-shadow">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined">verified_user</span>
                </div>
                <h2 class="text-xl font-extrabold mb-2">Travel confidently</h2>
                <p class="text-slate-500">Stay inside the same trusted design language across every passenger page.</p>
            </div>
        </div>

        <div class="bg-white rounded-[32px] p-8 md:p-10 border border-slate-100 card-shadow">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
                <div>
                    <span class="inline-block px-4 py-1 rounded-full bg-rose-50 text-rose-600 font-bold text-[10px] uppercase tracking-[0.2em] mb-4">Upcoming Reservations</span>
                    <h2 class="text-3xl font-extrabold tracking-tight">Your next RideWave moments</h2>
                    <p class="text-slate-500 mt-2">See who you are riding with and when your next departures happen.</p>
                </div>
                <a class="text-sm font-bold text-rose-500 hover:underline" href="{{ route('passenger.history') }}">Open full history</a>
            </div>
            <div class="grid gap-4">
                @forelse ($upcomingReservations as $reservation)
                    <div class="rounded-[24px] border border-slate-100 bg-slate-50/60 px-6 py-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-bold uppercase tracking-wider">{{ str_replace('_', ' ', $reservation->statut) }}</span>
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-900">{{ $reservation->trajet->depart }} <span class="text-rose-500">&rarr;</span> {{ $reservation->trajet->destination }}</h3>
                            <p class="text-sm text-slate-500 mt-2">{{ $reservation->trajet->date->format('d M Y') }} at {{ $reservation->trajet->heure }} with {{ $reservation->trajet->conducteur->name }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-3 min-w-[260px]">
                            <div class="bg-white rounded-2xl p-4 border border-slate-100">
                                <p class="text-[10px] uppercase font-bold tracking-wider text-slate-400">Seats</p>
                                <p class="text-sm font-bold text-slate-900 mt-1">{{ $reservation->nb_places }}</p>
                            </div>
                            <div class="bg-white rounded-2xl p-4 border border-slate-100">
                                <p class="text-[10px] uppercase font-bold tracking-wider text-slate-400">Driver</p>
                                <p class="text-sm font-bold text-slate-900 mt-1">{{ $reservation->trajet->conducteur->name }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-[28px] border border-slate-100 bg-slate-50 px-8 py-12 text-center">
                        <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-5">
                            <span class="material-symbols-outlined text-3xl">directions_car</span>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-3">No reservations yet</h3>
                        <p class="text-slate-500 mb-6">Use Find Rides to book your first RideWave trip.</p>
                        <a class="brand-gradient text-white px-7 py-3 rounded-xl font-bold inline-flex items-center gap-2" href="{{ route('passenger.find-rides') }}">
                            <span class="material-symbols-outlined text-sm">search</span>
                            Find Rides
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</main>
@include('passenger.partials.footer')
@include('partials.theme-toggle-script')
</body>
</html>
