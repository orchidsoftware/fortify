@extends('platform::auth')
@section('title', __('Two-Factor Authentication'))

@section('content')
    <h1 class="h4 text-black mb-4">
        <x-orchid-icon path="screen-smartphone" class="h4 mr-1"/>

        {{__('Two-Factor Authentication')}}
    </h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="layouts--form"
          data-action="layouts--form#submit"
          data-layouts--form-button-animate="#button-login"
          data-layouts--form-button-text="{{ __('Loading...') }}"
          action="{{ url('two-factor-challenge') }}">
        @csrf

        <div class="form-group">
            <p>
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </p>
            {!!
                \Orchid\Screen\Fields\Input::make('code')
                ->autofocus()
                ->placeholder('Verification code from application')
                ->title('Authentication code:')
            !!}
        </div>

        <div class="form-group">
            {!!
                \Orchid\Screen\Fields\Input::make('recovery_code')
                ->autofocus()
                ->placeholder('Emergency recovery code')
                ->help('Please confirm access to your account by entering one of your emergency recovery codes.')
                ->title('Recovery Code:')
            !!}
        </div>

        <div class="row align-items-center">
            <div class="ml-auto col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="2">
                    {{__('Login')}}
                </button>
            </div>
        </div>
    </form>

@endsection
