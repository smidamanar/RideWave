<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trajet;

class TrajetSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Trajet::query()->where('valide', true);

        // Filtre ville de départ
        if ($request->filled('depart')) {
            $query->where('depart', 'like', '%' . $request->depart . '%');
        }

        // Filtre destination
        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }

        // Filtre date
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        // Filtre nb_places
        if ($request->filled('nb_places')) {
            $query->where('nb_places', '>=', $request->nb_places);
        }

        // Filtre prix min / max
        if ($request->filled('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        // Tri optionnel
        if ($request->filled('sort_by')) {
            $sortField = $request->sort_by;
            $sortOrder = $request->filled('order') ? $request->order : 'asc';
            $query->orderBy($sortField, $sortOrder);
        }

        // Pagination pro
        $trajets = $query->paginate(10);

        return response()->json($trajets);
    }
}
