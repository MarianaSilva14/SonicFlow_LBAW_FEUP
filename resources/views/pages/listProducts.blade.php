@extends('layouts.app')

@section('title', 'List Products')

@section('head')
<link rel="stylesheet" href="{{ asset('css/productsListpage.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Homepage'])


    <div class="row form-inline filterBar">
        <select id="categories" class="col-xl-2 col-sm-12 form-control" name="categories">
          <option value="">Select brand...</option>
          <option value="">option</option>
          <option value="">option</option>
          <option value="">option</option>
        </select>
        <div class="col-xl-4 col-lg-4 col-sm-12 col-12 priceRange">
          Price between: <input type="text" class="form-control" value="10"/>
          and <input type="text" class="form-control" value="1000"/>
        </div>
        <div class="col-xl-1 col-lg-4 col-sm-6 custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="productAvailable">
          <label class="custom-control-label" for="productAvailable">Available</label>
        </div>
        <select class="col-xl-2 col-lg-4 col-sm-5 form-control" name="sortBy">
          <option value="">Sort by...</option>
          <option value="">option</option>
          <option value="">option</option>
          <option value="">option</option>
        </select>
      </div>
      @endsection
