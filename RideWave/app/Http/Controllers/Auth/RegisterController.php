<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'nullable|string|max:30',
            'role' => 'required|in:passenger,driver,passager,conducteur',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $this->mapRoleForStorage($request->string('role')->toString()),
            'telephone' => $request->telephone,
        ]);

        Auth::login($user);

        return redirect()->route($user->homeRouteName());
    }

    protected function mapRoleForStorage(string $role): string
    {
        return match ($role) {
            'passenger', 'passager' => 'passager',
            'driver', 'conducteur' => 'conducteur',
            default => 'passager',
        };
    }
}
