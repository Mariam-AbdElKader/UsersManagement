<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        Auth::login($user);
        $user->loginHistories()->create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('home');
    }

    /**
     * Show the login form.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle the authentication request.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'login' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();
        $user = Auth::user();

        $user->loginHistories()->create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        if ($user->can('admin-role')) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('home'));
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
