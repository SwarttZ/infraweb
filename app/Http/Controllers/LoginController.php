<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public function index()
    {
        return view('backend.admin.dashboard');
    }

    public function showlogin()
    {
      
        return view('frontend.login');
    }

    public function postlogin(Request $request)
    {
        $messages = [
            'email.required' => 'Usuário e/ou senha em branco',
            'email.email' => 'Usuário e/ou senha invalidos',
            'email.exists' => 'Usuário e/ou senha invalidos',
            'password.required' => 'Senha invalida'
        ];

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], $messages);

        if (Auth::attempt($validated)) {

            return redirect()->route('admin.dashboard')->with('success', 'Logado com sucesso.');
        }

        return back()->withErrors(['email' => 'Usuário e/ou senha incorreto(s).']);
    }
    public function logout()
    {

        Auth::Logout();
        return redirect()->route('admin.login');
    }
}
