<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public function index($user)
    {
        $user = User::findOrFail($user);

        return view('profiles/index', [
            'user' => $user
        ]);
    }

    public function profiles()
    {
        $users = User::all();

        //dd($users);

        return view('profiles/profiles', [
            'users' => $users
        ]);
    }
}
