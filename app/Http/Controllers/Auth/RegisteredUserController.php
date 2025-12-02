<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => ['required', 'in:Citizen,Partner,Association,ContentCreator,Coach,Sponsor,HealthInstitution,Admin'],
            'gender' => ['nullable', 'in:Male,Female'],
            'birth_month' => ['nullable', 'integer', 'between:1,12'],
            'birth_day' => ['nullable', 'integer', 'between:1,31'],
            'birth_year' => ['nullable', 'integer', 'between:1920,' . date('Y')],
            'marketing_consent' => ['nullable', 'boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'gender' => $request->gender,
            'birth_month' => $request->birth_month,
            'birth_day' => $request->birth_day,
            'birth_year' => $request->birth_year,
            'marketing_consent' => (bool) $request->marketing_consent,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirection selon le rôle
        return match($user->role) {
            'Citizen' => redirect()->route('citizen.dashboard'),
            'Coach' => redirect()->route('coach.dashboard'),
            'Partner' => redirect()->route('partner.dashboard'),
            'Association' => redirect()->route('association.dashboard'),
            'ContentCreator' => redirect()->route('content_creator.dashboard'),
            'Sponsor' => redirect()->route('sponsor.dashboard'),
            'HealthInstitution' => redirect()->route('health_institution.dashboard'),
            default => redirect()->route('citizen.dashboard'),
        };
    }
}
