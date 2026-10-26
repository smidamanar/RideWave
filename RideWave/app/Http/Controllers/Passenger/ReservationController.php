<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->reservations()->with('trajet')->get()
        );
    }

    public function store(Request $request)
    {
        $user = $request->user();
        abort_unless($user->isPassenger(), 403);

        $data = $request->validate([
            'trajet_id' => 'required|integer|exists:trajets,id',
            'nbPlaces' => 'required|integer|min:1',
            'date_reservation' => 'required|date|after_or_equal:today',
        ]);

        $reservation = DB::transaction(function () use ($data, $user) {
            $trajet = Trajet::query()->lockForUpdate()->findOrFail($data['trajet_id']);

            abort_unless($trajet->valide, 404);
            abort_unless($trajet->conducteur_id !== $user->id, 403);

            $hasExistingRequest = $trajet->reservations()
                ->where('user_id', $user->id)
                ->whereIn('statut', [Reservation::STATUS_PENDING, Reservation::STATUS_CONFIRMED])
                ->exists();

            if ($hasExistingRequest) {
                throw ValidationException::withMessages([
                    'trajet_id' => ['You already have an active request for this ride.'],
                ]);
            }

            $reservedSeats = $trajet->reservations()
                ->confirmed()
                ->sum('nb_places');
            $availableSeats = max(0, $trajet->nb_places - $reservedSeats);

            if ($data['nbPlaces'] > $availableSeats) {
                throw ValidationException::withMessages([
                    'nbPlaces' => ['Not enough seats are available for this ride.'],
                ]);
            }

            return Reservation::create([
                'user_id' => $user->id,
                'trajet_id' => $trajet->id,
                'date_reservation' => $data['date_reservation'],
                'nb_places' => $data['nbPlaces'],
                'statut' => Reservation::STATUS_PENDING,
            ]);
        });

        return response()->json([
            'message' => 'Ride request sent successfully.',
            'reservation' => $reservation,
        ], 201);
    }

    public function destroy(Request $request, string $id)
    {
        abort_unless($request->user()->isPassenger(), 403);

        $reservation = $request->user()->reservations()->findOrFail($id);
        abort_unless(
            in_array($reservation->statut, [Reservation::STATUS_PENDING, Reservation::STATUS_CONFIRMED], true),
            403
        );
        $reservation->delete();

        return response()->json(['message' => 'Reservation cancelled successfully.']);
    }
}
