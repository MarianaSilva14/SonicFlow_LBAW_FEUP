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
            <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Computers</a></li>
            <li><a href="#its_equal"> <span class="glyphicon glyphicon-music text-warning"></span> Laptops</a></li>
            <li><a href="#greather_than"> <span class="glyphicon glyphicon-user text-success"></span> Mobile</a></li>
            <li><a href="#less_than"><span class="glyphicon glyphicon-book text-primary"></span> Components </a></li>
            <li class="divider"></li>
            <li><a href="#all"> <span class="glyphicon glyphicon-picture text-info"></span> Storage</a></li>
            <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Periferals</a></li>
            <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Photo</a></li>
            <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Video</a></li>
            <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Network</a></li>
            <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Software</a></li>
          </ul>
        </div>
        <input type="hidden" name="search_param" value="all" id="search_param">
        <input type="text" class="form-control" name="x" placeholder="Search...">
        <button id="searchBtn" class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
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
  <button id="showMore" class="btn btn-outline-success my-2 my-sm-0" type="button" style="font-weight:bold">Show More<i class="fas fa-plus"></i></button>
</div>
@endsection

@section('tab2Name','Moderators')
@section('tab2')
Add some moderators
@endsection
