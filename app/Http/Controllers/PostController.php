<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    // 2:07:03 Añadir middleware por Seguridad
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 1:41:00 Conveción: nombrar el método y la vista igual. post = carpeta, create = nombre de la vista.
    // Agrupar los métodos que retornan vistas para identificarlos fácilmente.
    public function create()
    {
        return view('posts/create');
    }

    // 2:01:16 Usar la validación para general el array de datos, si algún campo no requiere de validación
    // pasarlo igualmente así: 'another field' => '';
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        // 2:10:20 sobre el almacenamiento de archivos en Laravel
        // 2:11:51 php artisan storage:link. Crear enlace simbólico [...]
        $imagePath = (request('image')->store('uploads', 'public'));

        // 2:04:48 Laravel añade la FKey del User ID 'behind the scene'
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);

    }
}
