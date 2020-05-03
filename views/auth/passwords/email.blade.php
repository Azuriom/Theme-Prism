@extends('layouts.app')

@section('title', trans('auth.passwords.reset'))

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="page-title">{{ trans('auth.passwords.reset') }}</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" id="captcha-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ trans('auth.email') }}</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope fa-fw"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @include('elements.captcha')

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ trans('auth.passwords.send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
