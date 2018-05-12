@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <h2>{{ $post->heading }}</h2>

                        Автор: <b>{{ \App\User::find($post->user_id)->name }}</b> <br>
                        @if($post->user_id === Auth::user()->id or Auth::user()->role === 'admin')
                            <a class="text-primary" href="{{ route('post.edit', $post->id) }}">Редактировать</a>
                            <a class="text-danger" href="{{ route('post.delete', $post->id) }}">Удалить</a>
                        @endif
                    </div>

                    <div class="card-body">
                        {{ $post->body }}
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <br>
                <form method="POST" action="{{ route('comment.create', [$post->id, Auth::user()->id]) }}">
                    @csrf
                    <input class="form-control" name="comment" placeholder="Ответить...">

                    <button style="margin-top: 10px">Отправить</button>
                </form>

            </div>

            @if (isset($comments))

                <div class="col-md-8">
                    <hr>
                    Комментарии:
                    <div class="card">
                        @foreach($comments as $comment)
                            <div class="card-body">
                                <b>[{{ \App\User::find($comment->user_id)->name }} {{ $comment->created_at }}]</b> <br>
                                {{ $comment->text }}
                                @if(Auth::user()->role === 'admin')
                                    <a class="text-danger" href="{{ route('comment.delete', $comment->id) }}">Удалить</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>


    </div>
@endsection
