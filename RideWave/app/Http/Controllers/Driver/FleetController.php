<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FleetController extends Controller
{
    public function index()
    {
        return view('driver.fleet', $this->fleetViewData());
    }

    public function edit(Vehicule $vehicule)
    {
        $this->ensureOwnedByCurrentUser($vehicule);

        return view('driver.fleet', $this->fleetViewData($vehicule));
    }

    public function store(Request $request)
    {
        $data = $this->validateVehicle($request);
        unset($data['photo']);
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('vehicle-photos', 'public');
        }

        Vehicule::create($data);

        return redirect()->route('driver.fleet')->with('success', 'Vehicle added to fleet.');
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $this->ensureOwnedByCurrentUser($vehicule);

        $data = $this->validateVehicle($request, $vehicule);
        unset($data['photo']);

        if ($request->hasFile('photo')) {
            if ($vehicule->photo_path) {
                Storage::disk('public')->delete($vehicule->photo_path);
            }

            $data['photo_path'] = $request->file('photo')->store('vehicle-photos', 'public');
        }

        $vehicule->update($data);

        return redirect()->route('driver.fleet')->with('success', 'Vehicle updated.');
    }

    public function destroy(Vehicule $vehicule)
    {
        $this->ensureOwnedByCurrentUser($vehicule);

        if ($vehicule->photo_path) {
            Storage::disk('public')->delete($vehicule->photo_path);
        }

        $vehicule->delete();

        return redirect()->route('driver.fleet')->with('success', 'Vehicle removed from fleet.');
    }

    public function photo(Vehicule $vehicule)
    {
        $this->ensureOwnedByCurrentUser($vehicule);

        if (!$vehicule->photo_path || !Storage::disk('public')->exists($vehicule->photo_path)) {
            abort(404);
        }

        return response()->file(Storage::disk('public')->path($vehicule->photo_path));
    }

    private function fleetViewData(?Vehicule $editingVehicle = null): array
    {
        return [
            'vehicles' => Vehicule::where('user_id', auth()->id())->latest()->get(),
            'vehicleTypes' => Vehicule::types(),
            'seatLimits' => Vehicule::MAX_SEATS_BY_TYPE,
            'editingVehicle' => $editingVehicle,
        ];
    }

    private function validateVehicle(Request $request, ?Vehicule $vehicule = null): array
    {
        return $request->validate([
            'type' => ['required', Rule::in(array_keys(Vehicule::types()))],
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1990|max:2100',
            'couleur' => 'required|string|max:255',
            'immatriculation' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicules', 'immatriculation')->ignore($vehicule?->id),
            ],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'places' => [
                'required',
                'integer',
                'min:1',
                function (string $attribute, mixed $value, \Closure $fail) use ($request) {
                    $maxSeats = Vehicule::maxSeatsByType((string) $request->input('type'));

                    if ((int) $value > $maxSeats) {
                        $fail("The selected vehicle type allows at most {$maxSeats} seats.");
                    }
                },
            ],
        ]);
    }

    private function ensureOwnedByCurrentUser(Vehicule $vehicule): void
    {
        abort_unless($vehicule->user_id === auth()->id(), 403);
    }
}
