@extends('layouts.app')

@section('title', 'New Product')

@section('head')
<!-- <link rel="stylesheet" href="{{ asset('css/productpage.css') }}"> -->
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'New Product'])
<form method="post" action="{{route('product_add')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <label for="pictures">Product Pictures</label>
  <input type="file" id="pictures" name="pictures[]" multiple class="form-control">
  <!-- cost and buttons -->
  <!-- Title -->
  <label for="title">Title</label>
  <textarea class="form-control" id="title" name="title" placeholder="Product Title" rows="2"></textarea>
  <!-- Category -->
  <label for="category">Category</label>
  <select class="form-control" id="category" name="category">
    @foreach($categories as $cat)
    <option value="{{$cat->id}}">{{$cat->name}}</option>
    @endforeach
  </select>
  <!-- Price -->
  <label for="price">Standard Price</label>
  <input id="price" name="price" type="text" class="form-control" pattern="[0-9]+" placeholder="9999" value="">
  <label for="discountPrice">Discount Price</label>
  <input id="discountPrice" name="discountPrice" type="text" class="form-control" pattern="[0-9]+" placeholder="9999" value="">
  <!-- Amount -->
  <label for="amount">Available Stock</label>
  <input id="amount" name="stock" type="number" class="form-control" value="0" min="1" max="2000" step="1">
  <!-- Button -->
  <br>
  <button class="btn" style="vertical-align:middle">Add Product</button>
</form>
@endsection
