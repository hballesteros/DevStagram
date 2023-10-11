<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('perfil.index');
    }
    
    public function store(Request $request) 
    {
        // Modificar el Request
        $request->request->add(['username' => Str::slug( $request->username )]);

        $this-> validate($request, [
            'username' => ['required','unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 
            'not_in:twitter,editar-perfil'],
        ]);

        if($request->imagen){
             // leer la imagen
            $imagen = $request->file('imagen');

            // crear un nombre unico
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            // recortar la imagen
            $imagenServidor = Image::make($imagen)->fit(1000, 1000);

            // crear una ruta
            $imagenPath = public_path('perfiles/' . $nombreImagen);

            // guardar la imagen en el servidor
            $imagenServidor->save($imagenPath);
        } 

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? $usuario->imagen ?? null;
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
