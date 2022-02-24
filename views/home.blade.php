@extends('layouts.base')

@section('title', trans('messages.home'))

@section('app')
    <div class="home-background @if(theme_config('title')) background-overlay @endif mb-4" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') no-repeat center / cover">
        @if(theme_config('title'))
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">

                    <div class="col-md-6 text-center">
                        <h1 class="welcome-title">{{ theme_config('title') }}</h1>
                    </div>

                </div>
            </div>
        @endif
    </div>

    <div class="container">
        @include('elements.session-alerts')

        @if($message)
            <div class="card mb-4">
                <div class="card-body">
                    {{ $message }}
                </div>
            </div>
        @endif

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="post-preview">
                        <a href="{{ route('posts.show', $post->slug) }}" class="link-unstyled">
                            @if($post->hasImage())
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="img-fluid rounded">

                                <div class="title p-3">{{ $post->title }}</div>
                            @else
                                <div class="preview-content p-4">
                                    <h4>{{ $post->title }}</h4>
                                    {{ Str::limit(strip_tags($post->content), 450) }}
                                </div>
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
