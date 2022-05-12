<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::with('subCategory')
        ->has('articles', '>', 0)
        ->whereNull('pid')
        ->where('status','1')
        ->get();
        View::share('categories', $categories);

        Paginator::useBootstrap();
    }
}
