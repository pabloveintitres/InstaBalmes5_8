<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //2:02:57 si no arrojará un error: 'Add [nombreDelCampo] to fillable property to allow mass assignment
    // on [App\Post].'
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
