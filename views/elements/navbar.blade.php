<header>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="navbar-logo">
                    <img src="{{ site_logo() }}" alt="{{ site_name() }}" data-tilt data-tilt-scale="1.1">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @foreach($navbar as $element)
                        @if($loop->index < ($loop->count / 2))
                            @if(!$element->isDropdown())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $element->name }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $element->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach($element->elements as $childElement)
                                            <a class="dropdown-item" href="{{ $childElement->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $childElement->name }}</a>
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
                                    <a class="nav-link" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $element->name }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $element->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach($element->elements as $childElement)
                                            <a class="dropdown-item" href="{{ $childElement->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener" @endif>{{ $childElement->name }}</a>
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
                    <div class="media mr-md-5">
                        <i class="fas fa-chart-bar fa-3x mr-2"></i>
                        <div class="media-body">
                            @if($server)
                                <h5 class="mb-0">{{ $server->address }}</h5>
                                {{ trans_choice('theme::prism.header.online', $server->getOnlinePlayers()) }}
                            @else
                                <h5 class="mb-0">{{ trans('theme::prism.header.offline') }}</h5>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    @auth
                        <a id="userDropdown" class="btn btn-outline-light btn-rounded dropdown-toggle my-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                {{ trans('messages.nav.profile') }}
                            </a>

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
                    @else
                        <div class="my-1 ml-md-5 btn-group">
                            @if(Route::has('register'))
                                <a class="btn btn-outline-light btn-rounded" href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                            @endif
                            <a class="btn btn-outline-light btn-rounded" href="{{ route('login') }}">{{ trans('auth.login') }}</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
