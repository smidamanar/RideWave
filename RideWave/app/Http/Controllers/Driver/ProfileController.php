<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $driver = $request->user();
        $primaryVehicle = Vehicule::where('user_id', $driver->id)->latest()->first();

        return view('driver.profile', [
            'primaryVehicle' => $primaryVehicle,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'telephone' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'remove_profile_photo' => 'nullable|boolean',
        ]);
        $removeProfilePhoto = (bool) ($data['remove_profile_photo'] ?? false);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        unset($data['profile_photo'], $data['remove_profile_photo']);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $data['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');
        } elseif ($removeProfilePhoto && $user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $data['profile_photo_path'] = null;
        }

        $user->update($data);

        return redirect()->route('driver.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function photo(Request $request)
    {
        $driver = $request->user();

        if (!$driver->profile_photo_path || !Storage::disk('public')->exists($driver->profile_photo_path)) {
            abort(404);
        }

        return response()->file(Storage::disk('public')->path($driver->profile_photo_path));
    }
}
