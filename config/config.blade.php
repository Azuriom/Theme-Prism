@extends('admin.layouts.admin')

@section('footer_description', 'Theme config')

@push('footer-scripts')
    <script>
        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-3"><div class="mb-3 col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="mb-3 col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="fas fa-times"></i></button></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;

            document.getElementById('links').querySelectorAll('.row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="colorSelect">{{ trans('messages.fields.color') }}</label>
                    <select class="form-select @error('color') is-invalid @enderror" id="colorSelect" name="color">
                        @foreach(['red', 'blue', 'green', 'purple', 'orange', 'yellow', 'aqua', 'pink'] as $color)
                            <option value="{{ $color }}" @if(theme_config('color') === $color) selected @endif>
                                {{ trans('theme::prism.colors.'.$color) }}
                            </option>
                        @endforeach
                    </select>

                    @error('color')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="titleInput">{{ trans('theme::prism.config.home_title') }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" value="{{ old('title', theme_config('title')) }}">

                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                @php $usePlayButton = old('use_play_button', theme_config('use_play_button')) === 'on' @endphp

                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="playButtonSwitch" name="use_play_button" data-bs-toggle="collapse" data-bs-target="#playButtonGroup" @if($usePlayButton) checked @endif>
                    <label class="form-check-label" for="playButtonSwitch">{{ trans('theme::prism.config.use_play_button') }}</label>
                </div>

                <div id="playButtonGroup" class="{{ $usePlayButton ? 'show' : 'collapse' }}">
                    <div class="card card-body mb-2">
                        <div class="mb-3">
                            <label class="form-label" for="playButtonLink">{{ trans('theme::prism.config.play_button_link') }}</label>
                            <input type="text" class="form-control @error('play_button_link') is-invalid @enderror" id="playButtonLink" name="play_button_link" value="{{ old('play_button_link', theme_config('play_button_link')) }}">

                            @error('play_button_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="footerDescriptionInput">{{ trans('theme::prism.config.footer_description') }}</label>
                    <textarea class="form-control @error('footer_description') is-invalid @enderror" id="footerDescriptionInput" name="footer_description" rows="3">{{ old('footer_description', theme_config('footer_description')) }}</textarea>

                    @error('footer_description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <label class="form-label">{{ trans('theme::prism.config.footer_links') }}</label>

                <div id="links">
                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <div class="row g-3">
                            <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                    <button class="btn btn-outline-danger link-remove" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
