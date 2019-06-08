@extends('layouts.app')

@section('content')

    @foreach($magazines as $magazine)

        <div class="card">

            <div class="card-header">
                <a href="{{ route('magazines.show', $magazine->id) }}" style="font-size: 20px">{{ Date::parse($magazine->created_at)->format('F Y') }}</a>

                @if(Auth::user()->isRoot)
                    <a class="btn btn-outline-primary btn-sm float-right"
                       href="{{ route('magazines.edit', $magazine->id) }}">{{ __('message.fields.edit') }}</a>

                    <form class="d-inline" method="post" action="{{ route('magazines.destroy', $magazine->id) }}">
                        @method('delete')
                        @csrf
                        <button class="btn btn-outline-danger btn-sm float-right">
                            <i class="fa fa-trash"></i> {{ __('message.fields.delete') }}
                        </button>
                    </form>
                @endif
            </div>

        </div>
        <br>
    @endforeach

@endsection
