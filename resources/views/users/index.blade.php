@extends('layouts.app')

@section('content')

    <div class="card">

        <div class="card-header">Пользователи</div>

        <div class="card-body">
            @foreach($users as $user)
                <a href="{{ route('posts.user', $user->id) }}" style="font-size: 22px">{{ $user->present()->fullName }}</a>,
                Место работы: {{ $user->jobs ?? 'не указано' }}

                <br>
                @if(Auth::check() and Auth::user()->isRoot)
                        {{ $user->email }} | {{ $user->role->name ?? 'user' }}
                        <a href="{{ route('user.make.admin', $user->id) }}">
                            <button type="button" class="btn btn-outline-primary">make admin</button>
                        </a>
                        <a href="{{ route('user.dismiss', $user->id) }}">
                            <button type="button" class="btn btn-outline-warning">dismiss</button>
                        </a>
                        <a href="{{ route('user.delete', $user->id) }}">
                            <button type="button" class="btn btn-outline-danger">delete user</button>
                        </a>
                @endif

                <br>
                <span style="font-size: 10px">Account age: {{ $user->present()->accountAge }}</span>

                <hr>
            @endforeach
        </div>

    </div>
@endsection
