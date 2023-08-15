@extends('layouts.base')

@section('title', trans('messages.home'))

@section('app')
    <div class="home-background @if(theme_config('title')) background-overlay @endif mb-4" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') no-repeat center / cover">
        @if(theme_config('title'))
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">

                    <div class="col-md-6 text-center">
                        <h1 class="display-2 position-relative text-light">
                            {{ theme_config('title') }}
                        </h1>
                    </div>

                </div>
            </div>
        @endif
    </div>

    <div class="container home-container">
        @include('elements.session-alerts')

        @if($message)
            <div class="card mb-5">
                <div class="card-body">
                    {{ $message }}
                </div>
            </div>
        @endif

        @if(! $servers->isEmpty())
            <h2 class="text-center mb-3">
                {{ trans('messages.servers') }}
            </h2>

            <div class="row gy-3 justify-content-center mb-5">
                @foreach($servers as $server)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h3 class="card-title">
                                    {{ $server->name }}
                                </h3>

                                @if($server->isOnline())
                                    <div class="progress mb-1">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $server->getPlayersPercents() }}%">
                                        </div>
                                    </div>

                                    <p class="mb-1">
                                        {{ trans_choice('messages.server.total', $server->getOnlinePlayers(), [
                                            'max' => $server->getMaxPlayers(),
                                        ]) }}
                                    </p>
                                @else
                                    <p>
                                        <span class="badge bg-danger text-white">
                                            {{ trans('messages.server.offline') }}
                                        </span>
                                    </p>
                                @endif

                                @if($server->joinUrl())
                                    <a href="{{ $server->joinUrl() }}" class="btn btn-primary">
                                        {{ trans('messages.server.join') }}
                                    </a>
                                @else
                                    <p class="card-text">{{ $server->fullAddress() }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if(! $posts->isEmpty())
            <h2 class="text-center mb-3">
                {{ trans('messages.news') }}
            </h2>
        @endif

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="post-preview">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-white">
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
