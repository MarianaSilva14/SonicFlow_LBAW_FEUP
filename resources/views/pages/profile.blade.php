@extends('layouts.app')

@section('title', $infoCustomer->name)

@section('head')
<link rel="stylesheet" href="{{ asset('css/profilepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/productsListpage.css') }}">
<link rel="stylesheet" href="{{ asset('css/purchaseHistorypage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'My Profile'])
<div class="container" style="padding-top:50px">
  <div class="row">

    <div class="secondary">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true"> <h4> User Profile </h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="purchaseHistory-tab" data-toggle="tab" href="#purchaseHistory" role="tab" aria-controls="profile" aria-selected="false"> <h4>
            Purchase History
          </h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="favorites-tab" data-toggle="tab" href="#favorites" role="tab" aria-controls="profile" aria-selected="false"> <h4>
            Favorites List
          </h4></a>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">

        <br>
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

          <div class="row">
            <!-- left column -->
            <div class="col-md-3">
              <div class="text-center">
                <img alt="Responsive image" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-fluid">
                <br> <br>
                <input type="file" class="form-control">
              </div>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">
              <div class="alert alert-info alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a>
                <i class="fa fa-coffee"></i>
                This is an <strong>.alert</strong>. Use this to show important messages to the user.
              </div>
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="col-lg-3 control-label">First name:</label>
                  <div class="col-lg-8">
                    <input class="form-control" type="text" value="Jane">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Last name:</label>
                  <div class="col-lg-8">
                    <input class="form-control" type="text" value="Bishop">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Email:</label>
                  <div class="col-lg-8">
                    <input class="form-control" type="text" value="janesemail@gmail.com">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Time Zone:</label>
                  <div class="col-lg-8">
                    <div class="ui-select">
                      <select id="user_time_zone" class="form-control">
                        <option value="Hawaii">(GMT-10:00) Hawaii</option>
                        <option value="Alaska">(GMT-09:00) Alaska</option>
                        <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                        <option value="Arizona">(GMT-07:00) Arizona</option>
                        <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                        <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                        <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                        <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Username:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" value="janeuser">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Password:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="password" value="11111122333">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Confirm password:</label>
                  <div class="col-md-8">
                    <input class="form-control" type="password" value="11111122333">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-8">
                    <input type="button" class="btn btn-primary"  value="Save Changes">
                    <span></span>
                    <input type="reset" class="btn btn-default" value="Cancel">
                  </div>
                </div>
              </form>
              <hr>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="purchaseHistory" role="tabpanel" aria-labelledby="purchaseHistory-tab">
          <br>
          <div class="panel panel-primary">
            <div class="panel-heading"></div>
            <table class="table table-striped table-hover table-bordered">
              <tr class="info" style="color:#65768e">
                <th>Entry</th>
                <th>Item Name</th>
                <th>Cost</th>
                <th>Date</th>
              </tr>

              <tr>
                <td>1</td>
                <td>Apple MacBook Pro 15''</td>
                <td>3 199,99 €</td>
                <td>28/02/2018</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
          <div class="row">
            <div class="outbox col-xl-3 col-md-4">
              <div class="ibox">
                <div class="ibox-content product-box">
                  <div class="product-imitation">
                    <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/01/41/12/1196289/1505-1/tsp20170623090030/Apple-MacBook-Pro-15-Retina-i7-2-8GHz-16GB-1TB-Radeon-Pro-555-com-Touch-Bar-e-Touch-ID-Cinzento-Sideral.jpg" alt="194x228"class="img-fluid">
                  </div>
                  <div class="product-desc">
                    <span class="bg-danger discount-price">
                      3 199,99 €
                    </span>
                    <span class="product-price">
                      3 622,67 €
                    </span>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Apple MacBook Pro 15''</a>

                    <div class="small m-t-xs">
                      Many desktop publishing packages and web page editors now.
                    </div>
                    <br>
                    <div class="m-t text-righ row">
                      <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                      <a href="#" class="btn btn-danger col-3"><i class="far fa-trash-alt"></i></a>
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
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Portátil Acer Aspire</a>
                    <div class="small">
                      Many desktop publishing packages and web page editors now.
                    </div>
                    <br>
                    <div class="buttons row">
                      <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                      <a href="#" class="btn btn-danger col-3"><i class="far fa-trash-alt"></i></a>
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
                    <span class="product-price">650 €</span>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Portátil Asus</a>
                    <div class="small m-t-xs">
                      Many desktop publishing packages and web page editors now.
                    </div>
                    <br>
                    <div class="m-t text-righ row">
                      <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                      <a href="#" class="btn btn-danger col-3"><i class="far fa-trash-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="outbox col-xl-3 col-md-4">
              <div class="ibox">
                <div class="ibox-content product-box">

                  <div class="product-imitation">
                    <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/59/6b/15/1403737/1505-1.jpg" alt="194x228"class="img-fluid">
                  </div>
                  <div class="product-desc">
                    <span class="product-price">
                      958,71 €
                    </span>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Portátil HP Pavilion</a>
                    <div class="small m-t-xs">
                      Many desktop publishing packages and web page editors now.
                    </div>
                    <br>
                    <div class="m-t text-righ row">
                      <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                      <a href="#" class="btn btn-danger col-3"><i class="far fa-trash-alt"></i></a>
                    </div>
                  </div>
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
