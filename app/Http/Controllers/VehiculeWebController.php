<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class VehiculeWebController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $vehicules = Auth::user()->vehicules;
        return view('vehicules.index', compact('vehicules'));
    }

    public function create()
    {
        return view('vehicules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:2030',
            'couleur' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:vehicules,immatriculation',
            'places' => 'required|integer|min:1|max:9',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        Vehicule::create($data);

        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté avec succès.');
    }

    public function edit(Vehicule $vehicule)
    {
        $this->authorize('update', $vehicule);
        return view('vehicules.edit', compact('vehicule'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $this->authorize('update', $vehicule);

        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:2030',
            'couleur' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:vehicules,immatriculation,' . $vehicule->id,
            'places' => 'required|integer|min:1|max:9',
        ]);

        $vehicule->update($request->all());

        return redirect()->route('vehicules.index')->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function destroy(Vehicule $vehicule)
    {
        $this->authorize('delete', $vehicule);
        $vehicule->delete();

        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé avec succès.');
    }
}