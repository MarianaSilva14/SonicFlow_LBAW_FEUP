@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
@include('common.breadcrumb', ['currPage' => 'Edit Product'])
<form method="post" class="editProduct" action="{{route('product_add')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <!-- Pictures -->
  <label for="pictures">Product Pictures</label>
  <input type="file" id="pictures" name="pictures[]" multiple class="form-control">
  <!-- Title -->
  <label for="title">Title</label>
  <textarea class="form-control" id="title" name="title" placeholder="Product Title" rows="2"></textarea>
  <!-- Description -->
  <label for="description">Description</label>
  <textarea class="form-control" id="description" name="description" placeholder="Product Description" rows="2"></textarea>
  <!-- Category -->
  <label for="category">Category</label>
  <select class="form-control" hidden id="category" name="category" value="{{$product->category_idcat}}">
    @foreach($categories as $cat)
    <option value="{{$cat->id}}">{{$cat->name}}</option>
    @endforeach
  </select>
  <!-- Price -->
  <label for="price">Standard Price</label>
  <input id="price" name="price" type="text" class="form-control" pattern="[0-9]+" placeholder="9999" value="{{$product->price}}">
  <label for="discountPrice">Discount Price</label>
  <input id="discountPrice" name="discountPrice" type="text" class="form-control" pattern="[0-9]+" placeholder="9999" value="{{$product->discountprice}}">
  <!-- Amount -->
  <label for="amount">Available Stock</label>
  <input id="amount" name="stock" type="number" class="form-control" value="{{$product->stock}}" min="1" max="2000" step="1">
  <legend>Attributes</legend>
  @foreach($attributes as $att)
    <div class="">
      <label for="{{$att->name}}" style="min-width:10em">{{$att->name}}</label>
      <input class="form-control d-inline" style="width:auto" type="text" id="{{$att->name}}" name="attributes[{{$att->id}}]" value="{{$att->value}}">
    </div>
  @endforeach
  <!-- Button -->
  <button class="btn saveChanges" hidden style="vertical-align:middle">Save Changes</button>
</form>
@endsection
