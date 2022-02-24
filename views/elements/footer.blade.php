<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4>{{ trans('theme::prism.footer.about') }}</h4>

            <p>{!! theme_config('footer_description') !!}</p>
        </div>
        <div class="col-md-3 links">
            <h4>{{ trans('theme::prism.footer.links') }}</h4>

            <ul class="list-unstyled">
                @foreach(theme_config('footer_links') ?? [] as $link)
                    <li>
                        <a href="{{ $link['value'] }}"><i class="fas fa-chevron-right"></i> {{ $link['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-3 social">
            <h4>{{ trans('theme::prism.footer.social') }}</h4>

            <ul class="list-inline">
                @foreach(social_links() as $link)
                    <li class="list-inline-item">
                        <a href="{{ $link->value }}" target="_blank" rel="noopener noreferrer" title="{{ $link->title }}">
                            <i class="{{ $link->icon }} fa-2x fa-fw"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <hr>

    <div class="row footer-bottom">
        <div class="col-md-6">
            {{ setting('copyright') }}
        </div>
        <div class="col-md-6 text-md-end">
            @lang('messages.copyright')
        </div>
    </div>
</div>
