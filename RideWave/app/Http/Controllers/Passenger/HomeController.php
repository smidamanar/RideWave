<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Trajet;

class HomeController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        return view('passenger.home', [
            'stats' => [
                'availableRides' => Trajet::whereDate('date', '>=', now()->toDateString())->count(),
                'myBookings' => $user->reservations()->where('statut', '!=', Reservation::STATUS_REJECTED)->count(),
                'upcomingBookings' => $user->reservations()
                    ->whereHas('trajet', fn ($query) => $query->whereDate('date', '>=', now()->toDateString()))
                    ->where('statut', '!=', Reservation::STATUS_REJECTED)
                    ->count(),
            ],
            'upcomingReservations' => Reservation::with('trajet.conducteur')
                ->where('user_id', $user->id)
                ->whereHas('trajet', fn ($query) => $query->whereDate('date', '>=', now()->toDateString()))
                ->where('statut', '!=', Reservation::STATUS_REJECTED)
                ->latest('date_reservation')
                ->take(5)
                ->get(),
        ]);
    }
}
