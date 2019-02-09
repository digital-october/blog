@extends('layouts.app')

@section('content')


    <div class="container">

        @foreach($posts as $post)

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">
                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>

                            ({{ $post->user->name }})

                            @if($post->user_id === Auth::user()->id or Auth::user()->role === 'admin')
                                <a class="text-primary" href="{{ route('posts.edit', $post->id) }}">{{ __('message.fields.edit') }}</a>
                                <a class="text-danger" href="{{ route('posts.destroy', $post->id) }}">{{ __('message.fields.delete') }}</a>
                            @endif
                        </div>

                        <div class="card-body">
                            {{ $post->content }}
                        </div>

                    </div>
                    <br>
                </div>
            </div>
        @endforeach
    </div>
@endsection
