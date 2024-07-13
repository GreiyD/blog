<?php

namespace App\Http\Controllers;

use App\Contracts\RegisterActionContract;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginFormRequest $request): RedirectResponse
    {
       $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            return redirect()->route('home');
        }

        return redirect()->route('login.form')->withErrors([
            'password' => 'Your account password is incorrect.',
        ])->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('home');
    }

    public function register(RegisterFormRequest $request, RegisterActionContract $registerUserAction): RedirectResponse
    {
        $data = $request->all();
        $user = $registerUserAction($data);
        Auth::login($user);

        return redirect()->route('home');
    }
}
