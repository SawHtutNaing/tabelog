<?php

namespace App\Http\Controllers;

use App\Models\ProfileType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\RollbarHandler;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AuthController extends Controller
{


    public function register()
    {

        return view('auth/register');
    }

    public function makeRegister(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user =  User::create($request->all());




        return redirect(route('auth.login'));
    }

    public function login(Request $request)

    {

        if (Auth::attempt($request->only('email', 'password'))) {

            return redirect(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
}
