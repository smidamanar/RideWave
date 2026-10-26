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
        $user = $request->user();
        abort_unless($user->isDriver(), 403);

        $data = $request->validate([
            'depart' => 'required|string|max:255',
            'destination' => 'required|string|max:255|different:depart',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required|date_format:H:i',
            'prix' => 'required|numeric|min:0',
            'nbPlaces' => 'required|integer|min:1',
        ]);

        $trajet = Trajet::create([
            'conducteur_id' => $user->id,
            'depart' => $data['depart'],
            'destination' => $data['destination'],
            'date' => $data['date'],
            'heure' => $data['heure'],
            'prix' => $data['prix'],
            'nb_places' => $data['nbPlaces'],
        ]);

        return response()->json($trajet, 201);
    }
}
