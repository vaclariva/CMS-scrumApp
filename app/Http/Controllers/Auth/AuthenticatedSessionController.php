<?php

namespace App\Http\Controllers\Auth;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        
        //$product = Product::first();

        $request->authenticate();

        $request->session()->regenerate();

        $cookieLifetime = 10080; // Seminggu
        Cookie::queue(Cookie::make('status', 'admin', $cookieLifetime));
        info('masuk');

        //if ($product->exists()){
            //return redirect(route('product.index'));    
        //}
        //return redirect()->intended(route('product', absolute: false));

        if ($this->isTwoFactor($request)) {
            info('masuk atas');
            $request->user()->sendTwoFactorNotification($request);

            return redirect()->intended(route('product', absolute: false));
            // return response()->json([
            //     'message' => 'Mengalihkan ..',
            //     'redirect' => route('twofactor.verify')
            // ], 200);
        } else {
            info('masuk Bawah');
            return redirect()->intended(route('product', absolute: false));
        }

        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Check if two factor authentication is enabled.
     */
    protected function isTwoFactor(Request $request): bool
    {
        return $request->user()->enabled_2fa ? true : false;
    }
}
