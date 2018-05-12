@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                            Новый пост
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('post.store', Auth::user()->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-sm-4 col-form-label text-md-right">Заголовок</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="heading"
                                           value="{{ $heading ?? null }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-sm-4 col-form-label text-md-right">Текст</label>

                                <div class="col-md-6">
                                    <textarea type="text" class="form-control" name="body"
                                              value="">{{ $body ?? null }}</textarea>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
