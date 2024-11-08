<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        $twoFactor = $user->twoFactors->where('two_factor_ip', $request->ip())->first();
        
        if (
            auth()->check()
            && $user->enabled_2fa === 1
            && $twoFactor
            && optional($twoFactor)->two_factor_code != null
        ) {
            
            if ($twoFactor->two_factor_expires_at->lt(now())) {
                $user->deleteTwoFactorCode($request->ip());
                auth()->logout();

                return redirect()->route('login')
                    ->with('error', 'The two factor code has expired. Please login again.');
            }

            if (!$request->is('verify*')) {
                return redirect()->route('verify.index');
            }
        } else {
            
            if (! $twoFactor && $user->enabled_2fa === 1) {
                auth()->logout();
                return redirect()->route('login');
            }
        }

        return $next($request);

    }
}
