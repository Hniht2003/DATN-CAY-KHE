<div class="gstore-product-quick-view bg-white rounded-3 py-6 px-4">
    <div class="row g-4 pb-5">
        <div class="col-xl-6 align-self-end">
            <!-- sliders -->
            @include('client.partials.products.sliders', compact('product'))
            <!-- sliders -->
        </div>
        <div class="col-xl-6">
            <div class="product-info">
                <h3 class="mt-1 mb-3 h5">{{ $product->name }}</h3>

                <!-- pricing -->
                <div class="pricing all-pricing mt-2">
                    @if ($product->variations()->count() > 0)
                        <span
                            class="fw-bold h4 text-danger">{{ formatPrice($product->variations()->first()->price) }}</span>
                    @endif
                </div>
                <!-- pricing -->

                <!-- selected variation pricing -->
                <div class="pricing variation-pricing mt-2 d-none">

                </div>
                <!-- selected variation pricing -->

                <div class="widget-title d-flex mt-4">
                    <h6 class="mb-1 flex-shrink-0">Mô tả</h6>
                    <span class="hr-line w-100 position-relative d-block align-self-end ms-1"></span>
                </div>
                <p class="mb-3">
                    {{ $product->description }}
                </p>

                <form action="" class="add-to-cart-form">
                    @php
                        $isVariantProduct = 0;
                        $stock = 0;
                        if ($product->variations()->count() > 1) {
                            $isVariantProduct = 1;
                        } else {
                            $stock = $product->variations[0]->stock_quantity
                                ? $product->variations[0]->stock_quantity
                                : 0;
                        }
                    @endphp

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="product_variation_id"
                        @if (!$isVariantProduct) value="{{ $product->variations[0]->variantID }}" @endif>

                    <!-- variations -->
                    <div class="d-flex">
                        @include('client.partials.products.variations', compact('product'))
                    </div>

                    <!-- variations -->

                    <div class="d-flex align-items-center gap-3 flex-wrap mt-5">
                        <div class="product-qty qty-increase-decrease d-flex align-items-center">
                            <button type="button" class="decrease">-</button>
                            <input type="text" readonly value="1" name="quantity" min="1"
                                @if (!$isVariantProduct) max="{{ $stock }}" @endif>
                            <button type="button" class="increase">+</button>
                        </div>

                        <button type="submit" class="btn btn-secondary btn-md add-to-cart-btn"
                            @if (!$isVariantProduct && $stock < 1) disabled @endif>
                            <span class="me-2">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </span>
                            <span class="add-to-cart-text">
                                @if (!$isVariantProduct && $stock < 1)
                                    Hết hàng
                                @else
                                    Thêm vào giỏ hàng
                                @endif
                            </span>
                        </button>

                        <button type="button" class="btn btn-primary btn-md"
                            onclick="addToWishlist({{ $product->productID }})">
                            <i class="fa-solid fa-heart"></i>
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
