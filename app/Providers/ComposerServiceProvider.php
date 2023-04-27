<?php

namespace App\Providers;

use App\Models\Category;
use App\Http\ViewComposers\CategoriesComposer;
use App\Http\ViewComposers\WishlistComposer;
use App\Http\ViewComposers\CartComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.layout', CategoriesComposer::class);
        view()->composer('layouts.layout', WishlistComposer::class);
        view()->composer('layouts.layout', CartComposer::class);
    }
}
