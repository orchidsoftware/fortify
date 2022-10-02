@extends('platform::auth')
@section('title', __('Forgot your password?'))

@section('content')
    <h1 class="h4 text-black mb-4">{{ __('Reset Password') }}</h1>

    <form
        role="form"
        method="POST"
        data-controller="form"
        data-action="form#submit"
        data-turbo="{{ var_export(Str::startsWith(request()->path(), config('platform.prefix'))) }}"
        data-form-button-animate="#button-login"
        data-form-button-text="{{ __('Loading...') }}"
        action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <div class="form-group">
            {!!  \Orchid\Screen\Fields\Input::make('email')
                ->type('email')
                ->required()
                ->tabindex(1)
                ->autofocus()
                ->title('Email address')
                ->placeholder(__('Enter your email'))
            !!}
        </div>

        <div class="form-group">
            {!!  \Orchid\Screen\Fields\Password::make('password')
                ->title('Password')
                ->autocomplete('new-password')
                ->required()
                ->tabindex(2)
                ->placeholder(__('Enter password'))
            !!}
        </div>

        <div class="form-group">
            {!!  \Orchid\Screen\Fields\Password::make('password_confirmation')
                ->title('Confirm Password')
                ->autocomplete('new-password')
                ->required()
                ->tabindex(3)
                ->placeholder(__('Enter password'))
            !!}
        </div>

        <div class="row align-items-center">
            <div class="ml-auto col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default" tabindex="4">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </form>
@endsection
