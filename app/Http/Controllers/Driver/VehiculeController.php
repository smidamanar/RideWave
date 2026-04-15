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
        // 🔐 Vérifier utilisateur
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // ✅ Validation
        $request->validate([
            'marque' => 'required|string',
            'modele' => 'required|string',
            'immatriculation' => 'required|string|unique:vehicules'
        ]);

        // 🔥 CORRECTION ICI
        $vehicule = Vehicule::create([
            'user_id' => $request->user()->id, // ✅ FIX
            'marque' => $request->marque,
            'modele' => $request->modele,
            'immatriculation' => $request->immatriculation,
        ]);

        return response()->json([
            'message' => 'Véhicule ajouté avec succès',
            'vehicule' => $vehicule
        ], 201);
    }

    // ❌ Supprimer véhicule
    public function destroy($id)
    {
        $vehicule = Vehicule::find($id);

        if (!$vehicule) {
            return response()->json(['error' => 'Véhicule introuvable'], 404);
        }

        $vehicule->delete();

        return response()->json([
            'message' => 'Véhicule supprimé avec succès'
        ]);
    }
}