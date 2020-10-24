<div class="bg-white rounded shadow-sm mb-3">
    @if(session('status') == 'two-factor-authentication-enabled')
        {{-- Show SVG QR Code, After Enabling 2FA --}}
        <div class="text-muted m-3">
            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
        </div>

        <div class="border border-primary rounded text-center mb-3 p-3">
            {!! auth()->user()->twoFactorQrCodeSvg() !!}
        </div>
    @endif

    {{-- Show 2FA Recovery Codes --}}
    <div class="text-muted m-3">
        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
    </div>

    <pre class="border rounded mb-3">
                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
            <div class="text-muted">{{ $code }}</div>
        @endforeach
        </pre>
</div>
