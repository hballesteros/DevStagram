<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        // usamos attach para agregar un registro a la tabla pivote
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(User $user)
    {
        // usamos detach para eliminar un registro de la tabla pivote
        $user->followers()->detach( auth()->user()->id );
        return back();
    }


}
