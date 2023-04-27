@extends('layouts.layout')

@section('head')
    <title>Панель администратора | Electro</title>
@endsection

@section('content')
    <div class="container">
        <div class="admin-tabs tabs">
            <ul class="tabs-list">
                <li><a href={{route('index')}}><i class="fa fa-home"></i></a></li>
                <li class="tab active" data-key="categories">Категории</li>
                <li class="tab" data-key="products">Товары</li>
                <li class="tab" data-key="orders">Заказы</li>
                <div class="tabs-line tabs-line-categories"></div>
            </ul>
            <div class="tab-content tab-content-show" data-key="categories">
                @foreach ($categories as $category)
                    <div class="row">
                        <div class="col-xs-1">
                            <div class="checkbox-select">
                                <div class="input-checkbox">
                                    <input type="checkbox" name="category" id="category-{{ $category->id }}">
                                    <label for="category-{{ $category->id }}"><span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 category-img">
                            <div class="input-file">
                                <label for="product-{{ $category->id }}-image" class="category-img-input-label">
                                    <span><img src="{{ asset($category->image) }}" alt=""></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="name-faker" value="{{ ucfirst($category->name) }}" disabled>
                        </div>
                        <div class="col-md-3">
                            <div class="action-btn">
                                <button class="edit-btn"><i class="fa fa-pencil"></i></button>
                                <form action={{ route('editCategory') }} method="POST" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                    <input type="hidden" name="name" value="{{ $category->name }}">
                                    <input type="file" name="image" class="hidden" id="product-{{ $category->id }}-image" value="{{ $category->image }}" disabled>
                                    <button class="submit-btn hidden"><i class="fa fa-check"></i></button>
                                </form>
                                <button class="cancel-btn hidden"><i class="fa fa-times"></i></button>
                                <form action={{ route('deleteCategory') }} method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $category->id }}">
                                    <button type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="tab-content" data-key="products">
                @foreach ($products as $product)
                    <div class="row">
                        <div class="col-md-2 product-img">
                            <div class="input-file">
                                <label for="product-{{ $product->id }}-image" class="product-img-input-label">
                                    <span><img src="{{ asset($product->image) }}" alt=""></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4 product-name">
                                    <div>
                                        <input type="text" name="name-faker" value="{{ ucfirst($product->name) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3 product-category">
                                    <div>
                                        <select name="category">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 product-price">
                                    <div>
                                        <input type="number" min="0" step="any" name="price-faker" value="{{ $product->price }}" disabled>
                                    </div>
                                    </div>
                                <div class="col-md-2 product-remain">
                                    <div>
                                        <input type="number" min="0" name="remain-faker" value="{{ $product->remain }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="textarea" name="description-faker" value="{{ $product->description }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="action-btn">
                                <button class="edit-btn"><i class="fa fa-pencil"></i></button>
                                <form action={{ route('editProduct') }} method="POST" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="file" name="image" class="hidden" id="product-{{ $product->id }}-image" value="{{ $product->image }}" disabled>
                                    <input type="hidden" name="remain" value="{{ $product->remain }}">
                                    <input type="hidden" name="description" value="{{ $product->description }}">
                                    <button class="submit-btn hidden"><i class="fa fa-check"></i></button>
                                </form>
                                <button class="cancel-btn hidden"><i class="fa fa-times"></i></button>
                                <form action={{ route('deleteProduct') }} method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <button type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection