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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(Auth::user()->role =="0"){
            return redirect('admin/dashboard');
        }
        else if(Auth::user()->role=="1"){
            return redirect('lecturer/dashboard');
        }
        else if(Auth::user()->role=="2"){
            return redirect('student/dashboard');
        }
        else if(Auth::user()->role==""){
            return redirect('/login')->with('message','Brak koniecznych uprawnień. Poczekaj aż administrator przypisze cię do roli.');
        }
        else {
            return redirect('/register')->with('message','Brak uprawnień.');
        }
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
