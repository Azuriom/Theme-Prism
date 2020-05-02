@extends('admin.layouts.admin')

@section('footer_description', 'Theme config')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST">
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

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
