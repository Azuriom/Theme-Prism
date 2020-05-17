@extends('layouts.app')

@section('title', trans('messages.home'))

@section('content')
    <div class="home-background mb-4" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') no-repeat center / cover">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">

                <div class="col-md-6 text-center">
                    <h1 class="welcome-title">{{ theme_config('title') }}</h1>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
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
