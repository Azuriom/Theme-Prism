@extends('layouts.app')

@section('title', trans('auth.register'))

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="page-title">{{ trans('auth.register') }}</h1>

                <form method="POST" action="{{ route('register') }}" id="captcha-form">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ trans('auth.name') }}</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user fa-fw"></i></span>
                            </div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">{{ trans('auth.email') }}</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope fa-fw"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">{{ trans('auth.password') }}</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{ trans('auth.confirm-password') }}</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                            </div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    @if($conditions !== null)
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input @error('conditions') is-invalid @enderror" type="checkbox" name="conditions" id="conditions" {{ old('conditions') ? 'checked' : '' }}>

                                <label class="custom-control-label" for="conditions">
                                    @lang('auth.conditions', ['url' => $conditions])
                                </label>

                                @error('conditions')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    @include('elements.captcha')

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ trans('auth.register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
