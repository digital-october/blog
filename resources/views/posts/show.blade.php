@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <h2>{{ $post->title }}</h2>

                        {{ __('message.fields.author') }}: <b>{{ $post->user->name }}</b> <br>
                        @if(Auth::user()->is($post->user))
                            <a class="text-primary" href="{{ route('posts.edit', $post->id) }}">{{ __('message.fields.edit') }}</a>
                            <a class="text-danger" href="{{ route('posts.destroy', $post->id) }}">{{ __('message.fields.delete') }}</a>
                        @endif
                    </div>

                    <div class="card-body">
                        {{ $post->content }}
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <br>
                <form method="POST" action="{{ route('posts.comment.create', [$post->id, Auth::user()->id]) }}">
                    @csrf

                    <input class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                           name="message" value="{{ old('message') }}" required autofocus
                           placeholder="{{ __('message.fields.comment_on') }}...">

                    @if ($errors->has('message'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif

                    <button style="margin-top: 10px">{{ __('message.fields.send') }}</button>
                </form>

            </div>

            @if (isset($comments))

                <div class="col-md-8">
                    <hr>
                    {{ __('message.fields.comments') }}:
                    <div class="card">
                        @foreach($comments as $comment)
                            <div class="card-body">
                                <b>[{{ $comment->user->name }} {{ $comment->created_at }}]</b> <br>
                                {{ $comment->message }}
                                @if(Auth::user()->is($comment->user))
                                    <a class="text-danger"
                                       href="{{ route('posts.comment.delete', $comment->id) }}">{{ __('message.fields.delete') }}</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>


    </div>
@endsection
