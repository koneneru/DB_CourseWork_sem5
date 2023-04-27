@extends('layouts.layout')

@section('head')
    <title>Все товары | Electro</title>
@endsection

@section('content')
    <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- Category filter -->
						<div class="aside">
							<h3 class="aside-title">Категории</h3>
							<div class="checkbox-filter">
								@foreach ($categories as $category) 
                                    <div class="input-checkbox">
                                        <input type="checkbox" name="category" id="category-{{ $category->id }}" {{ in_array("$category->id", explode('-', request('category'))) ? 'checked' : '' }}>
                                        <label for="category-{{ $category->id }}">
                                            <span></span>
                                            {{ ucfirst($category->title) }}
                                            <small>{{ $products->where('category', $category->name)->count() }}</small>
                                        </label>
                                    </div>
                                @endforeach
							</div>
						</div>
						<!-- /Category filter -->

						<!-- Price filter -->
						<div class="aside">
							<h3 class="aside-title">Цена</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
							<input type="hidden" id="hidden-min-price" value="{{ $prices->first()->min }}">
							<input type="hidden" id="hidden-max-price" value="{{ $prices->first()->max }}">
						</div>
						<!-- /Price filter -->

						<!-- Brand filter -->
						{{-- <div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
                                @foreach ($brands as $brand) 
                                    <div class="input-checkbox">
                                        <input type="checkbox" id="brand-{{ $brand->id }}">
                                        <label for="brand-{{ $brand->id }}">
                                            <span></span>
                                            {{ ucfirst($brand->name) }}
                                            <small>{{ $products->where('brand', $brand->id)->count() }}</small>
                                        </label>
                                    </div>
                                @endforeach
							</div>
						</div> --}}
						<!-- /Brand filter -->
						<div class="aside">
							<form id="sort-products" class="hidden" action="{{ route('products') }}">
								<input type="hidden" id="hidden-sort" name="sort" value="{{ request('sort') }}">
								<input type="hidden" id="hidden-order" name="order" value="{{ request('order') }}">
								<input type="hidden" id="hidden-category" name="category" value="{{ request('category') }}">
							</form>
							<button class="primary-btn" id="products-btn" onclick="refreshProducts()">Показать</button>
						</div>
					</div>
					
					<!-- /ASIDE -->

                    <!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Сортировать по:
									<select id="sort-select" class="input-select" onchange="refreshProducts()">
										<option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Цене</option>
										<option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Рейтингу</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
                            @foreach ($products as $product)
                                <!-- product -->
                                <div class="col-md-4 col-xs-6">
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{ asset($product->image) }}" alt="">
                                            <div class="product-label">
                                                <span class="sale">-30%</span>
                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ Str::singular($product->category) }}</p>
                                            <h3 class="product-name"><a href="#">{{ $product->title }}</a></h3>
                                            <h4 class="product-price">{{ $product->price }} <del class="product-old-price">{{ $product->price }}</del></h4>
                                            <div class="product-rating">
                                                @for ($i = 0; $i < intdiv($product->rating, 1); $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                @if (fmod($product->rating, 1) < 0.5)
                                                    <i class="fa fa-star-o"></i>
                                                @else
                                                    <i class="fa fa-star-half-o"></i>
                                                @endif
                                                @for ($i = intdiv($product->rating, 1) + 1; $i < 5; $i++)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
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
                                </div>
                                <!-- /product -->

							    <div class="clearfix visible-sm visible-xs"></div>
                            @endforeach
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
                </div>
            </div>
        </div>
@endsection
