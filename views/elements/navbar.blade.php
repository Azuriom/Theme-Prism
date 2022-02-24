<nav class="navbar navbar-expand-md navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <div class="navbar-logo">
                <img src="{{ site_logo() }}" alt="{{ site_name() }}" data-tilt data-tilt-scale="1.1">
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @foreach($navbar as $element)
                    @if($loop->index < ($loop->count / 2))
                        @if(!$element->isDropdown())
                            <li class="nav-item">
                                <a class="nav-link @if($element->isCurrent()) active @endif" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $element->name }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle @if($element->isCurrent()) active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $element->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($element->elements as $childElement)
                                        <a class="dropdown-item @if($childElement->isCurrent()) text-primary @endif" href="{{ $childElement->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $childElement->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @foreach($navbar as $element)
                    @if($loop->index >= ($loop->count / 2))
                        @if(!$element->isDropdown())
                            <li class="nav-item">
                                <a class="nav-link @if($element->isCurrent()) active @endif" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $element->name }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $element->id }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $element->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $element->id }}">
                                    @foreach($element->elements as $childElement)
                                        <a class="dropdown-item @if($childElement->isCurrent()) active @endif" href="{{ $childElement->getLink() }}" @if($childElement->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $childElement->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</nav>

<div class="sub-navbar bg-primary py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="d-flex me-lg-5 align-items-center">
                    <i class="flex-shrink-0 fas fa-chart-bar fa-3x me-2"></i>
                    <div class="flex-grow-1">
                        @if($server && $server->isOnline())
                            @if(theme_config('use_play_button') !== 'on')
                                <div class="mb-0">
                                    <span title="{{ trans('messages.actions.copy') }}" class="copy-address bg-dark h6"
                                          data-copied="{{ trans('theme::prism.clipboard.copied') }}" data-copy-error="{{ trans('theme::prism.clipboard.error') }}">
                                        {{ $server->fullAddress() }}
                                    </span>
                                </div>
                            @else
                                <h5 class="mb-0">{{ $server->name }}</h5>
                            @endif
                            {{ trans_choice('theme::prism.header.online', $server->getOnlinePlayers()) }}
                        @else
                            <h5 class="mb-0">{{ trans('theme::prism.header.offline') }}</h5>
                        @endif
                    </div>

                    @if(theme_config('use_play_button') === 'on')
                        <a href="{{ theme_config('play_button_link') }}" class="btn btn-outline-light btn-rounded ms-3">
                            {{ trans('theme::prism.play') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-md-6 text-center prism-nav-right">
                @auth
                    @include('elements.notifications')

                    <div class="dropdown">
                        <a id="userDropdown" class="btn btn-outline-light btn-rounded dropdown-toggle my-1" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                {{ trans('messages.nav.profile') }}
                            </a>

                            @foreach(plugins()->getUserNavItems() ?? [] as $navId => $navItem)
                                <a class="dropdown-item" href="{{ route($navItem['route']) }}">
                                    {{ trans($navItem['name']) }}
                                </a>
                            @endforeach

                            @if(Auth::user()->hasAdminAccess())
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    {{ trans('messages.nav.admin') }}
                                </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ trans('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <div class="my-1 ml-lg-5 btn-group">
                        @if(Route::has('register'))
                            <a class="btn btn-outline-light btn-rounded" href="{{ route('register') }}">
                                {{ trans('auth.register') }}
                            </a>
                        @endif
                        <a class="btn btn-outline-light btn-rounded" href="{{ route('login') }}">
                            {{ trans('auth.login') }}
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
