<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Reservation;
use App\Notifications\RideReviewNotification;

class AvisController extends Controller
{
    public function index()
    {
        return response()->json(
            Avis::with('reservation')->get()
        );
    }

    public function store(Request $request)
    {
        $user = $request->user();
        abort_unless($user->isPassenger(), 403);

        $data = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:5000',
            'reservation_id' => 'required|integer|exists:reservations,id',
        ]);

        $reservation = $user->reservations()->with('trajet')->findOrFail($data['reservation_id']);
        abort_unless(
            $reservation->statut === Reservation::STATUS_CONFIRMED
                && $reservation->trajet?->date?->isPast(),
            403
        );

        if (Avis::where('reservation_id', $reservation->id)->exists()) {
            return response()->json(['error' => 'A review has already been submitted.'], 409);
        }

        $avis = Avis::create([
            'note' => $data['note'],
            'commentaire' => $data['commentaire'],
            'reservation_id' => $reservation->id,
        ]);

        $avis->load('reservation.trajet.conducteur', 'reservation.user');

        if ($reservation->trajet?->conducteur) {
            $reservation->trajet->conducteur->notify(new RideReviewNotification($avis));
        }

        return response()->json(['message' => 'Review added successfully.', 'avis' => $avis], 201);
    }
}
