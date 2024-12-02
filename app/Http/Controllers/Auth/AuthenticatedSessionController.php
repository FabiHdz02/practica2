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

    /**
     * Handle an incoming authentication request.
     */
   /**
 * Handle an incoming authentication request.
 */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica al usuario
        $request->authenticate();

        // Regenera la sesión
        $request->session()->regenerate();

        // Obtén el usuario autenticado
        $user = Auth::user();
        $email = $user->email;

        // Redirige dependiendo de la primera letra del email
        if (str_starts_with($email, 'a')) {
            // Si el email comienza con 'a', redirige a menu3
            return redirect()->intended(route('menu3', absolute: false));
        } elseif (str_starts_with($email, 'd')) {
            // Si el email comienza con 'd', redirige a menu2
            return redirect()->intended(route('menu2', absolute: false));
        }

        // Por defecto, redirige al dashboard o ruta predeterminada
        return redirect()->intended(route('dashboard', absolute: false));
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
