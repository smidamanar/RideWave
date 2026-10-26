<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Driver History | RideWave</title>
    <meta content="#ffffff" name="theme-color"/>
    @include('partials.theme-init')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at 6% 8%, rgba(242, 109, 93, 0.2), transparent 34%),
                radial-gradient(circle at 90% 18%, rgba(248, 46, 110, 0.16), transparent 32%),
                linear-gradient(180deg, #fffaf7 0%, #ffffff 54%, #fff7f3 100%);
        }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 450, 'GRAD' 0, 'opsz' 24; }
        .brand-gradient { background: linear-gradient(135deg, #f26d5d 0%, #f82e6e 100%); }
        .surface-card {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            border-radius: 1.5rem;
            box-shadow: 0 22px 50px -32px rgba(15, 23, 42, 0.2);
        }
        .horizontal-history {
            scrollbar-width: thin;
            scrollbar-color: rgba(15, 23, 42, 0.24) transparent;
        }
        .horizontal-history::-webkit-scrollbar {
            height: 8px;
        }
        .horizontal-history::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.24);
        }
        .horizontal-history::-webkit-scrollbar-track {
            background: transparent;
        }

        html.dark body.driver-history-page {
            background:
                radial-gradient(circle at 8% 6%, rgba(244, 63, 94, 0.12), transparent 34%),
                radial-gradient(circle at 92% 16%, rgba(15, 23, 42, 0.88), transparent 30%),
                linear-gradient(180deg, #08111f 0%, #0b1220 55%, #08111f 100%);
        }

        html.dark .driver-history-page .surface-card {
            border-color: rgba(148, 163, 184, 0.2);
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 24px 58px rgba(2, 6, 23, 0.56);
        }
        html.dark .driver-history-page .horizontal-history::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.42);
        }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="driver-history-page text-slate-900">
@include('driver.partials.navbar', ['active' => 'history'])

@php
    $rides = $rides ?? collect();
    $totalRides = $rides->count();
    $totalSeats = $rides->sum(fn ($ride) => $ride->reservations->where('statut', \App\Models\Reservation::STATUS_CONFIRMED)->sum('nb_places'));
    $totalRevenue = $rides->sum(fn ($ride) => $ride->prix * $ride->reservations->where('statut', \App\Models\Reservation::STATUS_CONFIRMED)->sum('nb_places'));
    $reservations = $reservations ?? collect();
    $completedReservations = $completedReservations ?? collect();
    $commentHistory = $commentHistory ?? collect();
    $passengerStats = $passengerStats ?? [
        'total_reservations' => 0,
        'completed_rides' => 0,
        'comments_posted' => 0,
        'reviews_submitted' => 0,
    ];
    $isHorizontalCompleted = $completedReservations->count() > 1;
    $isHorizontalComments = $commentHistory->count() > 1;
    $isHorizontalReservations = $reservations->count() > 1;
@endphp

