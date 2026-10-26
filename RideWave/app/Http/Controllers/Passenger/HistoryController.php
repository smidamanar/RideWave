<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Reservation;
use App\Models\RideComment;
use App\Notifications\RideReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $reservations = Reservation::with(['trajet.conducteur', 'trajet.vehicule', 'avis'])
            ->where('user_id', $user->id)
            ->where('statut', '!=', Reservation::STATUS_CANCELLED)
            ->latest('date_reservation')
            ->get();

        $completedReservations = $reservations
            ->filter(fn (Reservation $reservation) => $this->reservationRideHasCompleted($reservation))
            ->values();

        $commentHistory = RideComment::with(['trajet.conducteur', 'parent.user'])
            ->where('user_id', $user->id)
            ->whereHas('trajet.reservations', function ($query) use ($user) {
                $query
                    ->where('user_id', $user->id)
                    ->where('statut', Reservation::STATUS_CONFIRMED);
            })
            ->latest()
            ->get();

        return view('passenger.history', [
            'reservations' => $reservations,
            'completedReservations' => $completedReservations,
            'commentHistory' => $commentHistory,
            'stats' => [
                'total_reservations' => $reservations->count(),
                'completed_rides' => $completedReservations->count(),
                'comments_posted' => $commentHistory->count(),
                'reviews_submitted' => $completedReservations->filter(fn (Reservation $reservation) => $reservation->avis !== null)->count(),
            ],
        ]);
    }

    public function storeReview(Request $request, Reservation $reservation)
    {
        $passenger = $request->user();

        abort_unless($reservation->user_id === $passenger->id, 403);

        $reservation->loadMissing('trajet.conducteur', 'user', 'avis');

        if ($reservation->avis) {
            return back()->with('error', 'You already submitted a review for this ride.');
        }

        if ($reservation->statut !== Reservation::STATUS_CONFIRMED || !$this->reservationRideHasCompleted($reservation)) {
            return back()->with('error', 'You can review only confirmed rides that are already completed.');
        }

        $data = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $avis = Avis::create([
            'reservation_id' => $reservation->id,
            'note' => $data['note'],
            'commentaire' => $data['commentaire'] ?? null,
        ]);

        $avis->load('reservation.trajet.conducteur', 'reservation.user');

        if ($reservation->trajet?->conducteur && $reservation->trajet->conducteur->id !== $passenger->id) {
            $reservation->trajet->conducteur->notify(new RideReviewNotification($avis));
        }

        return back()->with('success', 'Review submitted successfully.');
    }

    private function reservationRideHasCompleted(Reservation $reservation): bool
    {
        $ride = $reservation->trajet;

        if (!$ride || !$ride->date) {
            return false;
        }

        $time = filled($ride->heure) ? substr((string) $ride->heure, 0, 5) : '00:00';
        $rideDateTime = Carbon::parse($ride->date->format('Y-m-d').' '.$time);

        return $rideDateTime->lte(now());
    }
}
