<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // leer la imagen
        $imagen = $request->file('file');

        // crear un nombre unico
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        // recortar la imagen
        $imagenServidor = Image::make($imagen)->fit(1000, 1000);

        // crear una ruta
        $imagenPath = public_path('uploads/' . $nombreImagen);

        // guardar la imagen en el servidor
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
