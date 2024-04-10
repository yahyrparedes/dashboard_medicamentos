<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();

        $path = 'login';

        if ($user->hasRole([Constants::ROLE_DOCTOR])) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

//            return redirect($path)->with('error', 'No tiene permisos para ingresar al sistema.');
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }



        if ($user->hasRole([Constants::ROLE_ADMIN])) {
            $path= Constants::ROUTE_HOME_ADMIN;
        }

        return redirect()->intended($path);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
