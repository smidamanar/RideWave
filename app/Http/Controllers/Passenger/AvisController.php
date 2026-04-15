<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Reservation;

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
        // 🔐 Vérifier auth
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // ✅ Validation
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string',
            'reservation_id' => 'required|exists:reservations,id'
        ]);

        // 🔍 vérifier réservation
        $reservation = Reservation::find($request->reservation_id);

        if (!$reservation) {
            return response()->json(['error' => 'Réservation introuvable'], 404);
        }

        // 🚫 éviter doublon
        if (Avis::where('reservation_id', $reservation->id)->exists()) {
            return response()->json(['error' => 'Avis déjà ajouté'], 400);
        }

        // ✅ créer avis
        $avis = Avis::create([
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'reservation_id' => $reservation->id
        ]);

        return response()->json([
            'message' => 'Avis ajouté avec succès',
            'avis' => $avis
        ], 201);
    }
}