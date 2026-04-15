<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Trajet;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // Statistiques pour le conducteur
        $trajetsPublies = $user->trajets()->count();
        $reservationsRecues = Reservation::whereHas('trajet', function($query) use ($user) {
            $query->where('conducteur_id', $user->id);
        })->count();
        $placesOccupees = Reservation::whereHas('trajet', function($query) use ($user) {
            $query->where('conducteur_id', $user->id);
        })->sum('nb_places');

        // Statistiques pour le passager
        $reservationsFaites = $user->reservations()->count();
        $trajetsReserves = $user->reservations()->with('trajet')->get();

        // Avis reçus (si conducteur)
        $avisRecus = 0;
        $noteMoyenne = 0;
        if ($user->isConducteur()) {
            $avisRecus = \App\Models\Avis::whereHas('reservation.trajet', function($query) use ($user) {
                $query->where('conducteur_id', $user->id);
            })->count();

            $noteMoyenne = \App\Models\Avis::whereHas('reservation.trajet', function($query) use ($user) {
                $query->where('conducteur_id', $user->id);
            })->avg('note') ?? 0;
        }

        return view('dashboard.index', compact(
            'trajetsPublies',
            'reservationsRecues',
            'placesOccupees',
            'reservationsFaites',
            'trajetsReserves',
            'avisRecus',
            'noteMoyenne'
        ));
    }
}