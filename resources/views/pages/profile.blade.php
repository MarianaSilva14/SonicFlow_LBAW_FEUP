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
                  <img alt="Responsive image" src="{{ Storage::url(Auth::User()->getPicture()) }}" id="profile-image1" class="img-fluid">
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
                  @if ($errors->has('picture'))
                      <span class="text-danger">
                        {{ $errors->first('picture') }}
                      </span>
                  @endif
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
                  @if ($errors->has('firstName'))
                      <span class="text-danger">
                        {{ $errors->first('firstName') }}
                      </span>
                  @endif
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
                  @if ($errors->has('lastName'))
                      <span class="text-danger">
                        {{ $errors->first('lastName') }}
                      </span>
                  @endif
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
                  @if ($errors->has('email'))
                      <span class="text-danger">
                        {{ $errors->first('email') }}
                      </span>
                  @endif
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
                      <input class="form-control" name="password_confirmation" type="password" value="">
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
                      <a href="{{route('accountDeleteView',['error1' => ''])}}" style="margin-left:5%;" class="btn btn-danger">Delete Account</a>
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
          <table id="purchaseTable" class="table table-striped table-hover table-bordered">
            <tr class="info" style="color:#65768e">
              <th>Items</th>
              <th>Cost</th>
              <th>Date</th>
              <th>Expand</th>
            </tr>
          </table>
          </div>

          <!--  END PURCHASE HISTORY-->
        </div>
        <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">
          <div class="row"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
