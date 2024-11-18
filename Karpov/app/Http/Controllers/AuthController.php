<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showReg()
    {
        return view('auth.register');
    }

    public function regProc(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users',
            'login' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        User::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Используем Hash::make
            'role' => 'user'
        ]);

        return redirect()->route('auth.login')->with(['success' => 'Регистрация успешна!']);
    }


    public function showLogin()
    {
        return view('auth.login');
    }

    public function LoginProced(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('apps.index');
        }

        return back()->withErrors(['login' => 'Неверные данные']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}