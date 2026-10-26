<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\Vehicule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FindRideController extends Controller
{
    private const AMENITY_FILTERS = [
        'smoking_allowed',
        'pets_allowed',
        'baggage_allowed',
        'food_drinks_allowed',
        'ac_included',
    ];

    private const TUNISIAN_CITIES = [
        'Tunis',
        'Ariana',
        'Ben Arous',
        'Manouba',
        'Nabeul',
        'Zaghouan',
        'Bizerte',
        'Beja',
        'Jendouba',
        'Kef',
        'Siliana',
        'Sousse',
        'Monastir',
        'Mahdia',
        'Sfax',
        'Kairouan',
        'Kasserine',
        'Sidi Bouzid',
        'Gafsa',
        'Tozeur',
        'Kebili',
        'Gabes',
        'Medenine',
        'Tataouine',
    ];

    public function __invoke(Request $request)
    {
        $vehicleTypes = Vehicule::types();
        $seatLimits = Vehicule::MAX_SEATS_BY_TYPE;
        $globalSeatLimit = max($seatLimits);
        $selectedVehicleType = (string) $request->input('vehicle_type', '');
        $selectedVehicleType = array_key_exists($selectedVehicleType, $vehicleTypes) ? $selectedVehicleType : '';
        $selectedSeatLimit = $selectedVehicleType !== ''
            ? Vehicule::maxSeatsByType($selectedVehicleType)
            : $globalSeatLimit;
        $selectedSeats = $request->filled('seats')
            ? min($selectedSeatLimit, max(1, $request->integer('seats')))
            : null;
        $sortBy = in_array($request->input('sort'), ['soonest', 'price_low', 'price_high', 'seats'], true)
            ? $request->input('sort')
            : 'soonest';
        $filters = [
            'depart' => trim((string) $request->input('depart', '')),
            'destination' => trim((string) $request->input('destination', '')),
            'date' => (string) $request->input('date', ''),
            'seats' => $selectedSeats,
            'price_max' => $request->filled('price_max') ? max(0, (float) $request->input('price_max')) : null,
            'time_from' => (string) $request->input('time_from', ''),
            'vehicle_type' => $selectedVehicleType,
            'sort' => $sortBy,
            'smoking_allowed' => $request->boolean('smoking_allowed'),
            'pets_allowed' => $request->boolean('pets_allowed'),
            'baggage_allowed' => $request->boolean('baggage_allowed'),
            'food_drinks_allowed' => $request->boolean('food_drinks_allowed'),
            'ac_included' => $request->boolean('ac_included'),
        ];

        $rides = Trajet::with([
                'conducteur',
                'vehicule',
                'reservations.user',
                'comments.user',
                'comments.replies.user',
            ])
            ->where('conducteur_id', '!=', $request->user()->id)
            ->when($filters['depart'] !== '', fn ($query) => $query->where('depart', 'like', '%'.$filters['depart'].'%'))
            ->when($filters['destination'] !== '', fn ($query) => $query->where('destination', 'like', '%'.$filters['destination'].'%'))
            ->when($filters['date'] !== '', fn ($query) => $query->whereDate('date', $filters['date']))
            ->when($filters['seats'] !== null, fn ($query) => $query->where('nb_places', '>=', $filters['seats']))
            ->when($filters['price_max'] !== null, fn ($query) => $query->where('prix', '<=', $filters['price_max']))
            ->when($filters['time_from'] !== '', fn ($query) => $query->whereTime('heure', '>=', $filters['time_from']))
            ->when(
                $filters['vehicle_type'] !== '',
                fn ($query) => $query->whereHas('vehicule', fn ($vehicleQuery) => $vehicleQuery->where('type', $filters['vehicle_type']))
            )
            ->whereDate('date', '>=', now()->toDateString())
            ->get();

        foreach (self::AMENITY_FILTERS as $amenityFilter) {
            if ($filters[$amenityFilter]) {
                $rides = $rides->where($amenityFilter, true);
            }
        }

        $rides = $rides
            ->map(function (Trajet $ride) {
                $reservedSeats = $ride->reservations
                    ->where('statut', Reservation::STATUS_CONFIRMED)
                    ->sum('nb_places');

                $ride->available_seats = max(0, $ride->nb_places - $reservedSeats);

                return $ride;
            })
            ->filter(function (Trajet $ride) use ($filters) {
                return $filters['seats'] === null || $ride->available_seats >= $filters['seats'];
            });

        $rides = match ($sortBy) {
            'price_low' => $rides->sortBy('prix'),
            'price_high' => $rides->sortByDesc('prix'),
            'seats' => $rides->sortByDesc('available_seats'),
            default => $rides->sortBy([
                ['date', 'asc'],
                ['heure', 'asc'],
            ]),
        };

        $rides = $rides->values();

        $featuredRoutes = Trajet::query()
            ->select([
                'depart',
                'destination',
                DB::raw('COUNT(*) as rides_count'),
            ])
            ->where('conducteur_id', '!=', $request->user()->id)
            ->whereDate('date', '>=', now()->toDateString())
            ->groupBy('depart', 'destination')
            ->orderByDesc('rides_count')
            ->orderBy('depart')
            ->orderBy('destination')
            ->limit(3)
            ->get()
            ->values();

        return view('driver.find-rides', [
            'rides' => $rides,
            'cities' => self::TUNISIAN_CITIES,
            'featuredRoutes' => $featuredRoutes,
            'vehicleTypes' => $vehicleTypes,
            'seatLimits' => $seatLimits,
            'filters' => $filters,
            'selectedSeatLimit' => $selectedSeatLimit,
            'globalSeatLimit' => $globalSeatLimit,
            'amenityFilters' => self::AMENITY_FILTERS,
        ]);
    }
}
