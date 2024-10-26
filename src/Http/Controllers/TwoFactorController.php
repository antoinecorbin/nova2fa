<?php

namespace Antoinecorbin\Nova2fa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Nova;

class TwoFactorController
{
    public function showVerificationForm()
    {
        return view('nova2fa::verify');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $user = Auth::user();
        $code = $request->input('code');

        if (Cache::get("2fa_code_{$user->id}") === $code) {
            $request->session()->put('2fa_passed', true);

            return redirect(Nova::path());
        }

        return redirect()->back()->withErrors(['code' => 'Le code est incorrect.']);
    }
}
