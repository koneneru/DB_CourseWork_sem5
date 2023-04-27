@extends('layouts.layout')

@section('head')
    <title>Electro - Главная</title>
@endsection

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="{{ $category->image }}" alt="">
                            </div>
                            <div class="shop-body">
                                <h3>{{ ucfirst($category->title) }}</h3>
                                <a href="{{ route('products') }}/?category={{ $category->id }}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /shop -->
                @endforeach
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Новинки</h3>
                        {{-- <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach ($categories as $category)
                                <li class="active"><a data-toggle="tab" href="#tab1">{{ ucfirst($category->name) }}</a></li>
                                @endforeach
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($products as $product)
                                        <!-- product -->
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{ $product->image }}" alt="">
                                                <div class="product-label">
                                                    {{-- <span class="sale">-30%</span>
                                                    <span class="new">NEW</span> --}}
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ ucfirst($product->category) }}</p>
                                                <h3 class="product-name"><a href="#">{{ ucfirst($product->title) }}</a></h3>
                                                <h4 class="product-price">{{ $product->price }} <del class="product-old-price">{{ $product->price }}</del></h4>
                                                <div class="product-rating">
                                                    @for ($i = 0; $i < intdiv($product->rating, 1); $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                    @if ($product->rating != 5)
                                                        @if (fmod($product->rating, 1) < 0.5)
                                                            <i class="fa fa-star-o"></i>
                                                        @else
                                                            <i class="fa fa-star-half-o"></i>
                                                        @endif
                                                        @for ($i = intdiv($product->rating, 1) + 1; $i < 5; $i++)
                                                            <i class="fa fa-star-o"></i>
                                                        @endfor
                                                    @endif
                                                </div>
                                                <div class="product-btns">
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection