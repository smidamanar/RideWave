<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Trajet;

class ReservationController extends Controller
{
    // 🔹 Voir toutes les réservations
    public function index()
    {
        return response()->json(
            Reservation::with('trajet')->get()
        );
    }

    // 🔹 Créer réservation
    public function store(Request $request)
    {
        // 🔐 Vérifier authentification
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // ✅ Validation
        $request->validate([
            'trajet_id' => 'required|exists:trajets,id',
            'nbPlaces' => 'required|integer|min:1',
            'date_reservation' => 'required|date'
        ]);

        // 🔍 Récupérer trajet
        $trajet = Trajet::find($request->trajet_id);

        if (!$trajet) {
            return response()->json(['error' => 'Trajet introuvable'], 404);
        }

        // 🚫 Vérifier places disponibles
        if ($trajet->nb_places < $request->nbPlaces) {
            return response()->json(['error' => 'Places insuffisantes'], 400);
        }

        // ➖ Décrémenter les places
        $trajet->nb_places -= $request->nbPlaces;
        $trajet->save();

        // 🧾 Créer réservation
        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'trajet_id' => $trajet->id,
            'date_reservation' => $request->date_reservation,
            'nb_places' => $request->nbPlaces,
            'statut' => 'confirmée',
        ]);

        // 📤 Retour propre (évite bugs JSON)
        return response()->json([
            'message' => 'Réservation créée avec succès',
            'reservation' => [
                'id' => $reservation->id,
                'trajet_id' => $reservation->trajet_id,
                'nb_places' => $reservation->nb_places,
                'statut' => $reservation->statut
            ]
        ], 201);
    }

    // ❌ Annuler réservation
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Réservation introuvable'], 404);
        }

        // 🔄 Récupérer trajet
        $trajet = $reservation->trajet;

        if ($trajet) {
            // ➕ Re-ajouter les places
            $trajet->nb_places += $reservation->nb_places;
            $trajet->save();
        }

        // 🗑️ Supprimer réservation
        $reservation->delete();

        return response()->json([
            'message' => 'Réservation annulée avec succès'
        ]);
    }
}