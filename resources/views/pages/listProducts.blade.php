@extends('layouts.app')

@section('title', $title)

@section('head')
<link rel="stylesheet" href="{{ asset('css/productsListpage.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'List Products'])


<form class="row form-inline filterBar" action="{{$products->url(1)}}" method="get">
    <input type="hidden" name="categoryID" value="{{$request->input('categoryID')}}">
    <input type="hidden" name="title" value="{{$request->input('title')}}">
    <div class="col-xl-4 col-lg-4 col-sm-12 col-12 priceRange">
        Price between: <input type="text" name="minPrice" class="form-control" value="{{$request->input('minPrice')}}"/>
        and <input type="text" name="maxPrice" class="form-control" value="{{$request->input('maxPrice')}}"/>
    </div>
    <div class="col-xl-1 col-lg-4 col-sm-6 custom-control custom-checkbox">
        <input type="checkbox" name="productAvailability" class="custom-control-input" id="productAvailable">
        <label class="custom-control-label" for="productAvailable">Available</label>
    </div>
    <select class="col-xl-2 col-lg-4 col-sm-5 form-control" name="sortBy">
      @if($request->input('sortBy') == "")
        <option value="" selected>No Sort</option>
      @else
        <option value="">No Sort</option>
      @endif
      @if($request->input('sortBy') == "priceASC")
        <option value="priceASC" selected>Price Ascending</option>
      @else
        <option value="priceASC">Price Ascending</option>
      @endif
      @if($request->input('sortBy') == "priceDESC")
        <option value="priceDESC" selected>Price Descending</option>
      @else
        <option value="priceDESC">Price Descending</option>
      @endif
      @if($request->input('sortBy') == "ratingASC")
        <option value="ratingASC" selected>Rating Ascending</option>
      @else
        <option value="ratingASC">Rating Ascending</option>
      @endif
      @if($request->input('sortBy') == "ratingDESC")
        <option value="ratingDESC" selected>Rating Descending</option>
      @else
        <option value="ratingDESC">Rating Descending</option>
      @endif
    </select>
    <button type="submit" name="button" class="filter btn btn-primary">Filter</button>
</form>

    <div class="row">
      @foreach($products as $product)
        @include('partials.product_mini', ['product' => $product])
      @endforeach
    </div>
    <!-- //<div class="mr-auto"> -->
      {{ $products->links() }}
    <!-- </div> -->
@endsection
