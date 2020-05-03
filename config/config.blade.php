@extends('admin.layouts.admin')

@section('footer_description', 'Theme config')

@push('footer-scripts')
    <script>
        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="form-row"><div class="form-group col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="form-group col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<div class="input-group-append"><button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="fas fa-times"></i></button></div></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;

            document.getElementById('links').querySelectorAll('.form-row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="form-group">
                    <label for="colorSelect">{{ trans('messages.fields.color') }}</label>
                    <select class="custom-select @error('color') is-invalid @enderror" id="colorSelect" name="color">
                        @foreach(['red', 'blue', 'green', 'purple', 'orange', 'yellow', 'aqua', 'pink'] as $color)
                            <option value="{{ $color }}" @if(theme_config('color') === $color) selected @endif>{{ trans('theme::prism.colors.'.$color) }}</option>
                        @endforeach
                    </select>

                    @error('color')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="footerDescriptionInput">{{ trans('theme::prism.config.footer_description') }}</label>
                    <input type="text" class="form-control @error('footer_description') is-invalid @enderror" id="footerDescriptionInput" name="footer_description" value="{{ old('footer_description', theme_config('footer_description')) }}">

                    @error('footer_description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                @foreach(['twitter', 'youtube', 'discord', 'teamspeak', 'instagram'] as $social)
                    <div class="form-group">
                        <label for="{{ $social }}Input">{{ trans('theme::prism.config.'.$social) }}</label>
                        <input type="text" class="form-control @error('footer_social_'.$social) is-invalid @enderror" id="{{ $social }}Input" name="footer_social_{{ $social }}" value="{{ old('footer_social_'.$social, theme_config('footer_social_'.$social)) }}">

                        @error('footer_social_'.$social)
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                @endforeach

                <label>{{ trans('theme::prism.config.footer_links') }}</label>

                <div id="links">

                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger link-remove" type="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-2">
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
