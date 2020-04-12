<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// En un primer momento PhpStorm carga mal la ruta:
// use Intervention\Image\Image;
// la ruta correcta a la clase es:
// use Intervention\Image\Facades\Image;
// Aquí una solución más elegante:
// https://stackoverflow.com/questions/40353307/call-to-undefined-method-intervention-image-facades-imagemake
use Image;

class PostController extends Controller
{

    // 2:07:03 Añadir middleware por Seguridad
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 1:41:00 Conveción: nombrar el método y la vista igual.
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

        // 2:21.30 Package Intervention Image
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        // 2:00:22 create method.
        // 5:10 método habitual con save();
        // https://www.youtube.com/watch?v=WT6sEJD7gFc&list=PLpzy7FIRqpGD0kxI48v8QEVVZd744Phi4&index=8
        // https://laravel.com/docs/7.x/eloquent#inserts vs https://laravel.com/docs/7.x/eloquent#mass-assignment
        // 2:04:10 Obtebción de la FKEY del usuario con:  auth()->user()->posts()
        // Esto garantiza que solo se puede insertar en el usuario autenticado.
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);

    }

    // 2:28:04 añadiendo la ruta al modelo (y si por convención to do se llama igual, en este caso post)
    // Laravel carga todos los parámetros del modelo y no solo el ID
    // 2:29:30 compact() function
    public function show (\App\Post $post)
    {
        return view('posts/show', compact('post'));
    }
}
