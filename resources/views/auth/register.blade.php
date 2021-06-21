@extends('platform::auth')
@section('title', __('Register'))

@section('content')

    <h1 class="h4 text-black mb-4">{{ __('Register') }}</h1>

    <form
        role="form"
        method="POST"
        data-controller="form"
        data-turbo="{{ var_export(Str::startsWith(request()->path(), config('platform.prefix'))) }}"
        data-action="form#submit"
        data-form-button-animate="#button-login"
        data-form-button-text="{{ __('Loading...') }}"
        action="{{ route('register') }}">
        @csrf


        <div class="form-group">
            {!!
                \Orchid\Screen\Fields\Input::make('name')
                ->autofocus()
                ->placeholder('Sheldon Cooper')
                ->title('Name')
            !!}
        </div>

        <div class="form-group">
            {!!
                \Orchid\Screen\Fields\Input::make('email')
                ->type('email')
                ->placeholder('Enter your email')
                ->title('E-Mail Address')
            !!}
        </div>

        <div class="form-group">
            {!!  \Orchid\Screen\Fields\Password::make('password')
                ->title('Password')
                ->required()
                ->help('Use 8 or more characters with a mix of letters, numbers & symbols')
                ->placeholder(__('Enter password'))
            !!}
        </div>

        <div class="form-group">
            {!!  \Orchid\Screen\Fields\Password::make('password_confirmation')
                ->title('Confirm Password')
                ->required()
                ->placeholder(__('Enter password'))
            !!}
        </div>

        <div class="row align-items-center">
            <div class="ml-auto col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>

@endsection
