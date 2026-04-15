<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationWebController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->role !== 'passager') {
            return redirect()->route('dashboard')->with('error', 'Only passagers can view their reservations.');
        }

        $reservations = $user->reservations()->with('trajet')->orderByDesc('created_at')->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create(Trajet $trajet)
    {
        if (Auth::user()->role !== 'passager') {
            return redirect()->route('dashboard')->with('error', 'Only passagers can reserve trips.');
        }

        return view('reservations.create', compact('trajet'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'passager') {
            return redirect()->route('dashboard')->with('error', 'Only passagers can reserve trips.');
        }

        $request->validate([
            'trajet_id' => 'required|exists:trajets,id',
            'nb_places' => 'required|integer|min:1',
            'date_reservation' => 'required|date',
        ]);

        $trajet = Trajet::find($request->trajet_id);

        if (!$trajet) {
            return back()->withErrors(['trajet_id' => 'Trip not found.']);
        }

        if ($trajet->nb_places < $request->nb_places) {
            return back()->withErrors(['nb_places' => 'Not enough seats available.']);
        }

        $trajet->decrement('nb_places', $request->nb_places);

        Reservation::create([
            'user_id' => Auth::id(),
            'trajet_id' => $trajet->id,
            'date_reservation' => $request->date_reservation,
            'nb_places' => $request->nb_places,
            'statut' => 'confirmée',
        ]);

        return redirect()->route('dashboard')->with('success', 'Reservation created successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        if (Auth::id() !== $reservation->user_id) {
            return redirect()->route('reservations.my')->with('error', 'Unauthorized action.');
        }

        if ($reservation->statut === 'annulée') {
            return redirect()->route('reservations.my')->with('error', 'This reservation is already canceled.');
        }

        if ($reservation->date_reservation->isPast()) {
            return redirect()->route('reservations.my')->with('error', 'You can no longer cancel past reservations.');
        }

        $reservation->trajet->increment('nb_places', $reservation->nb_places);
        $reservation->update(['statut' => 'annulée']);

        return redirect()->route('reservations.my')->with('success', 'Your reservation has been canceled.');
    }
}
