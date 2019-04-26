@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">

                            <div class="form-group row">
                                <label for="first_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.first_name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                           name="first_name" value="{{ $user->first_name }}" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.last_name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                           name="last_name" value="{{ $user->last_name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.patronymic') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="t"
                                           class="form-control{{ $errors->has('patronymic') ? ' is-invalid' : '' }}"
                                           name="last_name" value="{{ $user->patronymic }}" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ $user->email }}" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jobs"
                                       class="col-md-4 col-form-label text-md-right">Job</label>

                                <div class="col-md-6">
                                    <input id="jobs" type="text"
                                           class="form-control{{ $errors->has('jobs') ? ' is-invalid' : '' }}"
                                           name="jobs" value="{{ $user->jobs }}" readonly>

                                </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('users.edit', $user->id) }}" type="submit" class="btn btn-primary">
                                    Changed
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
