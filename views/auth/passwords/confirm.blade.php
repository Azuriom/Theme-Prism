@extends('layouts.app')

@section('title', trans('auth.passwords.confirm'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h1 class="page-title">{{ trans('auth.passwords.confirm') }}</h1>

                    {{ trans('auth.need-confirm') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group">
                            <label for="password">{{ trans('auth.password') }}</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            {{ trans('auth.passwords.confirm') }}
                        </button>

                        <div class="text-center">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ trans('auth.forgot-password') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
