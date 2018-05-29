@extends('layouts.admin')

@section('title','Administrator')

@section('tab1Name','Product Management')
@section('tab1')
<div class="container admin-cont">
  <div class="row">
    <div class="addProduct" >
      <button id="addProduct" class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="location.href='{{route('product_create')}}'" style="font-weight:bold"><i class="fas fa-plus"></i>Add product</button>
    </div>
    <div class="col-xs-8 col-xs-offset-2 nav-search">
      <div class="input-group">
        <div class="input-group-btn search-panel">
          <button type="button" id="catSelectButton" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span id="catSelect"><span class="glyphicon glyphicon-align-justify"></span> All</span>  <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#"> <span class="glyphicon glyphicon-picture text-info"></span> All</a></li>
            @foreach($categories as $category)
              <li><a href="#{{$category->id}}"> <span class="glyphicon glyphicon-envelope text-danger"></span>{{$category->name}}</a></li>
            @endforeach
          </ul>
        </div>
        <input type="hidden" name="search_param" value="" id="search_param">
        <input type="text" class="form-control" name="x" placeholder="Search...">
        <button id="searchBtn" class="btn btn-outline-success my-2 my-sm-0 adminSearchBtn" type="submit"><i class="fas fa-search"></i></button>

        <i class="fas fa-envelope breadcrumb-item active" data-target="#exampleModalCenter" data-toggle="modal"></i>

 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Newsletter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('sendNewsletter')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <label for="title-name" class="col-form-label">Title:</label>
            <input type="text" name="title" class="form-control" id="title-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" name="message" id="message-text"></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Send</button>
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Send</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

        <hr>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->

<div class="panel panel-primary">
  <table class="table table-hover table-bordered">
    <tr class="info" style="color:#65768e">
      <th>Delete</th>
      <th>Product</th>
      <th>Item Name</th>
      <th>Cost</th>
      <th>Discount</th>
      <th>Stock</th>
      <th>Edit</th>
    </tr>
  </table>
  <button id="showMore" class="btn btn-outline-success my-2 my-sm-0" type="button" style="font-weight:bold">Show More <i class="fas fa-plus"></i></button>
</div>
@endsection

@section('tab2Name','Moderators')
@section('tab2')

  <div class="container admin-cont">
    <div class="row">
      <div class="addModerator" >
        <button id="addModerator" class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="location.href='{{route('moderator_create')}}'" style="font-weight:bold"><i class="fas fa-plus"></i> Add Moderator</button>
      </div>
    </div>
  </div>

  <div class="panel panel-primary">
    <table class="table table-hover table-bordered">
      <tr class="info" style="color:#65768e">
        <th>Username</th>
        <th>Email</th>
        <th>Join Date</th>
      </tr>

    @foreach($moderators as $moderator)
        <td>{{$moderator->user_username}}</td>
        <td>{{$moderator->email}}</td>
        <td>{{$moderator->joindate}}</td>
      @endforeach
    </table>
  </div>
@endsection
