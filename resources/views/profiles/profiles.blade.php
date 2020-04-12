@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="form-group">
                <form action="/profile/{{ $ }}">
                    @csrf
                    <select name="profiles" id="profiles">
                        @foreach($users as $user)
                            <a href="/p/{{ $user->id }}">
                                {{ $user->name }}
                            </a>
                        @endforeach
                    </select>
                </form>

            </div>

        </div>
    </div>
@endsection
