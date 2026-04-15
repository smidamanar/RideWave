<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trajet;
use Illuminate\Support\Facades\Auth;


class TrajetController extends Controller
{
    public function store(Request $request)
{
    $trajet = Trajet::create([
        'conducteur_id' => Auth::id(),
        'depart' => $request->depart,
        'destination' => $request->destination,
        'date' => $request->date,
        'heure' => $request->heure,
        'prix' => $request->prix,
        'nb_places' => $request->nb_places
    ]);

    return response()->json($trajet);
}
}
