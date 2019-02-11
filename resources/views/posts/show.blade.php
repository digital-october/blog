@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <h2>{{ $post->title }}</h2>

                        {{ __('message.fields.author') }}: <b>{{ $post->user->present()->fullName }}</b>
                        @if(Auth::user()->is($post->user))
                            <a class="btn btn-primary btn-sm float-right"
                               href="{{ route('posts.edit', $post->id) }}">{{ __('message.fields.edit') }}</a>

                            <form class="d-inline" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm float-right">
                                    <i class="fa fa-trash"></i> {{ __('message.fields.delete') }}
                                </button>
                            </form>
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

                    <button class="btn btn-default btn-sm"
                            style="margin-top: 10px">{{ __('message.fields.send') }}</button>
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
                                    <form class="d-inline" method="post"
                                          action="{{ route('posts.comment.delete', $comment->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm float-right">
                                            <i class="fa fa-trash"></i> {{ __('message.fields.delete') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>


    </div>
@endsection
