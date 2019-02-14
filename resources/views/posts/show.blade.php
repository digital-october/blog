@extends('layouts.app')

@section('content')
    <!-- Title -->
    <h1 class="mt-4">{{ $post->title }}</h1>

    @if(Auth::user()->is($post->user))
        <form class="d-inline" method="post" action="{{ route('posts.destroy', $post->id) }}">
            @method('delete')
            @csrf
            <button class="btn btn-danger btn-sm float-right">
                <i class="fa fa-trash"></i> {{ __('message.fields.delete') }}
            </button>
        </form>

        <a class="btn btn-primary btn-sm float-right"
           href="{{ route('posts.edit', $post->id) }}">{{ __('message.fields.edit') }}</a>
    @endif

    <!-- Author -->
    <p class="lead">
        {{ __('message.fields.author') }}:
        <a href="#">{{ $post->user->present()->fullName }}</a>
    </p>
    <hr>

    <!-- Date/Time -->
    <p>Posted on {{ $post->created_at->format('d M Y') }}</p>
    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
    <hr>

    <!-- Post Content -->
    <p class="lead">{{ $post->content }}</p>

    <!-- Comments Form -->
    <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">

            <form method="POST" action="{{ route('posts.comment.create', [$post->id, Auth::user()->id]) }}">
                @csrf
                <div class="form-group">
                    <input class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                           name="message" value="{{ old('message') }}" required autofocus
                           placeholder="{{ __('message.fields.comment_on') }}...">

                    @if ($errors->has('message'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>

                <button class="btn btn-default btn-sm" style="margin-top: 10px">
                    {{ __('message.fields.send') }}
                </button>
            </form>

        </div>
    </div>


    @if (isset($comments))
        @foreach($comments as $comment)

            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <span class="mt-0" style="font-size: 18px">{{ $comment->user->present()->fullName }}</span>
                    <span class="float-right">{{ $comment->created_at->diffForHumans() }}</span>
                    <br>

                    {{ $comment->message }}

                    @if(Auth::user()->is($comment->user))
                        <form class="d-inline" method="post"
                              action="{{ route('posts.comment.delete', $comment->id) }}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        @endforeach
    @endif

@endsection
