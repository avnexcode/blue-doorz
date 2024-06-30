<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;


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
    public function store(RegisterRequest $request): RedirectResponse
    {
        $request->validated();

        $user = User::create([
            'name' => trim(strtolower($request->name)),
            'email' => trim(strtolower($request->email)),
            'password' => Hash::make($request->password),
            'role' => 'guest',
        ]);
        
        Alert::success("Regisetered Successfully!", "Selamat Datang di BlueDoorz");
        event(new Registered($user));
        
        Auth::login($user);
        
        return redirect(route('dashboard', absolute: false));
    }
}
