<?php

namespace App\Http\Controllers;

use App\Contracts\RegisterActionContract;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function createLogin(): View
    {
        return view('auth.login');
    }

    public function createRegister(): View
    {
        return view('auth.register');
    }

    public function login(LoginFormRequest $request): RedirectResponse
    {
       $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect()->route('home.index');
        }

        return redirect()->route('login.form')->withErrors([
            'password' => 'Your account password is incorrect.',
        ])->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('home.index');
    }

    public function register(RegisterFormRequest $request, RegisterActionContract $registerUserAction): RedirectResponse
    {
        $data = $request->all();
        $user = $registerUserAction($data);
        Auth::login($user);

        return redirect()->route('home.index');
    }
}
