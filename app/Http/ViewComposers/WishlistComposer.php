<?php

namespace App\Http\ViewComposers;

use App\Models\Wishlist;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class WishlistComposer
{
    public function compose(View $view)
    {
        if(Auth::user()) {
            return $view->with('wishlist',
                Wishlist::where('user', Auth::user()->id)
                        ->count());
        }
    }
}
