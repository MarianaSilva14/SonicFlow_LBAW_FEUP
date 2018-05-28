@extends('layouts.app')

@section('title', 'Comparator')

@section('head')
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Comparator'])
<br>
<div class="form-group row compareHeader">
  <label for="image" class="col-sm-3 col-form-label"> ‌ </label>

  @foreach($products as $prod)
    <div class="col-sm-2 thumbnails" data-sku="{{$prod->sku}}">
      <span class="removeColumn"><i class="fas fa-times"></i></span>
      @if( $prod->picture == null)
        <img class="img-fluid" src="https://cdn0.iconfinder.com/data/icons/business-mix/512/cargo-512.png" alt="Product Image">
      @else
        <img class="img-fluid" src="{{Storage::url($prod->picture)}}" alt="Product Image">
      @endif
      <!-- <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/fa/44/14/1328378/1505-1.jpg" alt="100x100" class="img-fluid"> -->
      <p style="margin-left: 0"> {{$prod->title}} </p>
    </div>
  @endforeach

</div>

<form class="spec">

  <legend> Summary </legend>

  @foreach($prodAttributes[0] as $attribute)
    <div class="form-group row">
      <label for="screenSize" class="col-sm-3 col-form-label">{{str_replace("_"," ",$attribute->name)}}</label>
    @foreach($prodAttributes as $prod)
      <p class="col-sm-2" data-sku="{{$prod->sku}}">{{$prod[$loop->parent->index]->value}}</p>
    @endforeach
    </div>
  @endforeach

</form>
@endsection
