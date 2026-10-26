<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\Vehicule;

class HomeController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $rides = Trajet::with(['reservations.user'])
            ->where('conducteur_id', $user->id)
            ->orderBy('date')
            ->orderBy('heure')
            ->get();

        $upcomingRides = $rides
            ->filter(fn (Trajet $ride) => $ride->date->toDateString() >= now()->toDateString())
            ->values();

        $totalReservations = Reservation::whereHas('trajet', fn ($query) => $query->where('conducteur_id', $user->id))
            ->where('statut', Reservation::STATUS_CONFIRMED)
            ->count();
        $earnings = $rides->sum(fn ($ride) => $ride->prix * $ride->reservations->where('statut', Reservation::STATUS_CONFIRMED)->sum('nb_places'));
        $rating = Avis::whereHas('reservation.trajet', fn ($query) => $query->where('conducteur_id', $user->id))->avg('note') ?? 5.0;
        $pendingRequests = Reservation::with(['user', 'trajet'])
            ->whereHas('trajet', fn ($query) => $query->where('conducteur_id', $user->id))
            ->where('statut', Reservation::STATUS_PENDING)
            ->latest()
            ->take(5)
            ->get();

        return view('driver.home', [
            'stats' => [
                'total_earnings' => $earnings,
                'total_rides' => $rides->count(),
                'rating' => number_format($rating, 1),
                'active_reservations' => $totalReservations,
                'fleet_count' => Vehicule::where('user_id', $user->id)->count(),
                'pending_requests' => $pendingRequests->count(),
            ],
            'upcomingRides' => $upcomingRides->take(5),
            'recentReservations' => Reservation::with(['user', 'trajet'])
                ->whereHas('trajet', fn ($query) => $query->where('conducteur_id', $user->id))
                ->latest()
                ->take(3)
                ->get(),
            'pendingRequests' => $pendingRequests,
        ]);
    }
}
