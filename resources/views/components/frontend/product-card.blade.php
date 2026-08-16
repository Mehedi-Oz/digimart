<div class="col-lg-6 col-xl-4 col-sm-6">
    <div class="product-item ">
        <div class="product-item__thumb d-flex">
            <a href="{{ route('products.show', $product->slug) }}" class="link w-100">
                @if ($product->preview_type == 'image')
                    <x-frontend.image-preview src="{{ asset($product->preview_image) }}" class="cover-img" />
                @elseif($product->preview_type == 'video')

                @elseif($product->preview_type == 'audio')
                @endif
            </a>
            <button type="button" class="product-item__wishlist"><i class="fas fa-heart"></i></button>
        </div>
        <div class="product-item__content">
            <div class="product-item__bottom flx-between gap-2">
                <div class="d-flex flex-wrap justify-content-between align-items-center w-100">

                    <div class="d-flex align-items-center gap-1">
                        <ul class="star-rating">
                            <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                            <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                            <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                            <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                            <li class="star-rating__item font-11"><i class="fas fa-star"></i></li>
                        </ul>
                        <span class="star-rating__text text-heading fw-500 font-14">
                            (16)
                        </span>
                    </div>
                    <span class="product-item__sales font-14"><i class="ti ti-download"></i>
                        1200</span>

                </div>
            </div>
            <h6 class="product-item__title">
                <a href="{{ route('products.show', $product->slug) }}" class="link">{{ $product->name }}</a>
            </h6>
            <div class="product-item__info flx-between gap-2">
                <span class="product-item__author">
                    {{ __('by') }}
                    <a href="profile.html" class="link hover-text-decoration-underline">{{ $product->author->name }}</a>
                </span>
                <div class="flx-align gap-2">
                    @if ($product->discount_price > 0)
                        <h6 class="product-item__price mb-0">
                            {{ $product->discount_price }}</h6>
                        <span class="product-item__prevPrice text-decoration-line-through">{{ $product->price }}</span>
                    @else
                        <h6 class="product-item__price mb-0">{{ $product->price }}
                        </h6>
                    @endif
                </div>
            </div>
            <div class="product_item_footer">
                <a class="product_cart" href="#">
                    <i class="ti ti-shopping-cart-plus"></i>
                </a>
                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                    Demo</a>
            </div>
        </div>
    </div>
</div>
