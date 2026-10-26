<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trajet;

class TrajetSearchController extends Controller
{
    public function search(Request $request)
    {
        $filters = $request->validate([
            'depart' => 'sometimes|string|max:255',
            'destination' => 'sometimes|string|max:255',
            'date' => 'sometimes|date',
            'nb_places' => 'sometimes|integer|min:1',
            'prix_min' => 'sometimes|numeric|min:0',
            'prix_max' => 'sometimes|numeric|min:0',
            'sort_by' => 'sometimes|string|in:date,heure,prix,nb_places',
            'order' => 'sometimes|string|in:asc,desc',
        ]);

        $query = Trajet::query()->where('valide', true);

        if (!empty($filters['depart'])) {
            $query->where('depart', 'like', '%'.$filters['depart'].'%');
        }

        if (!empty($filters['destination'])) {
            $query->where('destination', 'like', '%'.$filters['destination'].'%');
        }

        if (!empty($filters['date'])) {
            $query->where('date', $filters['date']);
        }

        if (!empty($filters['nb_places'])) {
            $query->where('nb_places', '>=', $filters['nb_places']);
        }

        if (isset($filters['prix_min'])) {
            $query->where('prix', '>=', $filters['prix_min']);
        }
        if (isset($filters['prix_max'])) {
            $query->where('prix', '<=', $filters['prix_max']);
        }

        if (isset($filters['sort_by'])) {
            $query->orderBy($filters['sort_by'], $filters['order'] ?? 'asc');
        }

        $trajets = $query->paginate(10);

        return response()->json($trajets);
    }
}
