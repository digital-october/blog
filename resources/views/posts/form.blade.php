@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('message.fields.create_post') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                <div class="form-group row">
                    <label for="title"
                           class="col-sm-4 col-form-label text-md-right">{{ __('message.fields.title') }}</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title"
                               value="{{ $title ?? null }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="author"
                           class="col-sm-4 col-form-label text-md-right">Автор(ы)</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="author"
                               value="{{ $author ?? null }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label
                            class="col-sm-4 col-form-label text-md-right">{{ __('message.fields.content') }}</label>

                    <div class="col-md-6">
                         <textarea type="text" class="form-control" name="content"
                              value="" rows="6">{{ $content ?? null }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label
                            class="col-sm-4 col-form-label text-md-right">File</label>

                    <div class="col-md-6">
                        <input type="file" class="form-control" name="file"
                               value="{{ $file ?? null }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label
                            class="col-sm-4 col-form-label text-md-right">Категории</label>

                    <div class="col-md-6">
                        <select class="selectpicker form-control" multiple data-live-search="true" name="categories[]">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('message.fields.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
