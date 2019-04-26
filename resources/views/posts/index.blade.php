@extends('layouts.app')

@section('content')

    @foreach($posts as $post)

        <div class="card">

            <div class="card-header">
                <a href="{{ route('posts.show', $post->id) }}" style="font-size: 20px">{{ $post->title }}</a>

                @if($post->user_id === Auth::user()->id or Auth::user()->isRoot)
                    <a class="btn btn-outline-primary btn-sm float-right"
                       href="{{ route('posts.edit', $post->id) }}">{{ __('message.fields.edit') }}</a>

                    <form class="d-inline" method="post" action="{{ route('posts.destroy', $post->id) }}">
                        @method('delete')
                        @csrf
                        <button class="btn btn-outline-danger btn-sm float-right">
                            <i class="fa fa-trash"></i> {{ __('message.fields.delete') }}
                        </button>
                    </form>
                    <hr class="mt-0 mb-0">
                    Статус: [<span class="text-danger">{{ $post->status->name }}</span>]
                    Предложен: [<span class="text-info">{{ $post->created_at->format('d.M.Y H:i:s') }}</span>]
                @endif

                <span class="float-right">Автор: [{{ $post->user->present()->fullName }}]</span>
            </div>

            <div class="card-body">
                {{ $post->content }}
            </div>

        </div>
        <br>
    @endforeach

    {{ $posts->links() }}
@endsection
