<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trajet;

class TrajetController extends Controller
{
    // 🔹 Voir tous les trajets
    public function index()
    {
        return response()->json(Trajet::with('conducteur')->get());
    }

    // 🔹 Recherche trajet
    public function search(Request $request)
    {
        $query = Trajet::where('valide', true);

        if ($request->depart) {
            $query->where('depart', 'like', '%' . $request->depart . '%');
        }

        if ($request->destination) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }

        return response()->json($query->get());
    }

    // 🔹 Ajouter trajet
    public function store(Request $request)
    {
        // Vérifier utilisateur connecté
        if (!$request->user()) {
            return response()->json(['message' => 'Non authentifié'], 401);
        }

        // Validation simple
        $request->validate([
            'depart' => 'required',
            'destination' => 'required',
            'date' => 'required',
            'heure' => 'required',
            'prix' => 'required',
            'nbPlaces' => 'required'
        ]);

        // Création trajet
        $trajet = Trajet::create([
            'conducteur_id' => $request->user()->id,
            'depart' => $request->depart,
            'destination' => $request->destination,
            'date' => $request->date,
            'heure' => $request->heure,
            'prix' => $request->prix,
            'nb_places' => $request->nbPlaces
        ]);

        return response()->json($trajet, 201);
    }
}