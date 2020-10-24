<?php

namespace Orchid\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Laravel\Fortify\Features;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

trait TwoFactorScreenAuthenticatable
{
    /**
     * @return DropDown
     */
    public function twoFactorCommandBar(): DropDown
    {
        return DropDown::make(__('Two-Factor Auth'))
            ->icon('screen-smartphone')
            ->canSee(Features::canManageTwoFactorAuthentication())
            ->list([

                ModalToggle::make(__('Show Recovery Codes'))
                    ->icon('lock-open')
                    ->modal('two-factor-auth')
                    ->canSee(! empty(auth()->user()->two_factor_secret))
                    ->open(session('two-factor-auth') === 'show'),

                Button::make('Enable Two-Factor')
                    ->icon('unlock')
                    ->canSee(empty(auth()->user()->two_factor_secret))
                    ->method('enableTwoFactorAuth'),

                Button::make('Regenerate Recovery Codes')
                    ->icon('refresh')
                    ->canSee(! empty(auth()->user()->two_factor_secret))
                    ->method('generateNewRecoveryCodes'),

                Button::make(__('Disable Two-Factor'))
                    ->icon('lock-open')
                    ->canSee(! empty(auth()->user()->two_factor_secret))
                    ->method('disableTwoFactorAuth'),
            ]);
    }

    /**
     * @return Modal
     */
    public function twoFactorLayout(): Modal
    {
        return Layout::modal('two-factor-auth', [
            Layout::view('orchid-fortify::profile.two-factor-authentication-form'),
        ])
            ->title('Two factor authentication')
            ->staticBackdrop()
            ->withoutApplyButton();
    }

    /**
     * Disable two-factor authentication for the given user.
     *
     * @param Request $request
     */
    public function disableTwoFactorAuth(Request $request)
    {
        $disableTwoFactorAuthentication = app(DisableTwoFactorAuthentication::class);

        $disableTwoFactorAuthentication($request->user());

        Toast::success(__('Two-factor authentication has been disabled.'));
    }

    /**
     * Generate new recovery codes for the user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateNewRecoveryCodes(Request $request)
    {
        $disableTwoFactorAuthentication = app(GenerateNewRecoveryCodes::class);

        $disableTwoFactorAuthentication($request->user());

        Toast::success(__('Recovery codes have been updated.'));

        return back()->with('two-factor-auth', 'show');
    }

    /**
     * Enable two-factor authentication for the user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enableTwoFactorAuth(Request $request)
    {
        $disableTwoFactorAuthentication = app(EnableTwoFactorAuthentication::class);

        $disableTwoFactorAuthentication($request->user());

        Toast::success(__('Two-factor authentication has been enabled.'));

        return back()
            ->with('two-factor-auth', 'show')
            ->with('status', 'two-factor-authentication-enabled');
    }
}
