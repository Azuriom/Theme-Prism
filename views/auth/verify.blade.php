@extends('layouts.app')

@section('title', trans('auth.verify'))

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="page-title">{{ trans('auth.verify') }}</h1>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ trans('auth.verify-sent') }}
                    </div>
                @endif

                <p>{{ trans('auth.verify-check') }}</p>
                <p>{{ trans('auth.verify-request') }}</p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block">{{ trans('auth.verify-resend') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
