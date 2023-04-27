@extends('layouts.layout')

@section('head')
    <title>Категории товаров | Electro</title>
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
                                <img src="{{ asset($category->image) }}" alt="">
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
@endsection