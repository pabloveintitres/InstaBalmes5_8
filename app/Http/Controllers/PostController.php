<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Conveción: nombrar el método y la vista igual. post = carpeta, create = nombre de la vista. 1:41:00
    public function create()
    {
        return view('posts.create');
    }
}
