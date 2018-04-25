<div class="outbox col-xl-3 col-md-4">
    <div class="ibox">
        <div class="ibox-content product-box">
            <div class="product-imitation">
                <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/01/41/12/1196289/1505-1/tsp20170623090030/Apple-MacBook-Pro-15-Retina-i7-2-8GHz-16GB-1TB-Radeon-Pro-555-com-Touch-Bar-e-Touch-ID-Cinzento-Sideral.jpg" alt="194x228"class="img-fluid">
            </div>
            <div class="product-desc">
                <div class="priceTags">
                          <span class="bg-danger discount-price">
                            3199,99€
                          </span>
                    <span class="product-price">
                            3622,67€
                          </span>
                </div>
                <br>
                <small class="text-muted">Category</small>
                <a href="{{route('product',['id' => '186596482'])}}" class="product-name"> Apple MacBook Pro 15''</a>

                <div class="small m-t-xs">
                    Many desktop publishing packages and web page editors now.
                </div>
                <br>
                <div class="m-t text-righ row">
                    <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                    {{--TODO: Change this to ajax call later--}}
                    <a class="addtoFavs col-3 btn btn-xs btn-outline btn-primary">
                        <form method="post" action="{{route('toggleFavoritesList', ['sku' => '83108184'])}}">
                            {{csrf_field()}}
                            <button style = "background-color: transparent;border-color: transparent;color: white" role="submit"><i class="far fa-heart"></i></button>
                        </form>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>