@if(\Laravel\Fortify\Features::canManageTwoFactorAuthentication())

    @if(session('status') == 'two-factor-authentication-enabled')
        {{-- Show SVG QR Code, After Enabling 2FA --}}
        <div class="px-4 py-2">
            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
        </div>

        <div class="text-center p-3">
            {!! auth()->user()->twoFactorQrCodeSvg() !!}
        </div>
    @endif

    @if(auth()->user()->two_factor_recovery_codes)
        {{-- Show 2FA Recovery Codes --}}
        <div class="px-4 py-2">
            {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
        </div>

        <div class="bg-light px-4 py-2">
            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                <p class="m-0 text-black">{{ $code }}</p>
            @endforeach
        </div>
    @endif
@endif
