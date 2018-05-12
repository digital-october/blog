@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Все пользователи</div>

                    <div class="card-body">
                        @foreach($users as $user)
                            <h5>{{ $user->name }}</h5>
                            @if(Auth::user()->role === 'admin')
                                <p class="text-right">
                                    {{ $user->email }} | {{ $user->role ?? 'user' }}
                                    <a href="{{ route('user.make.admin', $user->id) }}">
                                        <button type="button" class="btn btn-outline-primary">make admin</button>
                                    </a>
                                    <a href="{{ route('user.dismiss', $user->id) }}">
                                        <button type="button" class="btn btn-outline-warning">dismiss</button>
                                    </a>
                                    <a href="{{ route('user.delete', $user->id) }}">
                                        <button type="button" class="btn btn-outline-danger">delete user</button>
                                    </a>
                                </p>
                            @endif
                            <br>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
