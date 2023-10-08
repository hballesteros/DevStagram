<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // Modificar el Request
        $request->request->add(['username' => Str::slug( $request->username )]);

        // Validación de datos
        
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
            // 'password_confirmation' => 'required'
        ]);

        //dd('Creando usuario');  
        
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password )
        ]);
        
        // Autneticar al usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        // Otra forma de autenticar al usuario
        auth()->attempt($request->only('email', 'password'));


        //auth()->login($user);
        
        return redirect()->route('posts.index', auth()->user()->username);
    }

}
