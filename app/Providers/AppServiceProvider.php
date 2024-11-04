<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    //public function boot(): void
    //{
        //View ::share([
            //'products'=> Product::get(),
           // 'users' => User::all(),
        //]);
    //}

    public function boot()
    {
        Event::listen(Authenticated::class, function ($event) {

        $products = collect();

        if (auth()->check()) {
            $currentUser = auth()->user();

            if ($currentUser->role_id == 2) {
                $products = Product::latest()->get();
            } else {
                $products = Product::where('user_id', $currentUser->id)->latest()->get();
            }
        }

            View::share([
                'products' => $products,
                'users' => User::all(),
            ]);
        });
    }
}
