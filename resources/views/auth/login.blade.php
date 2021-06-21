@extends('platform::auth')
@section('title', __('Sign in to your account'))

@section('content')
    <h1 class="h4 text-black mb-4">{{__('Sign in to your account')}}</h1>

    <form
        role="form"
        method="POST"
        data-controller="form"
        data-action="form#submit"
        data-turbo="{{ var_export(Str::startsWith(request()->path(), config('platform.prefix'))) }}"
        data-form-button-animate="#button-login"
        data-form-button-text="{{ __('Loading...') }}"
        action="{{ route('login') }}">
        @csrf

        @include('platform::auth.signin')


        @if (Route::has('password.request') || Route::has('register'))
            <hr class="mt-4">

            <p class="text-center mb-0">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">
                        {{ __('Create account') }}
                    </a>
                @endif

                @if (Route::has('password.request') && Route::has('register'))
                        <span class="text-muted mx-2">/</span>
                @endif

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </p>
        @endif

    </form>
@endsection