<main class="mx-auto max-w-screen-2xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
    <section class="mb-8">
        <span class="inline-flex rounded-full bg-rose-50 px-4 py-1.5 text-[10px] font-bold uppercase tracking-[0.2em] text-rose-600">History</span>
        <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">Your ride history only.</h1>
        <p class="mt-3 max-w-3xl text-base text-slate-500">This page is fully dedicated to completed ride history, with performance details for each past route.</p>
    </section>

    <section class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-3">
        <article class="surface-card p-5">
            <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Past Rides</p>
            <p class="mt-2 text-3xl font-black text-slate-900">{{ $totalRides }}</p>
        </article>
        <article class="surface-card p-5">
            <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Confirmed Seats</p>
            <p class="mt-2 text-3xl font-black text-slate-900">{{ $totalSeats }}</p>
        </article>
        <article class="surface-card p-5">
            <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Total Earnings</p>
            <p class="mt-2 text-3xl font-black text-slate-900">{{ number_format($totalRevenue, 2) }}</p>
        </article>
    </section>

    <section class="grid gap-5">
        @forelse ($rides as $ride)
            @php
                $confirmedReservations = $ride->reservations->where('statut', \App\Models\Reservation::STATUS_CONFIRMED);
                $confirmedSeats = $confirmedReservations->sum('nb_places');
                $rideRevenue = $ride->prix * $confirmedSeats;
                $statusLabel = $confirmedSeats > 0 ? 'Completed' : 'No bookings';
                $statusClass = $confirmedSeats > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500';
                $averageRating = $ride->reservations->pluck('avis.note')->filter()->avg();
            @endphp
            <article class="surface-card p-6 sm:p-7">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                    <div>
                        <div class="mb-3 flex flex-wrap items-center gap-2">
                            <span class="rounded-full bg-rose-50 px-3 py-1 text-[10px] font-black uppercase tracking-[0.14em] text-rose-600">RW-{{ $ride->id }}</span>
                            <span class="rounded-full px-3 py-1 text-[10px] font-black uppercase tracking-[0.14em] {{ $statusClass }}">{{ $statusLabel }}</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-900">{{ $ride->depart }} <span class="text-rose-500">to</span> {{ $ride->destination }}</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ $ride->date->format('d M Y') }} at {{ $ride->heure }}</p>
                    </div>

                    <div class="grid min-w-[260px] grid-cols-2 gap-3 sm:min-w-[340px]">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-3.5">
                            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Seats</p>
                            <p class="mt-1 text-sm font-bold text-slate-900">{{ $confirmedSeats }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-3.5">
                            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Earnings</p>
                            <p class="mt-1 text-sm font-bold text-slate-900">{{ number_format($rideRevenue, 2) }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-3.5">
                            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Reservations</p>
                            <p class="mt-1 text-sm font-bold text-slate-900">{{ $confirmedReservations->count() }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-3.5">
                            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Avg Rating</p>
                            <p class="mt-1 text-sm font-bold text-slate-900">{{ $averageRating ? number_format($averageRating, 1) : 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5 border-t border-slate-100 pt-4">
                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Passengers</p>
                    <p class="mt-2 text-sm text-slate-600">
                        {{ $confirmedReservations->pluck('user.name')->filter()->implode(', ') ?: 'No confirmed passengers.' }}
                    </p>
                </div>
            </article>
        @empty
            <article class="surface-card px-8 py-12 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-rose-50 text-rose-500">
                    <span class="material-symbols-outlined text-3xl">history</span>
                </div>
                <h3 class="mt-4 text-2xl font-black text-slate-900">No ride history yet</h3>
                <p class="mt-2 text-sm text-slate-500">Once your rides are completed, they will appear here.</p>
                <a class="brand-gradient mt-5 inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-black text-white" href="{{ route('driver.offer-ride.create') }}">
                    <span class="material-symbols-outlined text-base">add_road</span>
                    Offer a Ride
                </a>
            </article>
        @endforelse
    </section>

    <section class="mb-8 mt-10">
        <span class="inline-flex rounded-full bg-rose-50 px-4 py-1.5 text-[10px] font-bold uppercase tracking-[0.2em] text-rose-600">Passenger Activity</span>
        <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Your activity as a passenger</h2>
        <p class="mt-2 max-w-3xl text-base text-slate-500">Drivers can also join rides as passengers. This section mirrors passenger history with reservations, comments, and reviews.</p>
    </section>

    <section class="mb-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <article class="surface-card p-5">
            <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Reservations</p>
            <p class="mt-2 text-3xl font-black text-slate-900">{{ $passengerStats['total_reservations'] }}</p>
        </article>
        <article class="surface-card p-5">
            <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Completed rides</p>
            <p class="mt-2 text-3xl font-black text-slate-900">{{ $passengerStats['completed_rides'] }}</p>
        </article>
        <article class="surface-card p-5">
            <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Comments posted</p>
            <p class="mt-2 text-3xl font-black text-slate-900">{{ $passengerStats['comments_posted'] }}</p>
        </article>
        <article class="surface-card p-5">
            <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Reviews submitted</p>
            <p class="mt-2 text-3xl font-black text-slate-900">{{ $passengerStats['reviews_submitted'] }}</p>
        </article>
    </section>

    <section class="mb-8 surface-card p-6 lg:p-8">
        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight">Rides you completed (as passenger)</h2>
                <p class="mt-2 text-sm text-slate-500">Confirmed rides that already happened. You can submit one review per ride.</p>
            </div>
            <p class="text-sm font-semibold text-slate-500">{{ $completedReservations->count() }} completed</p>
        </div>

        <div class="{{ $isHorizontalCompleted ? 'horizontal-history -mx-1 flex gap-3 overflow-x-auto px-1 pb-2' : 'grid gap-4' }}">
            @forelse ($completedReservations as $reservation)
                <article class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 {{ $isHorizontalCompleted ? 'snap-start shrink-0 w-[calc(100%-0.25rem)] sm:w-[430px] lg:w-[470px]' : '' }}">
                    <div class="space-y-4">
                        <div>
                            <div class="mb-2 flex flex-wrap items-center gap-2">
                                <span class="rounded-full bg-rose-50 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.16em] text-rose-600">{{ str_replace('_', ' ', $reservation->statut) }}</span>
                                <span class="text-xs font-semibold text-slate-400">Booked on {{ $reservation->date_reservation?->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-lg font-black text-slate-900">{{ $reservation->trajet->depart }} <span class="text-rose-500">&rarr;</span> {{ $reservation->trajet->destination }}</h3>
                            <p class="mt-1 text-xs font-medium text-slate-500">{{ $reservation->trajet->date?->format('d M Y') }} at {{ substr((string) $reservation->trajet->heure, 0, 5) }}</p>

                            <div class="mt-3 grid grid-cols-3 gap-2.5">
                                <div class="rounded-xl border border-slate-100 bg-white p-2.5">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Driver</p>
                                    <p class="mt-1 text-xs font-bold text-slate-900 truncate">{{ $reservation->trajet->conducteur->name ?? 'Unknown' }}</p>
                                </div>
                                <div class="rounded-xl border border-slate-100 bg-white p-2.5">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Seats</p>
                                    <p class="mt-1 text-xs font-bold text-slate-900">{{ $reservation->nb_places }}</p>
                                </div>
                                <div class="rounded-xl border border-slate-100 bg-white p-2.5">
                                    <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Price paid</p>
                                    <p class="mt-1 text-xs font-bold text-slate-900">{{ number_format($reservation->nb_places * ($reservation->trajet->prix ?? 0), 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl border border-slate-100 bg-white p-3">
                            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">Your review</p>

                            @if ($reservation->avis)
                                <div class="mt-2 rounded-xl border border-emerald-100 bg-emerald-50 p-2.5">
                                    <p class="text-xs font-black text-emerald-700">{{ $reservation->avis->note }}/5</p>
                                    <p class="mt-1 text-xs text-emerald-800">{{ $reservation->avis->commentaire ?: 'No comment provided.' }}</p>
                                    <p class="mt-2 text-[11px] font-semibold text-emerald-700">Submitted {{ $reservation->avis->created_at?->diffForHumans() }}</p>
                                </div>
                            @else
                                <form action="{{ route('driver.history.reviews.store', $reservation) }}" class="mt-2 space-y-2.5" method="POST">
                                    @csrf
                                    <div>
                                        <label class="mb-1 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="driver-note-{{ $reservation->id }}"><span class="text-rose-500">*</span> Rating</label>
                                        <select class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-900" id="driver-note-{{ $reservation->id }}" name="note" required>
                                            <option value="">Select</option>
                                            @for ($star = 5; $star >= 1; $star--)
                                                <option value="{{ $star }}">{{ $star }} / 5</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-xs font-bold uppercase tracking-[0.16em] text-slate-400" for="driver-commentaire-{{ $reservation->id }}">Comment</label>
                                        <textarea class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800" id="driver-commentaire-{{ $reservation->id }}" name="commentaire" rows="2" placeholder="How was your ride experience?"></textarea>
                                    </div>
                                    <button class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-[#F26D5D] to-[#F82E6E] px-3.5 py-2 text-xs font-bold text-white" type="submit">
                                        <span class="material-symbols-outlined text-base">star</span>
                                        Submit review
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center">
                    <p class="text-lg font-black text-slate-900">No completed passenger rides yet</p>
                    <p class="mt-2 text-sm text-slate-500">Once a confirmed ride is completed, it appears here and can be reviewed.</p>
                </div>
            @endforelse
        </div>
    </section>

    <section class="mb-8 surface-card p-6 lg:p-8">
        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight">Your comments history</h2>
                <p class="mt-2 text-sm text-slate-500">Messages you posted on rides you joined.</p>
            </div>
            <p class="text-sm font-semibold text-slate-500">{{ $commentHistory->count() }} comments</p>
        </div>

        <div class="{{ $isHorizontalComments ? 'horizontal-history -mx-1 flex gap-3 overflow-x-auto px-1 pb-2' : 'grid gap-4' }}">
            @forelse ($commentHistory as $comment)
                <article class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 {{ $isHorizontalComments ? 'snap-start shrink-0 w-[calc(100%-0.25rem)] sm:w-[420px] lg:w-[460px]' : '' }}">
                    <div class="mb-2 flex flex-wrap items-center gap-2">
                        <span class="rounded-full bg-slate-900 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.16em] text-white">{{ $comment->parent_id ? 'Reply' : 'Comment' }}</span>
                        <span class="text-xs font-semibold text-slate-400">{{ $comment->created_at?->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm font-bold text-slate-900">{{ $comment->trajet->depart ?? 'Unknown' }} <span class="text-rose-500">&rarr;</span> {{ $comment->trajet->destination ?? 'Unknown' }}</p>
                    <p class="mt-1 text-xs font-semibold text-slate-500">Driver: {{ $comment->trajet->conducteur->name ?? 'Unknown' }}</p>
                    <p class="mt-3 rounded-xl border border-slate-100 bg-white px-4 py-3 text-sm leading-6 text-slate-700">{{ $comment->body }}</p>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center">
                    <p class="text-lg font-black text-slate-900">No comments yet</p>
                    <p class="mt-2 text-sm text-slate-500">Your ride comments will appear here after you start conversations with drivers.</p>
                </div>
            @endforelse
        </div>
    </section>

    <section class="surface-card p-6 lg:p-8">
        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight">Reservation timeline</h2>
                <p class="mt-2 text-sm text-slate-500">All your non-cancelled reservations.</p>
            </div>
            <p class="text-sm font-semibold text-slate-500">{{ $reservations->count() }} entries</p>
        </div>

        <div class="{{ $isHorizontalReservations ? 'horizontal-history -mx-1 flex gap-3 overflow-x-auto px-1 pb-2' : 'grid gap-4' }}">
            @forelse ($reservations as $reservation)
                <article class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 {{ $isHorizontalReservations ? 'snap-start shrink-0 w-[calc(100%-0.25rem)] sm:w-[460px] lg:w-[500px]' : '' }}">
                    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400">Reserved on {{ $reservation->date_reservation?->format('d M Y') }}</p>
                            <p class="mt-1 text-lg font-black text-slate-900">{{ $reservation->trajet->depart }} <span class="text-rose-500">&rarr;</span> {{ $reservation->trajet->destination }}</p>
                            <p class="mt-1 text-sm text-slate-500">{{ $reservation->trajet->date?->format('d M Y') }} at {{ substr((string) $reservation->trajet->heure, 0, 5) }}</p>
                        </div>
                        <span class="rounded-full bg-rose-50 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.16em] text-rose-600">{{ str_replace('_', ' ', $reservation->statut) }}</span>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 py-10 text-center">
                    <p class="text-lg font-black text-slate-900">No booking history yet</p>
                    <a class="brand-gradient mt-4 inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-bold text-white" href="{{ route('driver.find-rides') }}">
                        <span class="material-symbols-outlined text-base">search</span>
                        Find rides
                    </a>
                </div>
            @endforelse
        </div>
    </section>
</main>

@include('driver.partials.footer')
@include('partials.theme-toggle-script')
</body>
</html>

