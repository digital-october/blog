@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('message.fields.edit_post') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="title"class="col-sm-4 col-form-label text-md-right">
                        {{ __('message.fields.title') }}
                    </label>

                    <div class="col-md-6">
                        <input type="text"
                            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            name="title"
                            value="{{ $post->title ?? null }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right">{{ __('message.fields.content') }}</label>

                    <div class="col-md-6">
                        <textarea type="text"
                            class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                            name="content" rows="6"
                            required autofocus>
                            {{ $post->content ?? null }}
                        </textarea>
                    </div>

                    @if ($errors->has('content'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('message.fields.update') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
