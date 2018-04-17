@extends('layouts.app')

@section('title', 'Homepage')

@section('head')
<link rel="stylesheet" href="{{ asset('css/productsListpage.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Homepage'])
      <div class="justify-content-center" class="col-4 mx-auto">

        <div id="highlight">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('images/b1.png')}}" alt="Front view">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('images/b2.png')}}" alt="Top view">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('images/b3.png')}}" alt="Side view">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators"  role="button" data-slide="prev">
              <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
              <i class="fas fa-arrow-left " style="color:black;"></i>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
              <i class="fas fa-arrow-right" style="color:black;"></i>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>

        <br>

        <div id="highlights-products">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="promo-tab" data-toggle="tab" href="#promo" role="tab" aria-controls="home" aria-selected="true"> Promotions </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="bests-tab" data-toggle="tab" href="#bestsellers" role="tab" aria-controls="profile1" aria-selected="false"> Best sellers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="recommended-tab" data-toggle="tab" href="#recommended" role="tab" aria-controls="profile2" aria-selected="false"> Recommended </a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="promo" role="tabpanel" aria-labelledby="home-tab">
              <div class="row">
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
                        <a href="product.html" class="product-name"> Apple MacBook Pro 15''</a>

                        <div class="small m-t-xs">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="m-t text-righ row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a class="addtoFavs col-3 btn btn-xs btn-outline btn-primary">
                            <form method="post" action="{{route('addFavoritesList', ['id' => Auth::user()->username, 'sku' => '83108184'])}}">
                              {{csrf_field()}}
                              <button style = "background-color: transparent;border-color: transparent;color: white" role="submit"><i class="far fa-heart"></i></button>
                            </form>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="outbox col-xl-3 col-md-4">
                  <div class="ibox">
                    <div class="ibox-content product-box">
                      <div class="product-imitation">
                        <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/fa/44/14/1328378/1505-1.jpg" alt="194x228"class="img-fluid">
                      </div>
                      <div class="product-desc">
                        <div class="priceTags">
                          <span class="bg-danger discount-price">
                            899,99 €
                          </span>
                          <span class="product-price">
                            999,99 €
                          </span>
                        </div>
                        <br>
                        <small class="text-muted">Category</small>
                        <a href="product.html" class="product-name"> Portátil Acer Aspire</a>
                        <div class="small">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="buttons row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><i class="far fa-heart"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="outbox col-xl-3 col-md-4">
                  <div class="ibox">
                    <div class="ibox-content product-box">
                      <div class="product-imitation">
                        <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/22/05/13/1246498/1505-1.jpg" alt="194x228"class="img-fluid">
                      </div>
                      <div class="product-desc">
                        <div class="priceTags">
                          <span class="bg-danger discount-price">
                            599,99 €
                          </span>
                          <span class="product-price">
                            649,99 €
                          </span>
                        </div>
                        <br>
                        <small class="text-muted">Category</small>
                        <a href="product.html" class="product-name"> Portátil Asus</a>
                        <div class="small m-t-xs">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="m-t text-righ row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><i class="far fa-heart"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="bestsellers" role="tabpanel" aria-labelledby="profile1-tab">
              <div class="row">
                <div class="outbox col-xl-3 col-md-4">
                  <div class="ibox">
                    <div class="ibox-content product-box">
                      <div class="product-imitation">
                        <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/01/41/12/1196289/1505-1/tsp20170623090030/Apple-MacBook-Pro-15-Retina-i7-2-8GHz-16GB-1TB-Radeon-Pro-555-com-Touch-Bar-e-Touch-ID-Cinzento-Sideral.jpg" alt="194x228"class="img-fluid">
                      </div>
                      <div class="product-desc">
                        <span class="product-price">
                          3 622,67 €
                        </span>
                        <br> <br>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Apple MacBook Pro 15''</a>

                        <div class="small m-t-xs">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="m-t text-righ row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><i class="far fa-heart"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="outbox col-xl-3 col-md-4">
                  <div class="ibox">
                    <div class="ibox-content product-box">
                      <div class="product-imitation">
                        <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/fa/44/14/1328378/1505-1.jpg" alt="194x228"class="img-fluid">
                      </div>
                      <div class="product-desc">
                        <span class="product-price">999,99 €</span>
                        <br> <br>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Portátil Acer Aspire</a>
                        <div class="small">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="buttons row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><i class="far fa-heart"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="outbox col-xl-3 col-md-4">
                  <div class="ibox">
                    <div class="ibox-content product-box">
                      <div class="product-imitation">
                        <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/22/05/13/1246498/1505-1.jpg" alt="194x228"class="img-fluid">
                      </div>
                      <div class="product-desc">
                        <span class="product-price">650,99 €</span>
                        <br> <br>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Portátil Asus</a>
                        <div class="small m-t-xs">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="m-t text-righ row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><i class="far fa-heart"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="recommended" role="tabpanel" aria-labelledby="profile2-tab">
              <div class="row">
                <div class="outbox col-xl-3 col-md-4">
                  <div class="ibox">
                    <div class="ibox-content product-box">
                      <div class="product-imitation">
                        <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/01/41/12/1196289/1505-1/tsp20170623090030/Apple-MacBook-Pro-15-Retina-i7-2-8GHz-16GB-1TB-Radeon-Pro-555-com-Touch-Bar-e-Touch-ID-Cinzento-Sideral.jpg" alt="194x228"class="img-fluid">
                      </div>
                      <div class="product-desc">
                        <span class="product-price">
                          3 622,67 €
                        </span>
                        <br> <br>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Apple MacBook Pro 15''</a>

                        <div class="small m-t-xs">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="m-t text-righ row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><i class="far fa-heart"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="outbox col-xl-3 col-md-4">
                  <div class="ibox">
                    <div class="ibox-content product-box">
                      <div class="product-imitation">
                        <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/fa/44/14/1328378/1505-1.jpg" alt="194x228"class="img-fluid">
                      </div>
                      <div class="product-desc">
                        <span class="product-price">999,99 €</span>
                        <br> <br>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Portátil Acer Aspire</a>
                        <div class="small">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="buttons row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><i class="far fa-heart"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="outbox col-xl-3 col-md-4">
                  <div class="ibox">
                    <div class="ibox-content product-box">
                      <div class="product-imitation">
                        <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/22/05/13/1246498/1505-1.jpg" alt="194x228"class="img-fluid">
                      </div>
                      <div class="product-desc">
                        <span class="product-price">650,99 €</span>
                        <br> <br>
                        <small class="text-muted">Category</small>
                        <a href="#" class="product-name"> Portátil Asus</a>
                        <div class="small m-t-xs">
                          Many desktop publishing packages and web page editors now.
                        </div>
                        <br>
                        <div class="m-t text-righ row">
                          <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                          <a href="#" class="addtoFavs col-3 btn btn-xs btn-outline btn-primary"><i class="far fa-heart"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
