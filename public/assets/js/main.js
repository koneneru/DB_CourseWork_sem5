(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	/////////////////////////////////////////

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////

	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	$('.input-number').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 1;
			value = value < 1 ? 1 : value;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 1;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});

	var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');

	if(priceInputMax){
		priceInputMax.addEventListener('change', function(){
			updatePriceSlider($(this).parent() , this.value)
		});
	}

	if(priceInputMin){
		priceInputMin.addEventListener('change', function(){
			updatePriceSlider($(this).parent() , this.value)
		});
	}

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		var minPrice = $('#hidden-min-price').val();
		var maxPrice = $('#hidden-max-price').val();

		noUiSlider.create(priceSlider, {
			start: [minPrice, maxPrice],
			connect: true,
			step: 1,
			range: {
				'min': parseInt(minPrice),
				'max': parseInt(maxPrice)
			}
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
		});
	}

	// Navigation item underlining
	$($('.main-nav li').get().reverse()).each(function(){
		var link = $(this).children('a').attr('href');
		if(link == $(location).attr("href").replace(/\/+$/, '')){
			$(this).attr('class', "active");
			return false;
		}
	});

	// Tabs switching
	$('.tabs-list .tab').click(function(){
		if(!$(this).hasClass('active')) {

			var parent = $(this).closest('.tabs-list');
			var activeTab = parent.find('.tab.active');

			var oldDataKey = activeTab.attr('data-key');
			var newDataKey = $(this).attr('data-key');

			activeTab.removeClass('active');
			$(this).addClass('active');

			var tabsLine = parent.find('.tabs-line');
			tabsLine.removeClass(`tabs-line-${oldDataKey}`);
			tabsLine.addClass(`tabs-line-${newDataKey}`);

			$(`.tab-content[data-key=${oldDataKey}]`).removeClass('tab-content-show');
			console.log();
			$(`.tab-content[data-key=${newDataKey}]`).addClass('tab-content-show');
		}
	});

	// Phone validation
	$('.phone-input').keypress(function validate(evt){
		var event = evt || window.event;
		var key = event.keyCode || event.which;
		key = String.fromCharCode(key);
		var regex = /[0-9]/;
		if(!regex.test(key)) {
			event.returnValue = false;
			if(event.preventDefault) event.preventDefault();
		}
	})

	// Admin activate form
	$('.edit-btn').click(function(){
		var row = $(this).closest('.row');
		row.find('.edit-btn').addClass('hidden');
		row.find('.submit-btn').removeClass('hidden');
		row.find('.cancel-btn').removeClass('hidden');

		row.find("input[name='name-faker']").prop('disabled', false);
		row.find("input[name='image']").prop('disabled', false);
		row.find("input[name='price-faker']").prop('disabled', false);
		row.find("input[name='remain-faker']").prop('disabled', false);
		row.find("input[name='description-faker']").prop('disabled', false);
	})

	// Admin deactivate form
	$('.cancel-btn').click(function(){
		var row = $(this).closest('.row');
		row.find('.submit-btn').addClass('hidden');
		row.find('.cancel-btn').addClass('hidden');
		row.find('.edit-btn').removeClass('hidden');

		row.find("input[name='name-faker']").prop('disabled', true);
		row.find("input[name='image']").prop('disabled', true);
		row.find("input[name='price-faker']").prop('disabled', true);
		row.find("input[name='remain-faker']").prop('disabled', true);
		row.find("input[name='description-faker']").prop('disabled', true);
	})

	$('.submit-btn').click(function(){
		var row = $(this).closest('.row');
		var form = $(this).closest('form');

		var name = row.find("input[name='name-faker']").val().toLowerCase();
		var price = row.find("input[name='price-faker']").val();
		var remain = row.find("input[name='remain-faker']").val();
		var description = row.find("input[name='description-faker']").val();

		form.find("input[name='name']").attr('value', name);
		form.find("input[name='price']").attr('value', price);
		form.find("input[name='remain']").attr('value', remain);
		form.find("input[name='description']").attr('value', description);
	})

	// Search non-empty
	$(".search-btn").change(function(e){
		var parent = $(this).closest('form');
		var input = parent.find("input[name='search']");
		if(!input.val()){
			console.log('disabled');
			input.focus();
			e.preventDefault();
		}
		else{
			console.log('enabled');
			$(".search-btn").prop('disabled', false);
		}
	})

})(jQuery);

function refreshProducts(){
	if($('#sort-select').val() == 'price') {
		console.log('jopa.price');
		$('#hidden-sort').prop('disabled', true);
		$('#hidden-order').prop('disabled', true);
	}
	else {
		console.log('jopa.rating');
		$('#hidden-sort').prop('disabled', false);
		$('#hidden-order').prop('disabled', false);

		$('#hidden-sort').val($('#sort-select').val());
		$('#hidden-order').val('desc');
	}

	if(!$("[name='category']:checked").length){
		console.log('jopa.allCategory');
		$('#hidden-category').prop('disabled', true);
	}
	else {
		console.log('jopa.someCategory');
		$('#hidden-category').prop('disabled', false);

		var categories = [];
		$("[name='category']:checked").each(function() {
			categories.push($(this).attr('id').substring(9));
		});
		$('#hidden-category').val(categories.join('-'));
	}

	$('#sort-products').submit();
}