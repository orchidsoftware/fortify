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
        $twoFactorSecret = auth()->user()->two_factor_secret;


        return DropDown::make('Two-Factor Auth')
            ->icon('screen-smartphone')
            ->canSee(Features::canManageTwoFactorAuthentication())
            ->list([

                ModalToggle::make('Show Recovery Codes')
                    ->icon('lock-open')
                    ->modal('two-factor-auth')
                    ->canSee(! empty($twoFactorSecret))
                    ->open(session('two-factor-auth') === 'show'),

                Button::make('Enable Two-Factor')
                    ->icon('unlock')
                    ->canSee(empty($twoFactorSecret))
                    ->method('enableTwoFactorAuth'),

                Button::make('Regenerate Recovery Codes')
                    ->icon('refresh')
                    ->canSee(! empty($twoFactorSecret))
                    ->method('generateNewRecoveryCodes'),

                Button::make('Disable Two-Factor')
                    ->icon('lock-open')
                    ->canSee(! empty($twoFactorSecret))
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
            ->title(__('Two factor authentication'))
            ->staticBackdrop()
            ->withoutApplyButton();
    }

    /**
     * Disable two-factor authentication for the given user.
     *
     * @param Request                        $request
     * @param DisableTwoFactorAuthentication $disableTwoFactorAuthentication
     */
    public function disableTwoFactorAuth(Request $request, DisableTwoFactorAuthentication $disableTwoFactorAuthentication)
    {
        $disableTwoFactorAuthentication($request->user());

        Toast::success(__('Two-factor authentication has been disabled.'));
    }

    /**
     * Generate new recovery codes for the user.
     *
     * @param Request                  $request
     * @param GenerateNewRecoveryCodes $generateNewRecoveryCodes
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateNewRecoveryCodes(Request $request, GenerateNewRecoveryCodes $generateNewRecoveryCodes)
    {
        $generateNewRecoveryCodes($request->user());

        Toast::success(__('Recovery codes have been updated.'));

        return back()->with('two-factor-auth', 'show');
    }

    /**
     * Enable two-factor authentication for the user.
     *
     * @param Request                       $request
     * @param EnableTwoFactorAuthentication $enableTwoFactorAuthentication
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enableTwoFactorAuth(Request $request, EnableTwoFactorAuthentication $enableTwoFactorAuthentication)
    {
        $enableTwoFactorAuthentication($request->user());

        Toast::success(__('Two-factor authentication has been enabled.'));

        return back()
            ->with('two-factor-auth', 'show')
            ->with('status', 'two-factor-authentication-enabled');
    }
}
