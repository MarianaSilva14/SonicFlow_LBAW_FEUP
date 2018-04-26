<div class="outbox col-xl-3 col-md-4">
    <div class="ibox">
        <div class="ibox-content product-box">
            <div class="product-imitation">
                <a href="{{route('product',['id' => $product->sku])}}">
                    <img src="{{ Storage::url($product->picture) }}" alt="Image for {{ $product->title }}"class="img-fluid">
                </a>
            </div>
            <div class="product-desc">
                <div class="priceTags">
                        @if( $product->discountprice != null)
                        <span class="bg-danger discount-price">
                            {{ $product->discountprice }}
                          </span>
                        @endif

                    <span class="product-price">
                            {{ $product->price }}
                          </span>
                </div>
                <br>
                <small class="text-muted">Category {{ $product->category_idcat }}</small>
                <a href="{{route('product',['id' => $product->sku])}}" class="product-name">{{ $product->title }}</a>

                <div class="small m-t-xs">
                    {{ $product->description }}
                </div>
                <br>
                <div class="m-t text-righ row">
                    <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                    <a href="" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary heart_favorite" data-id={{$product->sku}}><i class="far fa-heart"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
