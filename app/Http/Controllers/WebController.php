<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index() {
        $ratings = DB::table('reviews')
            ->groupBy('product')
            ->select('product', DB::raw('ROUND(AVG(CAST(rating as FLOAT)), 2) as rating'));

        $products = DB::table('products')
            ->leftJoin('categories', 'categories.id', 'products.category')
            ->leftJoinSub($ratings, 'ratings', function($join) {
                $join->on('ratings.product', 'products.id');
            })
            ->where('products.available', true)
            ->where('remain', '>', 0)
            ->orderByDesc('id')
            ->limit(10)
            ->select('products.id', 'products.name', 'products.title',
                     'products.price', 'products.image', 'categories.name as category',
                     'ratings.rating')
            ->get();

        $categories = DB::table('categories')
            ->orderBy('name')
            ->limit(3)
            ->get();

        return view('index', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function notFoundPage() {
        return view('404');
    }

    public function categories() {
        $categories = DB::table('categories')
            ->orderBy('title')
            ->where('available', true)->get();

        return view('categories', [
            'categories' => $categories
        ]);
    }

    public function sales() {
        

        return view('sales');
    }

    public function products(Request $request) {
        $categories = DB::table('categories')
            ->where('available', true)
            ->orderBy('title')
            ->get();

        $prices = DB::table('products')
            ->selectRaw('MIN(price) AS min, MAX(price) AS max')
            ->get();

        $ratings = DB::table('reviews')
        ->groupBy('product')
        ->select('product', DB::raw('ROUND(AVG(CAST(rating as FLOAT)), 2) as rating'));

        $products = DB::table('products')
            ->leftJoin('categories', 'categories.id', 'products.category')
            ->leftJoinSub($ratings, 'ratings', function($join) {
                $join->on('ratings.product', 'products.id');
            })
            ->where('products.available', true)
            ->where('remain', '>', 0)
            ->select('products.id', 'products.name', 'products.title',
                    'products.price', 'products.image', 'categories.name as category',
                    'ratings.rating');
        
        if($request->category) $products = $products->whereIn('category', explode('-', $request->category));
        $products = $products
            ->orderBy($request->sort ? $request->sort : 'price', $request->order ? $request->order : 'asc')
            ->get();

        // if($request->user) {
        //     foreach($products as $product){
        //         $inBasket = DB::table('carts')
        //         ->where('user', $request->user['user'])
        //         ->where('product', $product->id)
        //         ->first();
        //         $product->inBasket = $inBasket ? true : false;
        //     }
        // }

        return view('products', [
            'categories' => $categories,
            'products' => $products,
            'prices' => $prices
        ]);
    }

    public function product(Request $request, $id) {
        $product = DB::table('product')
            ->where('id_product', $id)
            ->first();
        if(!$product) return redirect(route(404));

        if($request->user) $inBasket = DB::table('basket')
            ->where('id_user', $request->user['user_id'])
            ->where('id_product', $product->id_product)
            ->first();
        $product->inBasket = $inBasket ? true : false;

        return view('product', [
            'product' => $product
        ]);
    }

    public function search(Request $request) {
        $categories = DB::table('categories')
            ->where('available', true)
            ->orderBy('title')
            ->get();

        $ratings = DB::table('reviews')
        ->groupBy('product')
        ->select('product', DB::raw('ROUND(AVG(CAST(rating as FLOAT)), 2) as rating'));

        $products = DB::table('products')
            ->leftJoin('categories', 'categories.id', 'products.category')
            ->leftJoinSub($ratings, 'ratings', function($join) {
                $join->on('ratings.product', 'products.id');
            })
            ->where('products.available', true)
            ->where('remain', '>', 0)
            ->where('products.title', 'LIKE', "%{$request->search}%")
            ->select('products.id', 'products.name', 'products.title',
                    'products.price', 'products.image', 'categories.name as category',
                    'ratings.rating');
        
        if($request->category) $products = $products->whereIn('category', explode('-', $request->category));
        $products = $products
            ->orderBy($request->sort ? $request->sort : 'price', $request->order ? $request->order : 'asc')
            ->get();

        return view('search', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
