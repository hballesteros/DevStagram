<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() 
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validación de datos
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Autenticar al usuario
        // Remember es para mantener la sesión abierta
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
             return back()->with('mensaje', 'Credenciales no válidas');
         }

        // Redireccionar al usuario
        return redirect()->route('posts.index');
    }
}
