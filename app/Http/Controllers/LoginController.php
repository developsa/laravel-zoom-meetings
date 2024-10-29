<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{

    protected $redirectTo = '/account/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        return view("auth.login");
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $control = $request->only('email', 'password');
        $remember = $request->has('remember');
        if (auth()->attempt($control, $remember)) {
            return redirect()->intended($this->redirectTo)->with("success", "Login successful");
        }
        return back()->withErrors(['email' => 'Incorrect email address or password.'])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $response = redirect()->route('login.index');
        $cookies = [
            'laravel_session',
            'XSRF-TOKEN',
            'remember_web',
        ];

        foreach ($cookies as $cookie) {
            $response = $response->withCookie(Cookie::forget($cookie));
        }
        return $response;
    }
}
