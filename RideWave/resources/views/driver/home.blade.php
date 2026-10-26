<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Driver Home | RideWave</title>
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(242, 109, 93, 0.18), transparent 28%),
                radial-gradient(circle at 85% 12%, rgba(248, 46, 110, 0.15), transparent 24%),
                linear-gradient(180deg, #fffaf7 0%, #ffffff 54%, #fff7f3 100%);
        }
        .brand-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); }
        .brand-text-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .card-shadow { box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }

        html.dark body.driver-home-page {
            background:
                radial-gradient(circle at top left, rgba(244, 63, 94, 0.12), transparent 30%),
                radial-gradient(circle at 85% 12%, rgba(15, 23, 42, 0.88), transparent 26%),
                linear-gradient(180deg, #08111f 0%, #0b1220 54%, #08111f 100%);
        }

        html.dark .driver-home-page .card-shadow {
            box-shadow: 0 24px 58px rgba(2, 6, 23, 0.56);
        }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="driver-home-page text-slate-900">
@include('driver.partials.navbar', ['active' => 'home'])
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
                    <span class="inline-block px-4 py-1.5 rounded-full bg-rose-50 text-rose-600 text-[10px] font-bold uppercase tracking-[0.2em] mb-5">Driver Home</span>
                    <h1 class="text-5xl md:text-6xl font-black tracking-tight leading-[1.02] mb-6">Welcome back. Your <span class="brand-text-gradient">RideWave driver home</span> is ready.</h1>
                    <p class="text-lg text-slate-500 max-w-2xl mb-8">Check your upcoming rides, passenger requests, and fleet status from a landing-page-style home built for drivers.</p>
                    <div class="flex flex-wrap gap-4">
                        <a class="brand-gradient text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl shadow-rose-500/20 transition-all hover:scale-[1.02]" href="{{ route('driver.offer-ride.create') }}">Offer a Ride</a>
                        <a class="bg-white border-2 border-slate-100 text-slate-600 px-8 py-4 rounded-2xl font-bold text-lg hover:border-rose-200 transition-all flex items-center gap-2" href="{{ route('driver.find-rides') }}">
                            <span class="material-symbols-outlined">search</span>
                            Find Rides
                        </a>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-[32px] border border-white/80 bg-white/85 card-shadow min-h-[360px]">
                    <img
                        alt="Scenic mountain road with a car"
                        class="h-full w-full object-cover"
                        src="{{ url('images/hero.jpg') }}"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-900/25 to-transparent"></div>

                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-[28px] p-7 border border-slate-100 card-shadow">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined">add_road</span>
                </div>
                <h2 class="text-xl font-extrabold mb-2">Publish rides faster</h2>
                <p class="text-slate-500">Offer a new trip and keep your seats visible to the right passengers.</p>
            </div>
            <div class="bg-white rounded-[28px] p-7 border border-slate-100 card-shadow">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined">groups</span>
                </div>
                <h2 class="text-xl font-extrabold mb-2">Manage requests</h2>
                <p class="text-slate-500">Review passenger activity and keep your next departures organized.</p>
            </div>
            <div class="bg-white rounded-[28px] p-7 border border-slate-100 card-shadow">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined">directions_car</span>
                </div>
                <h2 class="text-xl font-extrabold mb-2">Track your fleet</h2>
                <p class="text-slate-500">Keep your cars, seats, and ride readiness in one polished place.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-8">
            <div class="bg-white rounded-[32px] p-8 md:p-10 border border-slate-100 card-shadow">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
                    <div>
                        <span class="inline-block px-4 py-1 rounded-full bg-rose-50 text-rose-600 font-bold text-[10px] uppercase tracking-[0.2em] mb-4">Upcoming Rides</span>
                        <h2 class="text-3xl font-extrabold tracking-tight">Your next driver moments</h2>
                        <p class="text-slate-500 mt-2">A quick view of the rides you are about to run.</p>
                    </div>
                    <a class="text-sm font-bold text-rose-500 hover:underline" href="{{ route('driver.dashboard') }}">Open dashboard</a>
                </div>
                <div class="grid gap-4">
                    @forelse ($upcomingRides as $ride)
                        <div class="rounded-[24px] border border-slate-100 bg-slate-50/60 px-6 py-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                            <div>
                                <h3 class="text-xl font-extrabold text-slate-900">{{ $ride->depart }} <span class="text-rose-500">&rarr;</span> {{ $ride->destination }}</h3>
                                <p class="text-sm text-slate-500 mt-2">{{ $ride->date->format('d M Y') }} at {{ $ride->heure }} &bull; {{ $ride->reservations->where('statut', \App\Models\Reservation::STATUS_CONFIRMED)->count() }} confirmed requests</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3 min-w-[260px]">
                                <div class="bg-white rounded-2xl p-4 border border-slate-100">
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-slate-400">Price</p>
                                    <p class="text-sm font-bold text-slate-900 mt-1">${{ number_format($ride->prix, 2) }}</p>
                                </div>
                                <div class="bg-white rounded-2xl p-4 border border-slate-100">
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-slate-400">Passengers</p>
                                    <p class="text-sm font-bold text-slate-900 mt-1">{{ $ride->reservations->where('statut', \App\Models\Reservation::STATUS_CONFIRMED)->sum('nb_places') }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-[28px] border border-slate-100 bg-slate-50 px-8 py-12 text-center">
                            <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-5">
                                <span class="material-symbols-outlined text-3xl">add_road</span>
                            </div>
                            <h3 class="text-2xl font-extrabold mb-3">No rides scheduled yet</h3>
                            <p class="text-slate-500 mb-6">Offer your first ride to start building your driver activity.</p>
                            <a class="brand-gradient text-white px-7 py-3 rounded-xl font-bold inline-flex items-center gap-2" href="{{ route('driver.offer-ride.create') }}">
                                <span class="material-symbols-outlined text-sm">add</span>
                                Offer a Ride
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-[32px] p-8 md:p-10 border border-slate-100 card-shadow">
                <div class="mb-8">
                    <span class="inline-block px-4 py-1 rounded-full bg-rose-50 text-rose-600 font-bold text-[10px] uppercase tracking-[0.2em] mb-4">Pending Requests</span>
                    <h2 class="text-3xl font-extrabold tracking-tight">Passenger activity</h2>
                    <p class="text-slate-500 mt-2">Review new demands before those passengers join your trip.</p>
                </div>
                <div class="space-y-4">
                    @forelse ($pendingRequests as $reservation)
                        <div class="rounded-[24px] border border-slate-100 bg-slate-50/60 px-5 py-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-11 h-11 rounded-full bg-white border border-slate-100 flex items-center justify-center text-sm font-black text-slate-700">
                                    {{ strtoupper(substr($reservation->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $reservation->user->name }}</p>
                                    <p class="text-xs text-slate-500">Pending &bull; {{ $reservation->nb_places }} seat(s)</p>
                                </div>
                            </div>
                            <p class="text-sm text-slate-600">{{ $reservation->trajet->depart }} &rarr; {{ $reservation->trajet->destination }}</p>
                            <div class="mt-4 flex gap-2">
                                <form action="{{ route('driver.reservations.accept', $reservation) }}" method="POST">
                                    @csrf
                                    <button class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-white transition hover:bg-slate-800" type="submit">Accept</button>
                                </form>
                                <form action="{{ route('driver.reservations.reject', $reservation) }}" method="POST">
                                    @csrf
                                    <button class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600 transition hover:border-rose-200 hover:text-rose-600" type="submit">Decline</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-[28px] border border-slate-100 bg-slate-50 px-8 py-12 text-center">
                            <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-5">
                                <span class="material-symbols-outlined text-3xl">groups</span>
                            </div>
                            <h3 class="text-2xl font-extrabold mb-3">No requests yet</h3>
                            <p class="text-slate-500">Booking demands will appear here once passengers start requesting seats.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</main>
@include('driver.partials.footer')
@include('partials.theme-toggle-script')
</body>
</html>
