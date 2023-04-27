<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin(Request $request) {
        if($this->isAdmin($request)) {
            $categories = DB::table('categories')->get();

            $products = DB::table('products')
            ->leftJoin('categories', 'products.category', '=', 'categories.id')
            ->select('products.id', 'products.name', 'products.category',
                    'products.price', 'products.remain', 'products.description',
                    'products.image', 'categories.name as categoryName')
            ->get();

            if($request->status) {
                $orders = DB::table('orders')
                    ->where('status', $request->status)
                    ->leftJoin('users', 'orders.user', 'users.id')
                    ->leftJoin('products_in_orders', 'products_in_orders.order', 'orders.id')
                    ->leftJoin('products', 'products.id', 'products_in_orders.product')
                    ->leftJoin('order_statuses', 'order_statuses.id', 'orders.status')
                    ->orderByDesc('updated_at')
                    //->get();
                    ->select('orders.id', 'order_statuses.name as status', 'orders.created_at',
                            'users.name as user', );
            }
            else {
                $orders = DB::table('orders')
                    ->leftJoin('users', 'orders.user', 'users.id')
                    ->leftJoin('products_in_orders', 'products_in_orders.order', 'orders.id')
                    ->leftJoin('products', 'products.id', 'products_in_orders.product')
                    ->leftJoin('order_statuses', 'order_statuses.id', 'orders.status')
                    ->orderByDesc('orders.updated_at')
                    //->get();
                    ->select();
            }

            // $groupedOrders = [];
            // foreach($orders as $order) {
            //     $groupedOrders[$order->id][] = $order;
            // }

            $statuses = DB::table('order_statuses')->get();

            return view('admin',[
                'categories' => $categories,
                'products' => $products,
                //'orders' => $groupedOrders,
                'statuses' => $statuses,
            ]);
        }

        return view('404');
    }

    // редактирование категории
    public function editCategory(Request $request) {
        if($this->isAdmin($request)) {
            $category = DB::table('categories')
                ->where('id', $request->id)
                ->first();
            if(!$category) return view('404');

            $img = $request->file('image');
            
            $path = '';
            if($img) {
                if($category->image) unlink($category->image);
                $typeImg = $img->extension();
                $uniqName = md5(uniqid(rand(), true));
                $nameImg = $uniqName.'.'.$typeImg;
                $directory = 'images/categories/';
                if(!$img->move(public_path($directory), $nameImg)) {
                    return redirect(url()->previous())
                        ->withErrors(['imgError' => 'Не получилось загрузить изображение на сервер'])
                        ->withInput();
                }

                $path = $directory.$nameImg;
            }

            DB::table('categories')->where('id', $request->id)->update([
                'id' => $category->id,
                'name' => $request->name ? $request->name : $category->name,
                'image' => $img ? $path : $category->image
            ]);

            return redirect(url()->previous());;
        }
        return view('404');
    }

    // удаление категории
    public function deleteCategory(Request $request) {
        if ($this->isAdmin($request)) {
            $isUsing = DB::table('products')
                ->where('category', $request->id)
                ->first();
            if ($isUsing) return redirect(url()->previous());

            DB::table('categories')->where('id', $request->id)->delete();
            return redirect(url()->previous());
        }
        return view('404');
    }

    private function isAdmin($request) {
        return $request->user && $request->user->isAdmin();
    }

    // редактирование товара
    public function editProduct(Request $request) {
        if($this->isAdmin($request)) {
            $product = DB::table('products')
                ->where('id', $request->id)
                ->first();
            if(!$product) return view('404');

            $img = $request->file('image');
            $path = '';
            if($img) {
                unlink($product->image);
                $typeImg = $img->extension();
                $uniqName = md5(uniqid(rand(), true));
                $nameImg = $uniqName.'.'.$typeImg;
                $directory = 'images/products/';
                if(!$img->move(public_path($directory), $nameImg)) {
                    return redirect(url()->previous())
                        ->withErrors(['imgError' => 'Не получилось загрузить изображение на сервер'])
                        ->withInput();
                }

                $path = $directory.$nameImg;
            }
            
            DB::table('products')->where('id', $request->id)->update([
                'id' => $product->id,
                'name' => $request->name ? $request->name : $product->name,
                'image' => $img ? $path : $product->image,
                'price' => $request->price ? $request->price : $product->price,
                'remain' => $request->remain ? $request->remain : $product->remain,
                'description' => $request->description ? $request->description : $product->description,
            ]);

            return redirect(url()->previous());;
        }
        return view('404');
    }

    // удаление продукта
    public function deleteProduct(Request $request) {
        if ($this->isAdmin($request)) {
            $isExist = DB::table('products')
                ->where('id', $request->id)
                ->first();
            if (!$isExist) return redirect(url()->previous());

            DB::table('products')->where('id', $request->id)->delete();
            return redirect(url()->previous());
        }
        return view('404');
    }
}
