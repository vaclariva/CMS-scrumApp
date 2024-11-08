<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreTwoFactorRequest;

class TwoFactorController extends Controller
{
    /**
     * Return View Page for verify Code Two Factor.
     */
    public function verify(): View
    {
        try {
            return view('pages.two-factor.verification', [
                'email' => auth()->user() ? auth()->user()->email : null
            ]);
        } catch (\Throwable $th) {
            Log::info($th->getMessage());

            abort(500);
        }
    }

    /**
     * Validate the two factor code.
     */
    public function validateTwoFactor(StoreTwoFactorRequest $request)
    {
        try {
            $twoFactor = $request->user()->twoFactors->where('two_factor_ip', $request->ip())->first();

            if ($twoFactor) {
                if ($request->two_factor_code == $twoFactor->two_factor_code) {
            
                    $request->user()->resetTwoFactorCode($request->ip());
    
                    return redirect()->intended(route('product', absolute: false));
                }

                return redirect()->back()->withInput()->with('error', 'Kode Two Factor tidak valid.');
            } else {
                return redirect()->route('login');
            }
        
        } catch (\Throwable $th) {
            info($th->getMessage());

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * resend two factor code.
     */
    public function resend(Request $request)
    {
        try {
            $request->user()->sendTwoFactorNotification($request);

            return response()->json([
                'message' => 'Kode two factor authentification sudah dikirim ulang ke email',
                // 'redirect' => route('verify.index')
            ]);
        } catch (\Throwable $th) {
            info($th->getMessage());

            abort(500);
        }
    }
}
