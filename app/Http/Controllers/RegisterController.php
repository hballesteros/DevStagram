<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Acceso a los datos del formulario
        
        //dd($request);
        //dd($request->get('email'));
        //dd($request->only('email', 'name', 'password'));

        // Validación de datos
        
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required'
            // 'password_confirmation' => 'required'
        ]);
        
        // $user = User::create(request(['name', 'email', 'password']));
        
        // auth()->login($user);
        
        // return redirect()->to('/');
    }

}
