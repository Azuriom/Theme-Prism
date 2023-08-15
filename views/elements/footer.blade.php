<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-uppercase">{{ trans('theme::prism.footer.about') }}</h4>

            <p>{!! theme_config('footer_description') !!}</p>
        </div>
        <div class="col-md-3 links">
            <h4 class="text-uppercase">{{ trans('theme::prism.footer.links') }}</h4>

            <ul class="list-unstyled">
                @foreach(theme_config('footer_links') ?? [] as $link)
                    <li>
                        <a href="{{ $link['value'] }}"><i class="bi bi-chevron-right"></i> {{ $link['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-3 links">
            <h4 class="text-uppercase">{{ trans('theme::prism.footer.social') }}</h4>

            <ul class="list-inline">
                @foreach(social_links() as $link)
                    <a href="{{ $link->value }}" target="_blank" rel="noopener noreferrer" class="list-inline-item" data-bs-toggle="tooltip" title="{{ $link->title }}">
                        <i class="{{ $link->icon }} fs-2 mx-1"></i>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            {{ setting('copyright') }}
        </div>
        <div class="col-md-6 text-md-end">
            @lang('messages.copyright')
        </div>
    </div>
</div>
