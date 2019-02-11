@extends('layouts.app')

@section('content')


    <div class="container">

        @foreach($posts as $post)

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">
                            <a href="{{ route('posts.show', $post->id) }}" style="font-size: 20px">{{ $post->title }}</a>

                            @if($post->user_id === Auth::user()->id or Auth::user()->role === 'admin')
                                <a class="btn btn-primary btn-sm float-right" href="{{ route('posts.edit', $post->id) }}">{{ __('message.fields.edit') }}</a>

                                <form class="d-inline" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm float-right">
                                        <i class="fa fa-trash"></i> {{ __('message.fields.delete') }}
                                    </button>
                                </form>
                            @endif

                            <span class="float-right">({{ $post->user->present()->fullName }})</span>
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
