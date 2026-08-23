<div class="col-lg-6 col-xl-4 col-sm-6">
    <div class="product-item {{ $product->preview_type == 'video' ? 'product-video' : '' }}">
        <div class="product-item__thumb d-flex">

            @if ($product->preview_type == 'image')
                <a href="{{ route('products.show', $product->slug) }}" class="link w-100">
                    <x-frontend.image-preview src="{{ asset($product->preview_image) }}" class="cover-img" />
                </a>
            @elseif($product->preview_type == 'video')
                <video class="player" playsinline controls data-poster="">
                    <source src="{{ asset($product->preview_video) }}" type="video/mp4" />
                </video>
            @elseif($product->preview_type == 'audio')
                <audio class="audio-player" controls>
                    <source src="{{ asset($product->preview_audio) }}" type="audio/mp3" />
                </audio>
            @endif

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
                <a class="product_cart add-to-cart" href="javascript:;" data-id="{{ $product->id }}">
                    <i class="ti ti-shopping-cart-plus"></i> <span id="cart-btn-{{ $product->id }}">{{ __('Add to cart') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function () {
            if (window.productCardPlayersInitialized) return;
            window.productCardPlayersInitialized = true;

            const player = new Plyr('.player', {
                controls: []
            });
            const audioPlayer = new Plyr('.audio-player', {
                controls: ['play', 'progress', 'mute']
            });

            $(function() {
                $('.product-video').on('mouseover', function() {
                    player.muted = true;
                    player.play();
                })

                $('.product-video').on('mouseout', function() {
                    player.pause();
                })
            });
        })();
    </script>
@endpush
