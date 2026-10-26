<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if ($request->boolean('redirect_search')) {
            $search = collect($request->only(['depart', 'destination', 'date']))
                ->map(fn ($value) => is_string($value) ? trim($value) : $value)
                ->filter(fn ($value) => filled($value))
                ->all();

            if ($search !== []) {
                $request->session()->put('post_login_search', $search);
            }
        } else {
            $request->session()->forget('post_login_search');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            $search = $request->session()->pull('post_login_search');

            if (is_array($search) && $search !== []) {
                $searchRoute = Auth::user()->isDriver()
                    ? 'driver.find-rides'
                    : 'passenger.find-rides';

                return redirect()->route($searchRoute, $search);
            }

            return redirect()->route(Auth::user()->homeRouteName());
        }

        throw ValidationException::withMessages([
            'email' => ['Les informations d\'identification sont incorrectes.'],
        ]);
    }
}
