<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        if (Schema::hasTable('tbl_products')) {
            $products = DB::table('tbl_products')->get();
        }
          View ::share([
            'products'=> Product::get(),
            'users' => User::all(),
        ]);
    }
}
