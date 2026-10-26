<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Reservation;
use App\Models\RideComment;
use App\Models\Trajet;
use App\Models\Vehicule;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $rides = Trajet::with([
                'reservations.user',
                'comments.user',
                'comments.replies.user',
            ])
            ->where('conducteur_id', $user->id)
            ->orderBy('date')
            ->orderBy('heure')
            ->get();
        $vehicles = Vehicule::where('user_id', $user->id)
            ->latest()
            ->get();
        $totalReservations = Reservation::whereHas('trajet', fn ($query) => $query->where('conducteur_id', $user->id))
            ->where('statut', Reservation::STATUS_CONFIRMED)
            ->count();
        $earnings = $rides->sum(fn ($ride) => $ride->prix * $ride->reservations->where('statut', Reservation::STATUS_CONFIRMED)->sum('nb_places'));
        $reviewsQuery = Avis::with(['reservation.user', 'reservation.trajet'])
            ->whereHas('reservation.trajet', fn ($query) => $query->where('conducteur_id', $user->id));
        $rating = $reviewsQuery->avg('note') ?? 5.0;
        $pendingRequests = Reservation::with(['user', 'trajet'])
            ->whereHas('trajet', fn ($query) => $query->where('conducteur_id', $user->id))
            ->where('statut', Reservation::STATUS_PENDING)
            ->latest()
            ->take(6)
            ->get();
        $recentComments = RideComment::with(['user', 'trajet', 'parent.user'])
            ->whereHas('trajet', fn ($query) => $query->where('conducteur_id', $user->id))
            ->latest()
            ->take(5)
            ->get();
        $totalCommentMessages = RideComment::whereHas('trajet', fn ($query) => $query->where('conducteur_id', $user->id))
            ->count();
        $recentReviews = (clone $reviewsQuery)
            ->latest()
            ->take(4)
            ->get();
        $activeRides = $rides
            ->filter(fn ($ride) => $ride->date->toDateString() >= now()->toDateString())
            ->values();
        $recentRideHistory = $rides
            ->sortByDesc(fn ($ride) => $ride->date->format('Y-m-d').' '.$ride->heure)
            ->take(4)
            ->values();

        return view('driver.dashboard', [
            'stats' => [
                'total_earnings' => $earnings,
                'total_rides' => $rides->count(),
                'rating' => number_format($rating, 1),
                'active_reservations' => $totalReservations,
                'pending_requests' => $pendingRequests->count(),
                'fleet_count' => $vehicles->count(),
                'fleet_seats' => $vehicles->sum('places'),
                'message_count' => $totalCommentMessages,
                'comment_threads' => $rides->sum(fn ($ride) => $ride->comments->count()),
                'review_count' => $reviewsQuery->count(),
            ],
            'activeRides' => $activeRides,
            'recentReservations' => Reservation::with(['user', 'trajet'])
                ->whereHas('trajet', fn ($query) => $query->where('conducteur_id', $user->id))
                ->latest()
                ->take(3)
                ->get(),
            'vehicles' => $vehicles->take(3)->values(),
            'pendingRequests' => $pendingRequests,
            'recentComments' => $recentComments,
            'recentReviews' => $recentReviews,
            'recentRideHistory' => $recentRideHistory,
        ]);
    }
}
