<?php

namespace App\Http\ViewComposers;

use App\Models\Cart;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartComposer
{
    public function compose(View $view)
    {
        if(Auth::user()) {
            return $view->with('cart',
                Cart::where('user', Auth::user()->id)
                ->leftJoin('products', 'carts.product', 'products.id')
                ->select(DB::raw('COUNT(products.id) as count, SUM(carts.count * `products`.`price`) as sum'))
                ->get())
                ->with('cartProducts',
                Cart::where('user', Auth::user()->id)
                    ->leftJoin('products', 'carts.product', 'products.id')
                    ->select('products.id', 'products.name', 'products.title',
                            'products.price', 'products.image', 'carts.count as count')
                    ->get());
        }
    }
}
