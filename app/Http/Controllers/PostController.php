<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Conveción: nombrar el método y la vista igual. post = carpeta, create = nombre de la vista. 1:41:00
    public function create()
    {
        return view('posts/create');
    }

    //2:01:16 Usar la validación para general el array de datos, si algún campo no requiere de validación
    //pasarlo igualmente así: 'another field' => ''
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        \App\Post::create($data);


        dd(request()->all());
    }
}
