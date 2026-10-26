<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>RideWave | Driver Dashboard</title>
    <meta content="#ffffff" name="theme-color"/>
    @include('partials.theme-init')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(242, 109, 93, 0.18), transparent 28%),
                radial-gradient(circle at 85% 12%, rgba(248, 46, 110, 0.15), transparent 24%),
                linear-gradient(180deg, #fffaf7 0%, #ffffff 54%, #fff7f3 100%);
        }
        .brand-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); }
        .brand-text-gradient {
            background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .card-shadow { box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }

        html.dark body.driver-dashboard-page {
            background:
                radial-gradient(circle at top left, rgba(244, 63, 94, 0.12), transparent 30%),
                radial-gradient(circle at 85% 12%, rgba(15, 23, 42, 0.88), transparent 26%),
                linear-gradient(180deg, #08111f 0%, #0b1220 54%, #08111f 100%);
        }

        html.dark .driver-dashboard-page .card-shadow {
            box-shadow: 0 24px 58px rgba(2, 6, 23, 0.56);
        }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="driver-dashboard-page text-slate-900">
@include('driver.partials.navbar', ['active' => 'dashboard'])

<main class="max-w-screen-2xl mx-auto px-5 lg:px-8 pt-8 pb-12">
    @if (session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-6 rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700">{{ session('error') }}</div>
    @endif

    <section class="relative overflow-hidden rounded-[32px] border border-white/70 bg-slate-950 px-6 py-7 sm:px-8 sm:py-8 text-white card-shadow">
        <div class="absolute inset-0 opacity-90">
            <div class="absolute -left-16 top-0 h-52 w-52 rounded-full bg-orange-400/20 blur-3xl"></div>
            <div class="absolute right-0 top-0 h-64 w-64 rounded-full bg-rose-500/20 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 h-44 w-44 rounded-full bg-white/10 blur-3xl"></div>
        </div>
        <div class="relative grid gap-6 xl:grid-cols-[1.15fr_0.85fr] xl:items-end">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.24em] text-rose-100">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    Database-connected workspace
                </span>
                <h1 class="mt-4 text-3xl font-black tracking-tight sm:text-4xl">Driver operations for rides, requests, messages, history, and fleet.</h1>
                <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-300">
                    Everything on this page now points to backend records: published rides, reservation flow, comment threads, review history, and your registered vehicles.
                </p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <a class="inline-flex items-center gap-2 rounded-2xl brand-gradient px-5 py-3 text-sm font-bold text-white shadow-lg shadow-rose-500/20" href="{{ route('driver.offer-ride.create') }}">
                        <span class="material-symbols-outlined text-base">add_road</span>
                        Publish ride
                    </a>
                    <a class="inline-flex items-center gap-2 rounded-2xl border border-white/15 bg-white/5 px-5 py-3 text-sm font-bold text-white" href="{{ route('driver.history') }}">
                        <span class="material-symbols-outlined text-base">history</span>
                        Open history
                    </a>
                </div>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                <div class="rounded-[24px] border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                    <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Ride ledger</p>
                    <p class="mt-2 text-2xl font-black">{{ $stats['total_rides'] }}</p>
                    <p class="mt-1 text-xs text-slate-300">{{ $activeRides->count() }} upcoming rides and {{ $recentRideHistory->count() }} recent history entries loaded.</p>
                </div>
                <div class="rounded-[24px] border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                    <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Revenue captured</p>
                    <p class="mt-2 text-2xl font-black">${{ number_format($stats['total_earnings'], 2) }}</p>
                    <p class="mt-1 text-xs text-slate-300">{{ $stats['active_reservations'] }} confirmed reservations currently attached to your rides.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-6 grid gap-3 sm:grid-cols-2 xl:grid-cols-6">
        <div class="rounded-[22px] border border-slate-100 bg-white p-4 card-shadow">
            <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Published rides</p>
            <p class="mt-2 text-2xl font-black text-slate-900">{{ $stats['total_rides'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Trips created by your driver account.</p>
        </div>
        <div class="rounded-[22px] border border-slate-100 bg-white p-4 card-shadow">
            <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Pending requests</p>
            <p class="mt-2 text-2xl font-black text-slate-900">{{ $stats['pending_requests'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Reservations waiting for your decision.</p>
        </div>
        <div class="rounded-[22px] border border-slate-100 bg-white p-4 card-shadow">
            <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Comment threads</p>
            <p class="mt-2 text-2xl font-black text-slate-900">{{ $stats['comment_threads'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Top-level ride discussions stored for your routes.</p>
        </div>
        <div class="rounded-[22px] border border-slate-100 bg-white p-4 card-shadow">
            <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Recent messages</p>
            <p class="mt-2 text-2xl font-black text-slate-900">{{ $stats['message_count'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Latest driver and passenger comment activity.</p>
        </div>
        <div class="rounded-[22px] border border-slate-100 bg-white p-4 card-shadow">
            <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Fleet vehicles</p>
            <p class="mt-2 text-2xl font-black text-slate-900">{{ $stats['fleet_count'] }}</p>
            <p class="mt-1 text-xs text-slate-500">{{ $stats['fleet_seats'] }} total seats registered across your fleet.</p>
        </div>
        <div class="rounded-[22px] border border-slate-100 bg-white p-4 card-shadow">
            <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Reviews</p>
            <div class="mt-2 flex items-center gap-2">
                <p class="text-2xl font-black text-slate-900">{{ $stats['rating'] }}</p>
                <span class="material-symbols-outlined text-amber-400" style='font-variation-settings: "FILL" 1;'>star</span>
            </div>
            <p class="mt-1 text-xs text-slate-500">{{ $stats['review_count'] }} passenger reviews tied to completed reservations.</p>
        </div>
    </section>

    <section class="mt-6 grid gap-6 xl:grid-cols-12">
        <div class="space-y-6 xl:col-span-8">
            <section class="rounded-[28px] border border-slate-100 bg-white p-5 sm:p-6 card-shadow">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <span class="inline-flex rounded-full bg-rose-50 px-4 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-rose-600">Ride pipeline</span>
                        <h2 class="mt-3 text-2xl font-black tracking-tight">Active and upcoming rides</h2>
                        <p class="mt-1 text-sm text-slate-500">The current ride workload in a compact dashboard grid.</p>
                    </div>
                    <a class="text-sm font-bold text-rose-500 hover:underline" href="{{ route('driver.find-rides') }}">Open ride board</a>
                </div>

                <div class="mt-6 grid gap-3 lg:grid-cols-2">
                    @forelse($activeRides as $ride)
                        @php
                            $confirmedSeats = $ride->reservations->where('statut', \App\Models\Reservation::STATUS_CONFIRMED)->sum('nb_places');
                            $pendingSeats = $ride->reservations->where('statut', \App\Models\Reservation::STATUS_PENDING)->sum('nb_places');
                            $threadCount = $ride->comments->count() + $ride->comments->sum(fn ($comment) => $comment->replies->count());
                            $revenue = $ride->prix * $confirmedSeats;
                        @endphp
                        <article class="overflow-hidden rounded-[24px] border border-slate-100 bg-slate-50/70">
                            <div class="h-1.5 brand-gradient"></div>
                            <div class="p-4">
                                <div class="flex flex-col gap-4">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="rounded-full bg-white px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">RW-{{ $ride->id }}</span>
                                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-emerald-600">
                                                {{ $ride->date->isToday() ? 'Today' : ($ride->date->isFuture() ? 'Upcoming' : 'In progress') }}
                                            </span>
                                        </div>
                                        <h3 class="mt-3 text-lg font-black text-slate-900">{{ $ride->depart }} <span class="text-rose-500">&rarr;</span> {{ $ride->destination }}</h3>
                                        <p class="mt-1 text-xs text-slate-500">Departure {{ $ride->date->format('d M Y') }} at {{ $ride->heure }}</p>
                                    </div>

                                    <div class="grid gap-2 grid-cols-2">
                                        <div class="rounded-2xl bg-white p-3 border border-slate-100">
                                            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Confirmed seats</p>
                                            <p class="mt-1 text-base font-black text-slate-900">{{ $confirmedSeats }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-white p-3 border border-slate-100">
                                            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Pending seats</p>
                                            <p class="mt-1 text-base font-black text-slate-900">{{ $pendingSeats }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-white p-3 border border-slate-100">
                                            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Comment activity</p>
                                            <p class="mt-1 text-base font-black text-slate-900">{{ $threadCount }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-white p-3 border border-slate-100">
                                            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Revenue</p>
                                            <p class="mt-1 text-base font-black text-slate-900">${{ number_format($revenue, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 px-8 py-10 text-center lg:col-span-2">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-white text-rose-500 shadow-sm">
                                <span class="material-symbols-outlined text-3xl">add_road</span>
                            </div>
                            <h3 class="mt-5 text-2xl font-black text-slate-900">No active rides in the database yet</h3>
                            <p class="mt-3 text-slate-500">Publish a ride to populate your pipeline, reservations, comments, and revenue tracking.</p>
                            <a class="mt-6 inline-flex items-center gap-2 rounded-2xl brand-gradient px-6 py-3 text-sm font-bold text-white" href="{{ route('driver.offer-ride.create') }}">
                                <span class="material-symbols-outlined text-base">add</span>
                                Create ride
                            </a>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="rounded-[28px] border border-slate-100 bg-white p-5 sm:p-6 card-shadow">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <span class="inline-flex rounded-full bg-slate-100 px-4 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-600">Ride history</span>
                        <h2 class="mt-3 text-2xl font-black tracking-tight">Recent database history</h2>
                        <p class="mt-1 text-sm text-slate-500">Recent ride records kept short and readable.</p>
                    </div>
                    <a class="text-sm font-bold text-rose-500 hover:underline" href="{{ route('driver.history') }}">Full ride history</a>
                </div>

                <div class="mt-6 grid gap-3 lg:grid-cols-2">
                    @forelse($recentRideHistory as $ride)
                        @php
                            $confirmedReservations = $ride->reservations->where('statut', \App\Models\Reservation::STATUS_CONFIRMED);
                            $confirmedSeats = $confirmedReservations->sum('nb_places');
                            $historyRevenue = $ride->prix * $confirmedSeats;
                        @endphp
                        <article class="rounded-[24px] border border-slate-100 bg-slate-50/70 p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">RW-{{ $ride->id }}</p>
                                    <h3 class="mt-2 text-lg font-black text-slate-900">{{ $ride->depart }} <span class="text-rose-500">&rarr;</span> {{ $ride->destination }}</h3>
                                </div>
                                <span class="rounded-full bg-white px-3 py-1 text-[10px] font-bold uppercase tracking-[0.18em] text-slate-500">{{ $ride->date->format('d M Y') }}</span>
                            </div>
                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <div class="rounded-2xl border border-slate-100 bg-white p-3">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Bookings</p>
                                    <p class="mt-1 text-base font-black text-slate-900">{{ $ride->reservations->count() }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-100 bg-white p-3">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Confirmed seats</p>
                                    <p class="mt-1 text-base font-black text-slate-900">{{ $confirmedSeats }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-100 bg-white p-3">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Comments</p>
                                    <p class="mt-1 text-base font-black text-slate-900">{{ $ride->comments->count() }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-100 bg-white p-3">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Revenue</p>
                                    <p class="mt-1 text-base font-black text-slate-900">${{ number_format($historyRevenue, 2) }}</p>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 px-8 py-10 text-center lg:col-span-2">
                            <p class="text-lg font-bold text-slate-900">Ride history will appear once you publish trips.</p>
                            <p class="mt-2 text-sm text-slate-500">This section is reserved for persisted ride records, not placeholder content.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <div class="space-y-6 xl:col-span-4">
            <section class="rounded-[28px] border border-slate-100 bg-white p-5 sm:p-6 card-shadow">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <span class="inline-flex rounded-full bg-rose-50 px-4 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-rose-600">Reservation queue</span>
                        <h2 class="mt-3 text-2xl font-black tracking-tight">Pending approvals</h2>
                    </div>
                    <span class="rounded-full bg-slate-900 px-3 py-1 text-xs font-bold text-white">{{ $pendingRequests->count() }}</span>
                </div>

                <div class="mt-6 space-y-3 max-h-[480px] overflow-y-auto pr-1">
                    @forelse($pendingRequests as $reservation)
                        <article class="rounded-[22px] border border-rose-100 bg-white p-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-sm font-black text-slate-700 border border-slate-100">
                                    {{ strtoupper(substr($reservation->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $reservation->user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $reservation->nb_places }} seat(s) requested</p>
                                </div>
                            </div>
                            <div class="mt-3 rounded-2xl bg-rose-50 p-3 border border-rose-100">
                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Ride</p>
                                <p class="mt-1 text-sm font-semibold text-slate-700">{{ $reservation->trajet->depart }} &rarr; {{ $reservation->trajet->destination }}</p>
                                <p class="mt-1 text-xs text-slate-500">Requested on {{ $reservation->date_reservation?->format('d M Y') ?? 'N/A' }}</p>
                            </div>
                            <div class="mt-3 flex gap-2">
                                <form action="{{ route('driver.reservations.accept', $reservation) }}" class="flex-1" method="POST">
                                    @csrf
                                    <button class="w-full rounded-xl brand-gradient px-4 py-2.5 text-xs font-bold text-white" type="submit">Accept</button>
                                </form>
                                <form action="{{ route('driver.reservations.reject', $reservation) }}" class="flex-1" method="POST">
                                    @csrf
                                    <button class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-600" type="submit">Decline</button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center">
                            <p class="text-lg font-bold text-slate-900">No pending requests</p>
                            <p class="mt-2 text-sm text-slate-500">New reservation approvals will be listed here as soon as passengers submit them.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="rounded-[28px] border border-slate-100 bg-white p-5 sm:p-6 card-shadow">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <span class="inline-flex rounded-full bg-slate-100 px-4 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-600">Messages and comments</span>
                        <h2 class="mt-3 text-2xl font-black tracking-tight">Recent conversation feed</h2>
                    </div>
                    <span class="text-xs font-bold text-slate-400">{{ $recentComments->count() }} latest</span>
                </div>

                <div class="mt-6 space-y-3 max-h-[480px] overflow-y-auto pr-1">
                    @forelse($recentComments as $comment)
                        <article class="rounded-[22px] border border-amber-100 bg-white p-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-white text-sm font-black text-slate-700 border border-slate-100">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-bold text-slate-900">{{ $comment->user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-slate-700">{{ $comment->body }}</p>
                            <div class="mt-3 rounded-2xl bg-slate-50 p-3 border border-slate-100">
                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">
                                    {{ $comment->parent_id ? 'Reply on ride thread' : 'Ride thread' }}
                                </p>
                                <p class="mt-1 text-sm font-semibold text-slate-700">{{ $comment->trajet->depart }} &rarr; {{ $comment->trajet->destination }}</p>
                                @if ($comment->parent)
                                    <p class="mt-1 text-xs text-slate-500">Replying to {{ $comment->parent->user->name ?? 'previous comment' }}</p>
                                @endif
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center">
                            <p class="text-lg font-bold text-slate-900">No message records yet</p>
                            <p class="mt-2 text-sm text-slate-500">Ride comment threads from passengers and drivers will surface here automatically.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </section>

    <section class="mt-6 grid gap-6 lg:grid-cols-2">
        <section class="rounded-[28px] border border-slate-100 bg-white p-5 sm:p-6 card-shadow">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-slate-100 px-4 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-600">Fleet registry</span>
                    <h2 class="mt-3 text-2xl font-black tracking-tight">Vehicles tied to your account</h2>
                    <p class="mt-1 text-sm text-slate-500">Compact fleet records with the original dashboard palette.</p>
                </div>
                <a class="text-sm font-bold text-rose-500 hover:underline" href="{{ route('driver.fleet') }}">Manage fleet</a>
            </div>

            <div class="mt-6 grid gap-3">
                @forelse($vehicles as $vehicle)
                    <article class="rounded-[24px] border border-slate-100 bg-slate-50/70 p-4">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl brand-gradient text-sm font-black uppercase text-white shadow-lg shadow-rose-500/10">
                                    {{ strtoupper(substr($vehicle->marque, 0, 3)) }}
                                </div>
                                <div>
                                    <h3 class="text-base font-black text-slate-900">{{ $vehicle->marque }} {{ $vehicle->modele }}</h3>
                                    <p class="mt-1 text-xs text-slate-500">{{ $vehicle->annee }} model year{{ $vehicle->couleur ? ' - '.$vehicle->couleur : '' }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.16em] text-emerald-600">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                Registered
                            </span>
                        </div>
                        <div class="mt-4 grid grid-cols-2 gap-2">
                            <div class="rounded-2xl bg-white p-3 border border-slate-100">
                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Plate</p>
                                <p class="mt-1 text-sm font-bold text-slate-900">{{ $vehicle->immatriculation }}</p>
                            </div>
                            <div class="rounded-2xl bg-white p-3 border border-slate-100">
                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Seats</p>
                                <p class="mt-1 text-sm font-bold text-slate-900">{{ $vehicle->places }}</p>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center">
                        <p class="text-lg font-bold text-slate-900">No fleet entries yet</p>
                        <p class="mt-2 text-sm text-slate-500">Add a vehicle so rides can be tied to a clear fleet record.</p>
                        <a class="mt-6 inline-flex items-center gap-2 rounded-2xl brand-gradient px-6 py-3 text-sm font-bold text-white" href="{{ route('driver.fleet') }}">
                            <span class="material-symbols-outlined text-base">directions_car</span>
                            Open fleet
                        </a>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="rounded-[28px] border border-slate-100 bg-white p-5 sm:p-6 card-shadow">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-rose-50 px-4 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-rose-600">Review signals</span>
                    <h2 class="mt-3 text-2xl font-black tracking-tight">Recent passenger feedback</h2>
                    <p class="mt-1 text-sm text-slate-500">Reviews stay compact and visible in the same dashboard style.</p>
                </div>
                <div class="rounded-2xl bg-slate-950 px-4 py-3 text-white">
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Average rating</p>
                    <div class="mt-2 flex items-center gap-2">
                        <p class="text-2xl font-black">{{ $stats['rating'] }}</p>
                        <span class="material-symbols-outlined text-amber-400" style='font-variation-settings: "FILL" 1;'>star</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-3 max-h-[420px] overflow-y-auto pr-1">
                @forelse($recentReviews as $review)
                    <article class="rounded-[22px] border border-slate-100 bg-slate-50/70 p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-bold text-slate-900">{{ $review->reservation->user->name ?? 'Passenger' }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ optional($review->created_at)->diffForHumans() }}</p>
                            </div>
                            <div class="inline-flex items-center gap-1 rounded-full bg-white px-3 py-1 text-xs font-bold text-slate-700 border border-slate-100">
                                <span class="material-symbols-outlined text-amber-400 text-base" style='font-variation-settings: "FILL" 1;'>star</span>
                                {{ number_format($review->note, 1) }}
                            </div>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-slate-700">{{ $review->commentaire }}</p>
                        @if ($review->reservation?->trajet)
                            <div class="mt-3 rounded-2xl bg-white p-3 border border-slate-100">
                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-400">Related ride</p>
                                <p class="mt-1 text-sm font-semibold text-slate-700">{{ $review->reservation->trajet->depart }} &rarr; {{ $review->reservation->trajet->destination }}</p>
                            </div>
                        @endif
                    </article>
                @empty
                    <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 px-6 py-12 text-center">
                        <p class="text-lg font-bold text-slate-900">No reviews yet</p>
                        <p class="mt-2 text-sm text-slate-500">Passenger reviews will appear here once completed reservations start receiving feedback.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </section>
</main>

@include('driver.partials.footer')
@include('partials.theme-toggle-script')
</body>
</html>

