@extends('layouts.app')

@section('title', $infoCustomer->name)

@section('head')
<link rel="stylesheet" href="{{ asset('css/profilepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/productsListpage.css') }}">
<link rel="stylesheet" href="{{ asset('css/purchaseHistorypage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'My Profile'])
<div class="container">
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
                @if ($infoUser->getPicture() == "")
                  <img alt="Responsive image" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-fluid">
                @else
                  <img alt="Responsive image" src="{{ \Illuminate\Support\Facades\Storage::url($infoUser->getPicture()) }}" id="profile-image1" class="img-fluid">
                @endif
              </div>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">
              @if ($alert != "")
                <div class="alert alert-info alert-dismissable">
                  <a class="panel-close close" data-dismiss="alert">×</a>
                  <i class="fa fa-coffee"></i>
                  {!!$alert!!}
                </div>
              @endif
              <form method="post" action="{{route('profile',['id' => Auth::user()->username])}}" class="form-horizontal" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="col-md-3 control-label">Username:</label>
                  <div class="col-md-8">
                    <input class="form-control" name="username" type="text" value="{{$infoUser->username}}" readonly>
                  </div>
                </div>
                @if($editable)
                  <div class="form-group">
                @else
                  <div class="form-group" hidden>
                @endif
                  <label class="col-lg-3 control-label">Profile Picture:</label>
                  <div class="col-lg-8">
                    <input type="file" name="picture" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">First name:</label>
                  <div class="col-lg-8">
                    @if($editable)
                      <input class="form-control" name="firstName" type="text" value="{{$infoCustomer->firstName()}}">
                    @else
                      <input class="form-control" name="firstName" type="text" value="{{$infoCustomer->firstName()}}" readonly>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Last name:</label>
                  <div class="col-lg-8">
                    @if($editable)
                      <input class="form-control" name="lastName" type="text" value="{{$infoCustomer->lastName()}}">
                    @else
                      <input class="form-control" name="lastName" type="text" value="{{$infoCustomer->lastName()}}" readonly>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Email:</label>
                  <div class="col-lg-8">
                    @if($editable)
                      <input class="form-control" name="email" type="text" value="{{$infoUser->email}}">
                    @else
                      <input class="form-control" name="email" type="text" value="{{$infoUser->email}}" readonly>
                    @endif
                  </div>
                </div>
                @if($editable)
                  <div class="form-group">
                    <label class="col-md-3 control-label">Old Password:</label>
                    <div class="col-md-8">
                      <input class="form-control" name="oldPassword" type="password" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-8">
                      <input class="form-control" name="password" type="password" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                      <input class="form-control" type="password" value="">
                    </div>
                  </div>
                @endif
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-8">
                    @if($editable)
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      <span></span>
                      <a href="{{route('profile',['id' => Auth::user()->username])}}" class="btn btn-default">Cancel</a>
                    @else
                      <a href="{{route('profileEdit',['id' => Auth::user()->username])}}" class="btn btn-primary">Edit</a>
                    @endif
                  </div>
                </div>
              </form>
              <hr>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="purchaseHistory" role="tabpanel" aria-labelledby="purchaseHistory-tab">

          <!-- BEGIN PURCHASE HISTORY -->

          <div class="panel panel-primary">
          <div class="panel-heading"><h4 style="padding-bottom: 19px">Purchase History</h4></div>
          <table class="table table-striped table-hover table-bordered">
            <tr class="info" style="color:#65768e">
              <th>Items</th>
              <th>Cost</th>
              <th>Date</th>
              <th>Expand</th>
            </tr>

            <tr>
              <td>
                2*Apple MacBook Pro 15'', etc
                <div id="opret-produkt" class="collapse in" style="margin-top: 10px">
                  <div>
                    <table class="table table-striped table-hover table-bordered">
              				<tr class="info" style="color:#65768e;">
              					<th>Item Name</th>
              					<th>Cost</th>
              				</tr>

              				<tr>
              					<td>Apple MacBook Pro 15''</td>
              					<td>3 199,99 €</td>
              				</tr>
                      <tr>
              					<td>Apple MacBook Pro 15''</td>
              					<td>3 199,99 €</td>
              				</tr>
                      <tr>
              					<td>Mouse</td>
              					<td>10</td>
              				</tr>
              			</table>
                </div>
              </td>
              <td>6 409,98 €</td>
              <td>28/02/2018</td>
              <td class="panel panel-default panel-help" href="#opret-produkt" data-toggle="collapse">
                <i class="fas fa-minus"></i>
                <i class="fas fa-minus"></i>
              </td>
            </tr>
          </table>
          </div>

          <!--  END PURCHASE HISTORY-->
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
                    <div class="priceTags">
                      <span class="bg-danger discount-price">
                        3199,99 €
                      </span>
                      <span class="product-price">
                        3622,99 €
                      </span>
                    </div>
                    <br>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Apple MacBook Pro 15''</a>

                    <div class="small m-t-xs">
                      Many desktop publishing packages and web page editors now.
                    </div>
                    <br>
                    <div class="m-t text-righ row">
                      <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                      <a href="#" class="rmFromFavs btn btn-danger col-3"><i class="far fa-trash-alt"></i></a>
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
                      <span class="product-price">
                        999,99 €
                      </span>
                    </div>
                    <br>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Portátil Acer Aspire</a>
                    <div class="small">
                      Many desktop publishing packages and web page editors now.
                    </div>
                    <br>
                    <div class="buttons row">
                      <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                      <a href="#" class="rmFromFavs btn btn-danger col-3"><i class="far fa-trash-alt"></i></a>
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
                    <span class="product-price">
                      649,99 €
                    </span>
                  </div>
                  <br>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Portátil Asus</a>
                    <div class="small m-t-xs">
                      Many desktop publishing packages and web page editors now.
                    </div>
                    <br>
                    <div class="m-t text-righ row">
                      <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                      <a href="#" class="rmFromFavs btn btn-danger col-3"><i class="far fa-trash-alt"></i></a>
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
                    <div class="priceTags">
                      <span class="product-price">
                        959,99 €
                      </span>
                    </div>
                    <br>
                    <small class="text-muted">Category</small>
                    <a href="#" class="product-name"> Portátil HP Pavilion</a>
                    <div class="small m-t-xs">
                      Many desktop publishing packages and web page editors now.
                    </div>
                    <br>
                    <div class="m-t text-righ row">
                      <a href="#" class="addtoCart col-8 btn btn-xs btn-outline btn-primary">Add to cart  <i class="fas fa-cart-plus"></i></a>
                      <a href="#" class="rmFromFavs btn btn-danger col-3"><i class="far fa-trash-alt"></i></a>
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
