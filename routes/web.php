<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('index'); //главная
Route::get('/sales', [WebController::class, 'sales'])->name('sales');//акции
Route::get('/categories', [WebController::class, 'categories'])->name('categories'); //категории
//Route::get('/where', [WebController::class, 'where'])->name('where'); //где нас найти

Route::middleware('getUser')->group(function () {
    Route::get('/auth', [UserController::class, 'auth'])->name('auth'); // регистрация/авторизация
    Route::post('/login', [UserController::class, 'login'])->name('login'); // обработка авторизации
    Route::post('/register', [UserController::class, 'register'])->name('register'); // обработка регистрации
    Route::match(['get', 'post', 'delete'], '/logout', [UserController::class, 'logout'])->name('logout'); // обработка выхода

    Route::patch('/category', [AdminController::class, 'editCategory'])->name('editCategory'); // обработка изменения категории
    Route::delete('/category', [AdminController::class, 'deleteCategory'])->name('deleteCategory'); // обработка удаления категории

    Route::get('/search', [WebController::class, 'search'])->name('search');
    Route::get('/products', [WebController::class, 'products'])->name('products'); // все товары
    //Route::get('/product', [WebController::class, 'product'])->name('product'); // обработка добавления товара
    Route::patch('/product', [AdminController::class, 'editProduct'])->name('editProduct'); // обработка изменения товара
    Route::delete('/product', [AdminController::class, 'deleteProduct'])->name('deleteProduct'); // обработка удаления товара

    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    
});

Route::get('/404', [WebController::class, 'notFoundPage'])->name('404');
Route::get('/{any}', [WebController::class, 'notFoundPage'])->where('any', '.*');