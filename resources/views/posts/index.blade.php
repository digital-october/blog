@extends('layouts.app')

@section('content')


    <div class="container">

        @foreach($posts as $post)

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">
                            <a href="{{ route('post.show', $post->id) }}">{{ $post->heading }}</a>

                            ({{ $post->user()->first()->name }})

                            @if($post->user_id === Auth::user()->id or Auth::user()->role === 'admin')
                                <a class="text-primary" href="{{ route('post.edit', $post->id) }}">Редактировать</a>
                                <a class="text-danger" href="{{ route('post.delete', $post->id) }}">Удалить</a>
                            @endif
                        </div>

                        <div class="card-body">
                            {{ $post->body }}
                        </div>

                    </div>
                    <br>
                </div>
            </div>
        @endforeach
    </div>
@endsection
