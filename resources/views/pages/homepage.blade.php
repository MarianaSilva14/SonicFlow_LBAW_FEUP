@extends('layouts.app')

@section('title', 'Homepage')

@section('head')
<link rel="stylesheet" href="{{ asset('css/productsListpage.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')
@include('common.breadcrumb', ['currPage' => 'Homepage'])
      <div class="justify-content-center">

        <div id="highlight">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('images/b1.png')}}" alt="Front view">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('images/b2.png')}}" alt="Top view">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('images/b3.png')}}" alt="Side view">
              </div>
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
        </div>

        <br>

        <div id="highlights-products">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="promo-tab" data-toggle="tab" href="#promo" role="tab" aria-controls="promo" aria-selected="true"> Promotions </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="bests-tab" data-toggle="tab" href="#bestsellers" role="tab" aria-controls="bestsellers" aria-selected="false"> Best sellers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="recommended-tab" data-toggle="tab" href="#recommended" role="tab" aria-controls="recommended" aria-selected="false"> Recommended </a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="promo" role="tabpanel" aria-labelledby="promo-tab">
              <div class="row">

              </div>
            </div>
            <div class="tab-pane fade" id="bestsellers" role="tabpanel" aria-labelledby="bests-tab">
              <div class="row">

              </div>
            </div>
            <div class="tab-pane fade" id="recommended" role="tabpanel" aria-labelledby="recommended-tab">
              <div class="row">

              </div>
            </div>
          </div>
        </div>

      </div>
@endsection
