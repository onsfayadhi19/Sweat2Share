<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        return match($user->role) {
            'Admin' => redirect()->intended(route('admin.dashboard')),
            'Citizen' => redirect()->intended(route('citizen.dashboard')),
            'Coach' => redirect()->intended(route('coach.dashboard')),
            'Partner' => redirect()->intended(route('partner.dashboard')),
            'Association' => redirect()->intended(route('association.dashboard')),
            'ContentCreator' => redirect()->intended(route('content_creator.dashboard')),
            'Sponsor' => redirect()->intended(route('sponsor.dashboard')),
            'HealthInstitution' => redirect()->intended(route('health_institution.dashboard')),
            default => redirect()->intended(route('citizen.dashboard')),
        };
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return $this->authenticated($request, $request->user());
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
