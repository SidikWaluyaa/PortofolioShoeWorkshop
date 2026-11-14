<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DonationDraft;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if (!$request->user()->hasVerifiedEmail() && $request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // A donation saved before registering waits to be sent, even if the link is opened in another browser
        if (DonationDraft::current($request->user())) {
            $request->session()->forget('url.intended');

            return redirect()->route('adapt-adopt.donasi.review');
        }

        return redirect()->intended(route('home', absolute: false).'?verified=1');
    }
}
