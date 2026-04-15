<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReservationWebController extends Controller
{
    public function index(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();

        $trajets = Trajet::where('nb_places', '>', 0)->get();
        $reservations = $user?->reservations()->with(['trajet.conducteur.vehicules', 'avis'])->get() ?? collect();
        $selectedTrajetId = $request->query('trajet_id');

        return view('reservations.index', compact('trajets', 'reservations', 'selectedTrajetId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trajet_id' => 'required|exists:trajets,id',
            'nb_places' => 'required|integer|min:1',
            'date_reservation' => 'required|date',
        ]);

        $trajet = Trajet::find($request->trajet_id);

        if (!$trajet) {
            return back()->withErrors(['trajet_id' => 'Trajet introuvable'])->withInput();
        }

        if ($trajet->nb_places < $request->nb_places) {
            return back()->withErrors(['nb_places' => 'Il n’y a pas assez de places disponibles'])->withInput();
        }

        DB::transaction(function () use ($trajet, $request) {
            $trajet->decrement('nb_places', $request->nb_places);

            $trajet->reservations()->create([
                'user_id' => Auth::id(),
                'date_reservation' => $request->date_reservation,
                'nb_places' => $request->nb_places,
                'statut' => 'confirmée',
            ]);
        });

        return redirect()->route('reservations.index')->with('success', 'Réservation enregistrée avec succès.');
    }

    public function destroy($id)
    {
        /** @var User|null $user */
        $user = Auth::user();
        $reservation = $user?->reservations()->find($id);

        if (!$reservation) {
            return redirect()->route('reservations.index')->withErrors(['reservation' => 'Réservation introuvable']);
        }

        $trajet = $reservation->trajet;
        if ($trajet) {
            $trajet->nb_places += $reservation->nb_places;
            $trajet->save();
        }

        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation annulée avec succès.');
    }
}
