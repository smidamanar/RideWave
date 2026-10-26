<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function dashboard(): \Illuminate\View\View
    {
        $stats = $this->stats();
        $recentUsers = User::query()
            ->latest()
            ->take(4)
            ->get()
            ->map(fn (User $user, int $index) => [
                'name' => $user->name,
                'email' => $user->email,
                'joined_at' => $user->created_at?->format('M d, Y') ?? 'N/A',
                'status' => $this->userStatusMeta($user),
                'avatar' => $this->userImage($index),
                'search_url' => route('admin.search', ['q' => $user->email]),
            ]);

        $pendingValidations = $this->pendingValidations();

        return view('admin.dashboard', [
            'navActive' => 'dashboard',
            'systemStatus' => $this->systemStatus($stats),
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'pendingValidations' => $pendingValidations,
        ]);
    }

    public function users(Request $request): \Illuminate\View\View
    {
        $role = (string) $request->input('role', '');
        $query = trim((string) $request->input('q', ''));
        $stats = $this->stats();

        $users = User::query()
            ->withCount(['trajets', 'reservations', 'vehicules'])
            ->when($role !== '', fn ($builder) => $builder->where('role', $role))
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($nested) use ($query) {
                    $nested->where('name', 'like', '%'.$query.'%')
                        ->orWhere('email', 'like', '%'.$query.'%')
                        ->orWhere('telephone', 'like', '%'.$query.'%');
                });
            })
            ->latest()
            ->take(18)
            ->get()
            ->values()
            ->map(function (User $user, int $index) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'joined_at' => $user->created_at?->format('M d, Y') ?? 'N/A',
                    'role' => $user->roleLabel(),
                    'rides_count' => $user->trajets_count,
                    'bookings_count' => $user->reservations_count,
                    'vehicles_count' => $user->vehicules_count,
                    'status' => $this->userStatusMeta($user),
                    'avatar' => $this->userImage($index),
                    'search_url' => route('admin.search', ['q' => $user->email]),
                ];
            });

        return view('admin.users', [
            'navActive' => 'users',
            'systemStatus' => $this->systemStatus($stats),
            'stats' => $stats,
            'users' => $users,
            'query' => $query,
            'role' => $role,
        ]);
    }

    public function trips(Request $request): \Illuminate\View\View
    {
        $status = (string) $request->input('status', '');
        $query = trim((string) $request->input('q', ''));
        $stats = $this->stats();

        $rides = Trajet::query()
            ->with(['conducteur', 'reservations'])
            ->when($status !== '', fn ($builder) => $builder->where('valide', $status === 'validated'))
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($nested) use ($query) {
                    $nested->where('depart', 'like', '%'.$query.'%')
                        ->orWhere('destination', 'like', '%'.$query.'%')
                        ->orWhereHas('conducteur', fn ($driverQuery) => $driverQuery->where('name', 'like', '%'.$query.'%'));
                });
            })
            ->latest('date')
            ->latest('heure')
            ->take(16)
            ->get()
            ->map(function (Trajet $ride) {
                $confirmedSeats = (int) $ride->reservations
                    ->where('statut', '!=', 'annulee')
                    ->sum('nb_places');

                return [
                    'id' => $ride->id,
                    'driver' => $ride->conducteur?->name ?? 'Unknown driver',
                    'route' => $ride->depart.' → '.$ride->destination,
                    'date' => $ride->date->format('M d, Y'),
                    'time' => substr((string) $ride->heure, 0, 5),
                    'price' => number_format((float) $ride->prix, 2),
                    'seats' => max(0, (int) $ride->nb_places - $confirmedSeats),
                    'bookings' => $ride->reservations->count(),
                    'validated' => (bool) $ride->valide,
                    'status' => $ride->valide
                        ? ['label' => 'Validated', 'class' => 'bg-emerald-50 text-emerald-600']
                        : ['label' => 'Pending', 'class' => 'bg-amber-50 text-amber-600'],
                ];
            });

        return view('admin.trips', [
            'navActive' => 'trips',
            'systemStatus' => $this->systemStatus($stats),
            'stats' => $stats,
            'rides' => $rides,
            'query' => $query,
            'status' => $status,
        ]);
    }

    public function toggleTripValidation(Trajet $trajet): \Illuminate\Http\RedirectResponse
    {
        $trajet->update([
            'valide' => ! $trajet->valide,
        ]);

        return back()->with('success', $trajet->valide ? 'Trip marked as validated.' : 'Trip moved back to pending review.');
    }

    public function fleet(Request $request): \Illuminate\View\View
    {
        $type = (string) $request->input('type', '');
        $query = trim((string) $request->input('q', ''));
        $stats = $this->stats();

        $vehicles = Vehicule::query()
            ->with('user')
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($nested) use ($query) {
                    $nested->where('marque', 'like', '%'.$query.'%')
                        ->orWhere('modele', 'like', '%'.$query.'%')
                        ->orWhere('immatriculation', 'like', '%'.$query.'%')
                        ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', '%'.$query.'%'));
                });
            })
            ->latest()
            ->take(18)
            ->get()
            ->map(function (Vehicule $vehicle, int $index) {
                $vehicleType = $this->classifyVehicleType($vehicle);
                $health = $this->vehicleHealthMeta($vehicle);

                return [
                    'id' => $vehicle->id,
                    'owner' => $vehicle->user?->name ?? 'Unknown driver',
                    'brand' => $vehicle->marque,
                    'model' => $vehicle->modele,
                    'year' => $vehicle->annee,
                    'plate' => $vehicle->immatriculation,
                    'color' => $vehicle->couleur,
                    'seats' => $vehicle->places,
                    'type' => $vehicleType,
                    'type_class' => $this->vehicleTypeClass($vehicleType),
                    'health' => $health,
                    'icon' => $index % 3 === 0 ? 'directions_car' : ($index % 3 === 1 ? 'electric_car' : 'local_shipping'),
                ];
            })
            ->filter(fn (array $vehicle) => $type === '' || $vehicle['type'] === $type)
            ->values();

        return view('admin.fleet', [
            'navActive' => 'fleet',
            'systemStatus' => $this->systemStatus($stats),
            'stats' => $stats,
            'vehicles' => $vehicles,
            'type' => $type,
            'query' => $query,
        ]);
    }

    public function analytics(): \Illuminate\View\View
    {
        $stats = $this->stats();

        $topDrivers = User::query()
            ->whereIn('role', ['driver', 'conducteur'])
            ->withCount(['trajets', 'vehicules'])
            ->get()
            ->map(function (User $driver, int $index) {
                $rating = Avis::query()
                    ->whereHas('reservation.trajet', fn ($query) => $query->where('conducteur_id', $driver->id))
                    ->avg('note');

                $confirmedSeats = Reservation::query()
                    ->where('statut', 'confirmee')
                    ->whereHas('trajet', fn ($query) => $query->where('conducteur_id', $driver->id))
                    ->sum('nb_places');

                return [
                    'name' => $driver->name,
                    'rating' => number_format((float) ($rating ?? 4.8), 1),
                    'rides' => $driver->trajets_count,
                    'confirmed_seats' => $confirmedSeats,
                    'avatar' => $this->userImage($index),
                ];
            })
            ->sortByDesc(fn (array $driver) => [$driver['rating'], $driver['confirmed_seats']])
            ->take(5)
            ->values();

        $topRoutes = Trajet::query()
            ->selectRaw('depart, destination, COUNT(*) as total_routes')
            ->groupBy('depart', 'destination')
            ->orderByDesc('total_routes')
            ->take(5)
            ->get()
            ->map(fn ($route) => [
                'route' => $route->depart.' → '.$route->destination,
                'count' => (int) $route->total_routes,
            ]);

        return view('admin.analytics', [
            'navActive' => 'analytics',
            'systemStatus' => $this->systemStatus($stats),
            'stats' => $stats,
            'topDrivers' => $topDrivers,
            'topRoutes' => $topRoutes,
        ]);
    }

    public function search(Request $request): \Illuminate\View\View
    {
        $query = trim((string) $request->input('q', ''));
        $stats = $this->stats();

        $users = collect();
        $rides = collect();
        $vehicles = collect();

        if ($query !== '') {
            $users = User::query()
                ->when($query !== '', function ($builder) use ($query) {
                    $builder->where(function ($nested) use ($query) {
                        $nested->where('name', 'like', '%'.$query.'%')
                            ->orWhere('email', 'like', '%'.$query.'%')
                            ->orWhere('telephone', 'like', '%'.$query.'%');
                    });
                })
                ->latest()
                ->take(6)
                ->get();

            $rides = Trajet::query()
                ->with('conducteur')
                ->where(function ($nested) use ($query) {
                    $nested->where('depart', 'like', '%'.$query.'%')
                        ->orWhere('destination', 'like', '%'.$query.'%')
                        ->orWhereHas('conducteur', fn ($driverQuery) => $driverQuery->where('name', 'like', '%'.$query.'%'));
                })
                ->latest('date')
                ->take(6)
                ->get();

            $vehicles = Vehicule::query()
                ->with('user')
                ->where(function ($nested) use ($query) {
                    $nested->where('marque', 'like', '%'.$query.'%')
                        ->orWhere('modele', 'like', '%'.$query.'%')
                        ->orWhere('immatriculation', 'like', '%'.$query.'%')
                        ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', '%'.$query.'%'));
                })
                ->latest()
                ->take(6)
                ->get();
        }

        return view('admin.search', [
            'navActive' => null,
            'systemStatus' => $this->systemStatus($stats),
            'stats' => $stats,
            'query' => $query,
            'users' => $users,
            'rides' => $rides,
            'vehicles' => $vehicles,
        ]);
    }

    public function exportReport(): StreamedResponse
    {
        $stats = $this->stats();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ridewave-admin-report.csv"',
        ];

        return response()->streamDownload(function () use ($stats) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Metric', 'Value']);
            fputcsv($handle, ['Monthly Revenue', $stats['monthly_revenue']]);
            fputcsv($handle, ['Active Users', $stats['active_users']]);
            fputcsv($handle, ['Completion Rate', $stats['completion_rate']]);
            fputcsv($handle, ['Drivers', $stats['drivers']]);
            fputcsv($handle, ['Passengers', $stats['passengers']]);
            fputcsv($handle, ['Total Rides', $stats['rides']]);
            fputcsv($handle, ['Pending Validations', $stats['pending_validations']]);
            fputcsv($handle, ['Fleet Vehicles', $stats['vehicles']]);
            fputcsv($handle, ['Validated Ride Rate', $stats['validated_rate']]);

            fclose($handle);
        }, 'ridewave-admin-report.csv', $headers);
    }

    private function stats(): array
    {
        $users = User::count();
        $drivers = User::whereIn('role', ['driver', 'conducteur'])->count();
        $passengers = User::whereIn('role', ['passenger', 'passager'])->count();
        $rides = Trajet::count();
        $validatedRides = Trajet::where('valide', true)->count();
        $pendingRides = Trajet::where('valide', false)->count();
        $vehicles = Vehicule::count();
        $reservations = Reservation::count();
        $confirmedReservations = Reservation::where('statut', 'confirmee')->count();

        $monthlyRevenue = Reservation::query()
            ->with('trajet')
            ->where('statut', 'confirmee')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->get()
            ->sum(fn (Reservation $reservation) => ((float) ($reservation->trajet?->prix ?? 0)) * $reservation->nb_places);

        $previousMonthlyRevenue = Reservation::query()
            ->with('trajet')
            ->where('statut', 'confirmee')
            ->whereYear('created_at', now()->copy()->subMonth()->year)
            ->whereMonth('created_at', now()->copy()->subMonth()->month)
            ->get()
            ->sum(fn (Reservation $reservation) => ((float) ($reservation->trajet?->prix ?? 0)) * $reservation->nb_places);

        $currentMonthUsers = User::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        $previousMonthUsers = User::whereYear('created_at', now()->copy()->subMonth()->year)
            ->whereMonth('created_at', now()->copy()->subMonth()->month)
            ->count();

        $completionRate = $reservations > 0
            ? round(($confirmedReservations / $reservations) * 100, 1)
            : 0.0;

        $validatedRate = $rides > 0
            ? round(($validatedRides / $rides) * 100)
            : 0;

        return [
            'users' => $users,
            'active_users' => $users,
            'drivers' => $drivers,
            'passengers' => $passengers,
            'rides' => $rides,
            'validated_rides' => $validatedRides,
            'pending_validations' => $pendingRides,
            'vehicles' => $vehicles,
            'reservations' => $reservations,
            'confirmed_reservations' => $confirmedReservations,
            'completion_rate' => $completionRate,
            'validated_rate' => $validatedRate,
            'monthly_revenue' => round($monthlyRevenue, 2),
            'revenue_change' => $this->changeMeta($monthlyRevenue, $previousMonthlyRevenue),
            'users_change' => $this->changeMeta($currentMonthUsers, $previousMonthUsers),
        ];
    }

    private function pendingValidations(): array
    {
        $latestDriver = User::query()
            ->whereIn('role', ['driver', 'conducteur'])
            ->latest()
            ->first();

        $pendingRide = Trajet::query()
            ->with('conducteur')
            ->where('valide', false)
            ->latest('date')
            ->first();

        $fallbackRide = $pendingRide ?: Trajet::query()
            ->with('conducteur')
            ->latest('date')
            ->first();

        $latestVehicle = Vehicule::query()
            ->with('user')
            ->latest()
            ->first();

        return array_values(array_filter([
            $latestDriver ? [
                'kind' => 'driver',
                'title' => $latestDriver->name,
                'subtitle' => 'New Driver Application',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAqHOlzgIAbDutJO4PB0h3orc_vrMyaRidkc2YdOFW9xE8UOq3_4xa3PWiurd34T3GLhKj3r-dwk85CCA4fmF35wFnqjAu9dzX2nXX0ARGBajb0sf2W6Xy-f2rhFJkhMrStW5xsk2iFNG2qeXXcE0rTe16AceYMd_b1eL7GP9RBmSPoKhU_clkiaJILIPmDA0JRW3n-GfMwL_FOm9Nt89r7pJnvez-o6_qi4riX2cV4mHAYIBkg3QchBWRAMdmJUESQUB5T5AhCLmcq',
                'primary_label' => 'Review',
                'primary_url' => route('admin.users', ['q' => $latestDriver->email]),
                'secondary_kind' => 'link',
                'secondary_label' => 'visibility',
                'secondary_url' => route('admin.search', ['q' => $latestDriver->email]),
            ] : null,
            $fallbackRide ? [
                'kind' => 'trip',
                'title' => $fallbackRide->depart.' → '.$fallbackRide->destination,
                'subtitle' => $fallbackRide->valide ? 'Quality Review Complete' : 'Trip Validation Required',
                'icon' => 'verified_user',
                'primary_label' => 'Review',
                'primary_url' => route('admin.trips', ['q' => $fallbackRide->depart]),
                'secondary_kind' => 'form',
                'secondary_label' => $fallbackRide->valide ? 'visibility' : 'check',
                'secondary_url' => route('admin.trips.toggle-validation', $fallbackRide),
            ] : null,
            $latestVehicle ? [
                'kind' => 'vehicle',
                'title' => trim($latestVehicle->marque.' '.$latestVehicle->modele).' - #'.$latestVehicle->id,
                'subtitle' => 'Fleet Status Check',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDFcIDivLH1pETFl-Bu99PyGan_4IVv93bLx4R-5NBps81lh1xvVEsz4KduM3s1fXOf4-A_nemX0gcvdWu5j9rTHMPQK8dgb30a3Dbrut0L8oFd-aAZQ3E9W2i7QHDUIoNXcn1Uh8wLna4Fjrio0dZU_nsArd1gii4KwFbAi0N5dC3Klr3YasEzwMJ7wFW8jLc23B_ocC7TAj_T0_tQ_g5XgwM7GWyL36_F0IAB_4-jBp2kHTq0mgTD9jAv70A2I_8-Oar8hKXHONHL',
                'primary_label' => 'View Details',
                'primary_url' => route('admin.fleet', ['q' => $latestVehicle->immatriculation]),
                'secondary_kind' => 'link',
                'secondary_label' => 'check',
                'secondary_url' => route('admin.fleet', ['q' => $latestVehicle->immatriculation]),
            ] : null,
        ]));
    }

    private function userStatusMeta(User $user): array
    {
        if ($user->isAdmin()) {
            return ['label' => 'Priority', 'class' => 'bg-violet-50 text-violet-600'];
        }

        if ($user->isDriver()) {
            return ['label' => 'Verified', 'class' => 'bg-emerald-50 text-emerald-600'];
        }

        return ['label' => 'Active', 'class' => 'bg-emerald-50 text-emerald-600'];
    }

    private function vehicleHealthMeta(Vehicule $vehicle): array
    {
        $currentYear = (int) now()->format('Y');

        if ((int) $vehicle->annee >= $currentYear - 2) {
            return ['label' => 'Optimal', 'class' => 'bg-emerald-50 text-emerald-600'];
        }

        if ((int) $vehicle->annee >= $currentYear - 5) {
            return ['label' => 'Monitor', 'class' => 'bg-amber-50 text-amber-600'];
        }

        return ['label' => 'Review', 'class' => 'bg-rose-50 text-rose-600'];
    }

    private function classifyVehicleType(Vehicule $vehicle): string
    {
        $combined = strtolower(trim($vehicle->marque.' '.$vehicle->modele));

        if (str_contains($combined, 'tesla') || str_contains($combined, 'polestar') || str_contains($combined, 'electric')) {
            return 'Electric';
        }

        if (str_contains($combined, 'bmw') || str_contains($combined, 'mercedes') || str_contains($combined, 'lexus')) {
            return 'Luxury';
        }

        if ($vehicle->places >= 5 || str_contains($combined, 'sportage') || str_contains($combined, '3008') || str_contains($combined, 'x5')) {
            return 'SUV';
        }

        return 'Sedan';
    }

    private function vehicleTypeClass(string $type): string
    {
        return match ($type) {
            'Electric' => 'bg-emerald-50 text-emerald-600',
            'Luxury' => 'bg-purple-50 text-purple-600',
            'SUV' => 'bg-blue-50 text-blue-600',
            default => 'bg-slate-100 text-slate-600',
        };
    }

    private function changeMeta(float|int $current, float|int $previous): array
    {
        if ((float) $previous === 0.0) {
            $value = $current > 0 ? 100.0 : 0.0;
        } else {
            $value = (($current - $previous) / $previous) * 100;
        }

        $rounded = round($value, 1);

        return [
            'value' => $rounded,
            'label' => ($rounded >= 0 ? '+' : '').$rounded.'%',
            'positive' => $rounded >= 0,
        ];
    }

    private function systemStatus(array $stats): string
    {
        if ($stats['completion_rate'] >= 95 && $stats['pending_validations'] <= 5) {
            return 'Optimal';
        }

        if ($stats['completion_rate'] >= 85) {
            return 'Monitor';
        }

        return 'Action Needed';
    }

    private function userImage(int $index): string
    {
        $images = [
            'https://lh3.googleusercontent.com/aida-public/AB6AXuBpEwyplLNkX4Hxr4TEV30jyKIdh9T0DEFCpBpV7DWMbDvXBQJyVqWzeZi8e7mDg7rqG5A8ENWh6o__2eVzFbgsJeAyGnSJZ8wSDcgvAgikspSyD-h-f_fRRHFN6DeGyAC0eH8f8ZUv79Xje1bmD-JffiIGnGQP0zsgzLd29SRXVsO7gSOh9THrm9nVkHBnpkqBQ7xbKedZyIOEjnuijW9FQNQ5iB5t2RpPEuZuUqmA9a9brUKp99WtsoywCp9PALUtI_iaUSXvSyeT',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuBMpe5HLf1BPh3nB01Sn4UkLTftHocU8fTy0wVTVLyaCc74-1TulemtrI-mMV0wnqZVj8G446PdXX6SJRNOy8GHCNDXzLsJkgGovSZuxTBJ4BTwadjhZa6wdQhKREzUsAMXfwf_Vk-AUoFuFexE_dShi8noDOpsWuf900ij7ObbwmSob78g3lRHQJBV9LpFWARq3sfmMCHQYxLojJI6qSu__Mal4DuFWCd07vUG6rwN9uIJ5VggtIzy3iIHY28KcTSq-2BAoCJCgKPH',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuC5YbeMAn45RDP9XvFojom7O4xYOq6c8jAJOxHGNMtS-vjwbVDUlJpvFT_v05vbtBa80DCFsDd56WBxYbuCn6SyErrXZ265oclBRrCMoNqE2N5N-HhvFu0i8nnJ1ukeCrhHvKWOxPEBr3eWb4RWcxWPKt1sjMlxv_vrDP3CklmSfXjkXfTvX05nGro0JlYGWDVTFoUF47vGZaSGnq7S0vcq6udXk5C7oKPTUj5St2IAxnhZ-prhCnWiTRYoce5YaRHBzZlfyJHL5PsS',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuB1KaAitrOL6eZixI1Kwv88OmfC9X_yYAikiSybk87ZbxSg7-OojGWjj4PTdp8B8nudNtHFM7K2SEupcaO8f1AGzHzT2XvoLGZJYS6aHVjxscIBWxKWfOgvXEKRw_EPGZoXm8bgoURbWPaxpEOVX_O-eOfDIMRPnTaWtETgJP57_BLIJqUEeecuMgooOKH5liim_EwBFMbRmq6YOC3LNl1WulyJgptJRXBbpawg7UV6GLywLZ4cxjDt0nS60JzZBde6oVhPlLtFlFz3',
        ];

        return $images[$index % count($images)];
    }
}
