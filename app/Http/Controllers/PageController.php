<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Avis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home()
    {
        $trajets = Trajet::with('conducteur')
            ->where('valide', true)
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->take(6)
            ->get();

        $trajet_count = Trajet::where('valide', true)
            ->whereDate('date', '>=', now())
            ->count();

        $popularRoutes = Trajet::select('depart', 'destination', DB::raw('COUNT(*) as route_count'), DB::raw('MIN(prix) as min_price'))
            ->where('valide', true)
            ->whereDate('date', '>=', now())
            ->groupBy('depart', 'destination')
            ->orderByDesc('route_count')
            ->limit(8)
            ->get();

        $avis = Avis::with(['reservation.user', 'reservation.trajet'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Statistics
        $users_count = User::count();
        $average_rating = Avis::avg('note') ?? 4.9;
        $cities_covered = Trajet::select('depart', 'destination')
            ->where('valide', true)
            ->get()
            ->map(function($trajet) {
                return [$trajet->depart, $trajet->destination];
            })
            ->flatten()
            ->unique()
            ->count();

        return view('index', compact('trajets', 'trajet_count', 'popularRoutes', 'avis', 'users_count', 'average_rating', 'cities_covered'));
    }

    public function cars(Request $request)
    {
        $query = Trajet::with('conducteur')
            ->where('valide', true)
            ->whereDate('date', '>=', now());

        if ($request->filled('pickup')) {
            $query->where(function ($q) use ($request) {
                $q->where('depart', 'like', '%' . $request->pickup . '%')
                  ->orWhere('destination', 'like', '%' . $request->pickup . '%');
            });
        }

        if ($request->filled('dropoff')) {
            $query->where(function ($q) use ($request) {
                $q->where('depart', 'like', '%' . $request->dropoff . '%')
                  ->orWhere('destination', 'like', '%' . $request->dropoff . '%');
            });
        }

        if ($request->filled('journey_date')) {
            try {
                $date = Carbon::parse($request->journey_date)->toDateString();
                $query->whereDate('date', $date);
            } catch (\Exception $e) {
                // ignore invalid date format
            }
        }

        if ($request->filled('return_date')) {
            try {
                $returnDate = Carbon::parse($request->return_date)->toDateString();
                $query->whereDate('date', '<=', $returnDate);
            } catch (\Exception $e) {
                // ignore invalid date format
            }
        }

        if ($request->filled('min_price')) {
            $query->where('prix', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('prix', '<=', $request->max_price);
        }

        if ($request->filled('driver')) {
            $query->whereHas('conducteur', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->driver . '%');
            });
        }

        $trajets = $query->orderBy('date')->paginate(9)->withQueryString();

        return view('cars', compact('trajets'));
    }

    public function services()
    {
        $stats = [
            'trajets' => Trajet::where('valide', true)->count(),
            'conducteurs' => User::where('role', 'conducteur')->count(),
            'passagers' => User::where('role', 'passager')->count(),
            'reservations' => Reservation::count(),
        ];

        return view('services', compact('stats'));
    }

    public function about()
    {
        $stats = [
            'trajets' => Trajet::where('valide', true)->count(),
            'reservations' => \App\Models\Reservation::count(),
            'conducteurs' => \App\Models\User::where('role', 'conducteur')->count(),
            'passagers' => \App\Models\User::where('role', 'passager')->count(),
        ];

        return view('about', compact('stats'));
    }

    public function blog()
    {
        $latestTrajets = Trajet::with('conducteur')
            ->where('valide', true)
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        return view('blog', compact('latestTrajets'));
    }

    public function single($id)
    {
        $trajet = Trajet::with('conducteur')
            ->where('valide', true)
            ->findOrFail($id);

        return view('single', compact('trajet'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email',
            'message'    => 'required|string',
        ]);

        // Handle message (store in DB, send email, etc.)

        return back()->with('success', 'Your message has been sent!');
    }

    public function sendDriverContact(Request $request, Trajet $trajet)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'message' => 'required|string|min:10',
        ]);

        // Placeholder for contacting the driver; replace with actual email or message storage as needed.

        return back()->with('success', 'Votre message a bien été envoyé au conducteur.');
    }
}