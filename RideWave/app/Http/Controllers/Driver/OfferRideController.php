<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Trajet;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfferRideController extends Controller
{
    private const RIDE_AMENITIES = [
        'ac_included',
        'pets_allowed',
        'smoking_allowed',
        'baggage_allowed',
        'food_drinks_allowed',
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

    public function create()
    {
        return view('driver.offer-ride', [
            'vehicles' => Vehicule::where('user_id', auth()->id())->latest()->get(),
            'vehicleTypes' => Vehicule::types(),
            'cities' => self::TUNISIAN_CITIES,
        ]);
    }

    public function store(Request $request)
    {
        $vehicle = Vehicule::query()
            ->where('user_id', $request->user()->id)
            ->find($request->input('vehicule_id'));

        $data = $request->validate([
            'vehicule_id' => [
                'required',
                Rule::exists('vehicules', 'id')->where(fn ($query) => $query->where('user_id', $request->user()->id)),
            ],
            'depart' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required',
            'prix' => 'required|numeric|min:0',
            'nb_places' => [
                'required',
                'integer',
                'min:1',
                function (string $attribute, mixed $value, \Closure $fail) use ($vehicle) {
                    if (!$vehicle) {
                        return;
                    }

                    $maxSeats = $vehicle->allowedSeatCount();

                    if ((int) $value > $maxSeats) {
                        $vehicleType = Vehicule::types()[$vehicle->type] ?? ucfirst($vehicle->type);

                        $fail("This {$vehicleType} only supports up to {$maxSeats} seats.");
                    }
                },
            ],
            'smoking_allowed' => 'nullable|boolean',
            'pets_allowed' => 'nullable|boolean',
            'baggage_allowed' => 'nullable|boolean',
            'food_drinks_allowed' => 'nullable|boolean',
            'ac_included' => 'nullable|boolean',
        ]);

        $data['conducteur_id'] = $request->user()->id;
        $data['valide'] = true;

        foreach (self::RIDE_AMENITIES as $amenity) {
            $data[$amenity] = $request->boolean($amenity);
        }

        Trajet::create($data);

        return redirect()->route('driver.history')->with('success', 'Ride offered successfully.');
    }
}
