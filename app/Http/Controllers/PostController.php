<?php

namespace App\Http\Controllers;

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
        return view('dashboard', [
            'user' => $user
        ]);
    }


    public function create() 
    {
        return view('posts.create');
    }   
}
