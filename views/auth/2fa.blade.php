@extends('layouts.app')

@section('title', trans('auth.login'))

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="page-title">{{ trans('auth.login') }}</h1>

                <form method="POST" action="{{ route('login.2fa') }}">
                    @csrf

                    <div class="form-group">
                        <label for="code">{{ trans('auth.2fa-code') }}</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                            </div>
                            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required>

                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ trans('auth.login') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
