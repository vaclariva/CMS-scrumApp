<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateTwoFactorRequest;

class SettingController extends Controller
{
        /** =================================
     * TWO FACTOR SETTINGS
    ==================================== */

    /**
     * Show the page for two factor settings.
     */
    public function showTwoFactorPage(): View
    {
        try {
            return view('setting.two-factor', [
                'enabled_2fa' => auth()->user()->enabled_2fa ? true : false,
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update two factor settings.
     */
    public function updateTwoFactor(UpdateTwoFactorRequest $request): JsonResponse
    {
        try {
            
            DB::beginTransaction();
            info($request);
            auth()->user()->update($request->validated());

            if (! auth()->user()->enabled_2fa) {
                auth()->user()->twoFactors()->delete();
            }

            DB::commit();

            return response()->json([
                'message' => trans('admin.update-success'),
                'redirect' => route('settings.twofactors.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('admin.update-failed'),
            ], 500);
        }
    }

}
