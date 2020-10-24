@extends('platform::auth')

@section('content')

    <h1 class="h4 text-black mb-4">{{ __('Verify Your Email Address') }}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          data-controller="layouts--form"
          data-action="layouts--form#submit"
          data-layouts--form-button-animate="#button-login"
          data-layouts--form-button-text="{{ __('Loading...') }}"
          action="{{ route('verification.send') }}">
        @csrf

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-info rounded shadow-sm" role="alert">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <p>
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>

        <div class="row align-items-center">
            <div class="ml-auto col-md-8 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default btn-block">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </div>
@endsection
