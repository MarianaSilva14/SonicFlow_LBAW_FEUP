@extends('layouts.app')

@section('title', $product->title)

@section('head')
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/productpage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => $product->title])
<form method="post" action="{{route('product',['id'=>$product->sku])}}">
  {{ csrf_field() }}
  <div class="form-row">
    <!-- Product Form -->
    <div id="photos" class="col-md-6 col-sm-12">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          @foreach($product->getImages() as $image)
            @if($loop->first)
              @include('partials.productImage',['first'=>TRUE,'image'=>$image])
            @else
              @include('partials.productImage',['first'=>FALSE,'image'=>$image])
            @endif
          @endforeach
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
      <input type="file" @if(!$editable) hidden readonly @endif multiple class="form-control">
    </div>
    <div id="info" class="col-md-6 col-sm-12">
      <!-- cost and buttons -->
      <div class="form-row">
        <!-- Title -->
        <div class="col-md-12">
          <div class="form-group">
            <textarea class="form-control productTitle" readonly rows="2">{{$product->title}}</textarea>
          </div>
        </div>
        <!-- Rating -->
        <div class="col-md-12 col-12">
          <!-- <label for="rating">Rating</label> -->
          <fieldset id="rating" class="rating form-control">
            <input type="radio" id="star5" name="rating" value="5" /><span class="fas fa-star fa-lg"></span>
            <input type="radio" id="star4" name="rating" value="4" /><span class="fas fa-star fa-lg"></span>
            <input type="radio" id="star3" name="rating" value="3" /><span class="fas fa-star fa-lg"></span>
            <input type="radio" id="star2" name="rating" value="2" /><span class="fas fa-star fa-lg"></span>
            <input type="radio" id="star1" name="rating" value="1" /><span class="fas fa-star fa-lg"></span>
          </fieldset>
          <small class="ratingLabel">Rating</small>
        </div>
        <!-- Price -->
        <div class="col-md-4 col-sm-4 col-5">
          @if($product->discountprice == null)
            <input id="price" type="text" readonly class="form-control-plaintext bg-warning" value="€{{$product->price}}">
          @else
            <input id="price" type="text" readonly class="form-control-plaintext bg-danger" value="€{{$product->discountprice}}">
            <small class="originalPrice">€{{$product->price}}</small>
          @endif
        </div>
        <!-- Amount -->
        <div class="col-md-2 col-2">
          <!-- <label for="amount">&zwnj;</label> -->
          <input id="amount" type="number" class="form-control" value="1" min="1" max="100" step="1">
        </div>
        <div class="linksBox">
          <span class="addFavs"><i class="far fa-heart"></i><a href="#">Favorites</a></span>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <label id="compare" class="custom-control-label" for="customCheck1">Compare</label>
          </div>
        </div>
        <!-- Availability -->
        <div class="col-md-3 col-6">
          <button class="availability btn btn-outline-success" disabled><i class="fas fa-check-circle"></i><span>Available </span></button>
          <button class="availability btn btn-outline-warning" disabled hidden><i class="fas fa-phone"></i><span>On Order</span></button>
          <button class="availability btn btn-outline-danger" disabled hidden><i class="fas fa-phone"></i><span>Unavailable</span></button>
          <p class="availability" hidden>{{$product->stock}}</p>
        </div>
        <!-- Button -->
        <div class="col-md-6 col-12">
          <button type="button" class="addToCart" style="vertical-align:middle"><span>Add to Cart</span><i class="fas fa-cart-plus"></i></button>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="secondary">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="descr-tab" data-toggle="tab" href="#descr" role="tab" aria-controls="descr" aria-selected="true">Description</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="specs-tab" data-toggle="tab" href="#specs" role="tab" aria-controls="specs" aria-selected="false">Specifications</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="comment-tab" data-toggle="tab" href="#comment" role="tab" aria-controls="comment" aria-selected="false">Comments</a>
    </li>
  </ul>
  <div  id="specs-form" class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="descr" role="tabpanel" aria-labelledby="descr-tab">
      @if($product->description==null)
        No description available for this product.
      @else
        {{$product->description}}
      @endif
    </div>

    <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">

      <!-- SPECIFICATIONS START -->
      <br>
      <form method="post" action="{{route('product',['id'=>$product->sku])}}">
        @each('partials.attribute',$attributes,'attribute')
      </form>
      <!-- SPECIFICATIONS END -->
    </div>

    <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">
      <br>
      <!-- COMMENTS START -->
      @foreach($product->getTopComments() as $comment)
        @include('partials.comment',['reply'=>FALSE,'comment'=>$comment])
      @endforeach
      <!-- COMMENTS END -->
      <div class="row pt-2">
        <div class="col-md-10 offset-md-1 commentForm">
          <form action="{{route('product_comment',['id'=>$product->sku])}}" method="post">
            <textarea class="w-100" rows="5" placeholder="Write your opinion!"></textarea><br>
            <button class="btn btn-sm btn-primary">Comment</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
