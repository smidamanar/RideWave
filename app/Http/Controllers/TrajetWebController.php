<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrajetWebController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->role !== 'conducteur') {
            return redirect()->route('home')->with('error', 'Only conducteurs can view their trips.');
        }

        $trajets = $user->trajets()->orderBy('date')->get();

        return view('trajets.index', compact('trajets'));
    }

    public function show(Trajet $trajet)
    {
        $trajet->load(['conducteur', 'reservations.avis', 'reservations.user']);

        $reviews = $trajet->reservations->filter(fn($reservation) => $reservation->avis)->map(function ($reservation) {
            return [
                'note' => $reservation->avis->note,
                'commentaire' => $reservation->avis->commentaire,
                'passager' => $reservation->user->name,
                'date' => $reservation->avis->created_at->format('M d, Y'),
            ];
        });

        $averageRating = $reviews->count() ? round($reviews->avg('note'), 1) : null;

        $userReservation = null;
        $canReview = false;

        if (Auth::check() && Auth::user()->role === 'passager') {
            $userReservation = $trajet->reservations->firstWhere('user_id', Auth::id());
            $canReview = $userReservation && !$userReservation->avis;
        }

        return view('trajets.show', compact('trajet', 'reviews', 'averageRating', 'canReview', 'userReservation'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'conducteur') {
            return redirect()->route('home')->with('error', 'Only conducteurs can create trips.');
        }

        return view('trajets.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'conducteur') {
            return redirect()->route('home')->with('error', 'Only conducteurs can create trips.');
        }

        $request->validate([
            'depart' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'date' => 'required|date',
            'heure' => 'required',
            'prix' => 'required|numeric|min:0',
            'nb_places' => 'required|integer|min:1',
        ]);

        Trajet::create([
            'conducteur_id' => Auth::id(),
            'depart' => $request->depart,
            'destination' => $request->destination,
            'date' => $request->date,
            'heure' => $request->heure,
            'prix' => $request->prix,
            'nb_places' => $request->nb_places,
            'valide' => true,
        ]);

        return redirect()->route('trajets.my')->with('success', 'Your trip was created successfully.');
    }
}
