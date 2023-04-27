@extends('layouts.layout')

@section('head')
    <title>Результаты поиска по запросу: | Electro</title>
@endsection

@section('content')
    <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    <!-- STORE -->
					<div id="store">
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
							</div>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
                            @foreach ($products as $product)
                                <!-- product -->
                                <div class="col-md-3 col-xs-6">
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