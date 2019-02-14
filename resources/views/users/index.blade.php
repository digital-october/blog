@extends('layouts.app')

@section('content')

    <div class="card">

        <div class="card-header">All users</div>

        <div class="card-body">
            @foreach($users as $user)
                <span style="font-size: 22px">{{ $user->present()->fullName }}</span>,
                <span style="font-size: 10px">Account age: {{ $user->present()->accountAge }}</span>
                <p class="text-right">
                    @if(Auth::check())
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
                    @endif
                </p>

                <hr>
            @endforeach
        </div>

    </div>
@endsection
