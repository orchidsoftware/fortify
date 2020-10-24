@extends('platform::auth')

@section('content')

    <h1 class="h4 text-black mb-4">{{ __('Confirm password') }}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="layouts--form"
          data-action="layouts--form#submit"
          data-layouts--form-button-animate="#button-login"
          data-layouts--form-button-text="{{ __('Loading...') }}"
          action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">

            <label class="form-label">
                {{__('Password')}}
            </label>

            {!!  \Orchid\Screen\Fields\Password::make('password')
                ->required()
                ->tabindex(1)
                ->autofocus()
                ->placeholder(__('Enter your password'))
            !!}
        </div>

        <div class="row align-items-center">
            <div class="form-group col-md-6 col-xs-12">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            <div class="col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="3">
                    {{ __('Confirm password') }}
                </button>
            </div>
        </div>
    </form>



@endsection
