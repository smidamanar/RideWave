<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Notifications\RideBookingStatusNotification;
use Illuminate\Http\Request;

class ReservationDecisionController extends Controller
{
    public function accept(Request $request, Reservation $reservation)
    {
        $this->authorizeReservation($request, $reservation);

        if ($reservation->statut !== Reservation::STATUS_PENDING) {
            return back()->with('error', 'This request has already been handled.');
        }

        $confirmedSeats = $reservation->trajet->reservations()
            ->confirmed()
            ->sum('nb_places');

        $availableSeats = max(0, $reservation->trajet->nb_places - $confirmedSeats);

        if ($reservation->nb_places > $availableSeats) {
            return back()->with('error', 'Not enough seats remain to accept this request.');
        }

        $reservation->update(['statut' => Reservation::STATUS_CONFIRMED]);
        $reservation->user->notify(new RideBookingStatusNotification($reservation->fresh(['trajet', 'user'])));

        return back()->with('success', 'Passenger request accepted.');
    }

    public function reject(Request $request, Reservation $reservation)
    {
        $this->authorizeReservation($request, $reservation);

        if ($reservation->statut !== Reservation::STATUS_PENDING) {
            return back()->with('error', 'This request has already been handled.');
        }

        $reservation->update(['statut' => Reservation::STATUS_REJECTED]);
        $reservation->user->notify(new RideBookingStatusNotification($reservation->fresh(['trajet', 'user'])));

        return back()->with('success', 'Passenger request declined.');
    }

    private function authorizeReservation(Request $request, Reservation $reservation): void
    {
        abort_unless($reservation->trajet && $reservation->trajet->conducteur_id === $request->user()->id, 403);
    }
}
