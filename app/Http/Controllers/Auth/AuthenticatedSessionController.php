<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $request->session()->put('redirect_to', url()->previous());

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (session()->get(auth()->id() . '_basket')) {
            $basket = session()->get(auth()->id() . '_basket');
            session()->put("basket", $basket);

            session()->forget(auth()->id() . '_basket');
        }

        if (User::where('id', auth()->id())->first()->is_admin) {
            return redirect()->route('administrator.dashboard');
        } else {
            return redirect($request->session()->get('redirect_to'));
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (session()->get("basket")) {
            $basket = session()->get("basket");
            $auth_id = auth()->id();
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if (isset($basket, $auth_id)) {
            session()->put($auth_id . '_basket', $basket);
        }

        return redirect('/');
    }
}
