<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisWebController extends Controller
{
    public function store(Request $request, Trajet $trajet)
    {
        if (!Auth::check() || Auth::user()->role !== 'passager') {
            return redirect()->route('login');
        }

        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|min:10',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $reservation = Reservation::with('trajet')->find($request->reservation_id);

        if (!$reservation || $reservation->user_id !== Auth::id() || $reservation->trajet_id != $trajet->id) {
            return back()->with('error', 'Invalid reservation selected.');
        }

        if ($reservation->avis) {
            return back()->with('error', 'You already submitted a review for this reservation.');
        }

        Avis::create([
            'reservation_id' => $reservation->id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Votre avis a bien été pris en compte.');
    }

    public function index()
    {
        if (Auth::user()->role === 'conducteur') {
            $avis = Avis::whereHas('reservation.trajet', function ($query) {
                $query->where('user_id', Auth::id());
            })->with(['reservation.trajet', 'reservation.user'])->get();
        } else {
            $avis = collect(); // Passagers don't have received reviews
        }

        return view('avis.index', compact('avis'));
    }
}
