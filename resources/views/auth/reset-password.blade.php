@extends('platform::auth')
@section('title', __('Forgot your password?'))

@section('content')
    <h1 class="h4 text-black mb-4">{{ __('Reset Password') }}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="layouts--form"
          data-action="layouts--form#submit"
          data-layouts--form-button-animate="#button-login"
          data-layouts--form-button-text="{{ __('Loading...') }}"
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
                ->required()
                ->tabindex(2)
                ->placeholder(__('Enter password'))
            !!}
        </div>

        <div class="form-group">
            {!!  \Orchid\Screen\Fields\Password::make('password_confirmation')
                ->title('Confirm Password')
                ->required()
                ->tabindex(3)
                ->placeholder(__('Enter password'))
            !!}
        </div>

        <div class="row align-items-center">
            <div class="ml-auto col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="4">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </form>
@endsection
