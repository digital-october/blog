@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Title -->
    <h1 class="mt-4">{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        Создатель:
        <a href="#">{{ $post->user->present()->fullName }}</a>
    </p>

    <!-- Author -->
    <p class="lead">
        {{ __('message.fields.author') }}:
        <a href="#">{{ $post->author }}</a>
    </p>

    @if(Auth::user()->is($post->user) or Auth::user()->isRoot)
        <a class="btn btn-outline-primary btn-sm float-right"
           href="{{ route('posts.edit', $post->id) }}">{{ __('message.fields.edit') }}</a>

        <form class="d-inline" method="post" action="{{ route('posts.destroy', $post->id) }}">
            @method('delete')
            @csrf
            <button class="btn btn-outline-danger btn-sm float-right">
                <i class="fa fa-trash"></i> {{ __('message.fields.delete') }}
            </button>
        </form>
        Статус: [<span class="text-danger">{{ $post->status->name }}</span>]
        Предложен: [<span class="text-info">{{ $post->created_at->format('d.M.Y H:i:s') }}</span>]
    @endif
    <hr>

    <!-- Categories -->
    <p class="lead">
        Categories:
        @foreach($categories as $category)
            <a class="p-2 text-muted" href="{{ route('posts.category', $category->id) }}">{{ $category->name }}</a>
        @endforeach
    </p>

    <hr>

    <!-- Date/Time -->
    @if(! empty($post->published_at))
        <p>Posted on {{ \Carbon\Carbon::make($post->published_at)->format('d M Y') }}</p>
    @else
        <p>Not published. Proposed by {{ $post->created_at->format('d M Y') }}</p>
    <hr>
    @endif

    <!-- Preview Image -->
    {{--<img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">--}}
    {{--<hr>--}}

    <!-- Post Content -->
    <p class="lead">{{ $post->content }}</p>

    @if(!empty($post->file))
        <a href="{{ route('posts.download', $post->id) }}" class="col-4 btn btn-outline-primary">
            Download file
        </a>
    @endif

    <!-- Moderation block -->
    @if($post->status->slug !== 'accepted')
        @if (Auth::user()->isRoot or Auth::user()->isAdministrator or Auth::user()->isRedactor)
            <div class="card my-4">
                <h5 class="card-header">Moderation block:</h5>
                <div class="card-body">
                    <a href="{{ route('moderation.accepted', $post->id) }}" class="col-4 btn btn-outline-success">Принять</a>
                    <hr>
                    <form class="form" method="post" action="{{ route('moderation.rework', $post->id) }}">
                        @csrf
                        <textarea name="message" class="form-control" id="" placeholder="Что доработать..." cols="50"
                                  rows="2"></textarea>
                        <br>
                        <button type="submit" class="btn btn-outline-warning col-4">Отправить на доработку</button>
                    </form>
                    <hr>
                    <form class="form" method="post" action="{{ route('moderation.reject', $post->id) }}">
                        @csrf
                        <textarea name="message" class="form-control" placeholder="Причина отклонения..." cols="50"
                                  rows="2"></textarea>
                        <br>
                        <button type="submit" class="btn btn-outline-danger col-4">Отклонить</button>
                    </form>
                </div>
            </div>
        @endif
    @endif

    <!-- Comments Form -->
    @if($post->status->slug == 'accepted')
    <div class="card my-4">
        <h5 class="card-header">{{ __('message.fields.leave_comment') }}:</h5>
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
    @endif


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
