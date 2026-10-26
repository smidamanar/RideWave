<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicule;

class VehiculeController extends Controller
{
    // 📋 Liste véhicules
    public function index()
    {
        return response()->json(Vehicule::with('user')->get());
    }

    // 🚗 Ajouter véhicule
    public function store(Request $request)
    {
        $user = $request->user();
        abort_unless($user->isDriver(), 403);

        $data = $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:vehicules,immatriculation',
        ]);

        $vehicule = $user->vehicules()->create($data);

        return response()->json([
            'message' => 'Véhicule ajouté avec succès',
            'vehicule' => $vehicule
        ], 201);
    }

    // ❌ Supprimer véhicule
    public function destroy(Request $request, Vehicule $vehicule)
    {
        abort_unless(
            $request->user()->isDriver() && $vehicule->user_id === $request->user()->id,
            403
        );

        $vehicule->delete();

        return response()->json([
            'message' => 'Véhicule supprimé avec succès'
        ]);
    }
}
