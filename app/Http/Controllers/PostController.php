<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * FILEPATH: c:\Users\Hugo\Desktop\Laravel\devstagram\app\Http\Controllers\PostController.php
 * 
 * This class represents the PostController which is responsible for handling the requests related to posts.
 * It extends the base Controller class and applies the 'auth' middleware to all its methods.
 */
class PostController extends Controller
{
    /**
     * Create a new PostController instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['auth']);
    }

    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index(User $user) 
    {
        $posts = Post::where('user_id', $user->id)->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // crear el post
        // Post::create([
        //     'user_id' => auth()->user()->id,
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen
        // ]);

        // otra forma de crear el registro
        // $post = new Post();
        // $post->user_id = auth()->user()->id;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->save();

        // otra forma de crear el registro
        $request->user()->posts()->create([
            'user_id' => auth()->user()->id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
