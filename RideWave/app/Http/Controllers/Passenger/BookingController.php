<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Notifications\RideBookingRequestedNotification;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, Trajet $trajet)
    {
        $request->validate([
            'nb_places' => 'required|integer|min:1',
        ]);

        if ($trajet->conducteur_id === $request->user()->id) {
            return back()->with('error', 'You cannot book your own ride.');
        }

        $hasExistingRequest = $trajet->reservations()
            ->where('user_id', $request->user()->id)
            ->whereIn('statut', [Reservation::STATUS_PENDING, Reservation::STATUS_CONFIRMED])
            ->exists();

        if ($hasExistingRequest) {
            return back()->with('error', 'You already have an active request for this ride.');
        }

        $reservedSeats = $trajet->reservations()
            ->confirmed()
            ->sum('nb_places');

        $availableSeats = max(0, $trajet->nb_places - $reservedSeats);

        if ($request->integer('nb_places') > $availableSeats) {
            return back()->with('error', 'Not enough seats are available for this ride.');
        }

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'trajet_id' => $trajet->id,
            'date_reservation' => now()->toDateString(),
            'nb_places' => $request->integer('nb_places'),
            'statut' => Reservation::STATUS_PENDING,
        ]);

        $reservation->load(['trajet', 'user']);
        $trajet->conducteur->notify(new RideBookingRequestedNotification($reservation));

        return redirect()->route('passenger.history')->with('success', 'Ride request sent. The driver will review it before you are confirmed.');
    }
}
