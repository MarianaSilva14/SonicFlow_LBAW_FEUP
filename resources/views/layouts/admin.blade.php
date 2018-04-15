<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Styles -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{asset('css/administration.css')}}">
  @yield('head')
  <script src="js/common.js" defer></script>

  <script type="text/javascript">
  // Fix for Firefox autofocus CSS bug
  // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
  </script>
  <script type="text/javascript" src={{ asset('js/app.js') }} defer>
  </script>
</head>
<body>
  <nav class="navbar navbar-expand-xl navbar-light fixed-top bg-white">
    <!-- logo -->
    <a class="navbar-brand" href="homepage.html">
      <img src="{{asset('images/logo.png')}}" width="auto" height="64px" alt="">
    </a>
    <!-- toggle button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- links and search bar -->
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <!-- links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{route('homepage')}}">Visitor Mode</a>
        </li>
        <li class="nav-item">
            @if(Auth::user()->isAdmin())
              <a class="nav-link selectedView" href="{{url('administration')}}">
              Administrator Mode
            @elseif(Auth::user()->isModerator())
              <a class="nav-link selectedView" href="{{url('moderation')}}">
              Moderator Mode
            @else
              <a class="nav-link selectedView" href="#">
              Congratulations to You!
            @endif
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="configurator.html"><span class="sub_icon"><i class="fas fa-cogs fa-lg"></i></span>Configurator</a>
        </li>

        <!-- SEPARATOR -->
        <hr class="mobileNav w-100 my-1"></hr>

        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Computers"><span class="sub_icon"><i class="fas fa-desktop fa-lg"></i></span>Computers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Laptops"><span class="sub_icon"><i class="fas fa-laptop fa-lg"></i></span>Laptops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Mobile"><span class="sub_icon" id="mobile"><i class="fas fa-mobile-alt fa-lg"></i></span>Mobile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Components"><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Components</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Storage"><span class="sub_icon"><i class="fas fa-hdd fa-lg"></i></span>Storage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Periferals"><span class="sub_icon"><i class="fas fa-keyboard fa-lg"></i></span>Periferals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Photo"><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Photo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Video"><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Video</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Network"><span class="sub_icon"><i class="fas fa-rss fa-lg"></i></span>Network</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobileNav" href="productsListpage.html?cat=Software"><span class="sub_icon"><i class="far fa-window-maximize fa-lg"></i></span>Software</a>
        </li>
      </ul>

    </div>
  </nav>

  <div class="wrapper row">
    <div id="content-wrapper" class="col-12">
      <nav class="nav-fill">
        <div class="nav nav-tabs" id="modNavTabs" role="tablist">
          <a class="nav-item nav-link active" id="nav-flagged-tab" data-toggle="tab" href="#nav-flagged" role="tab" aria-controls="nav-flagged" aria-selected="true">@yield('tab1Name')</a>
          <a class="nav-item nav-link" id="nav-banned-tab" data-toggle="tab" href="#nav-banned" role="tab" aria-controls="nav-banned" aria-selected="false">@yield('tab2Name')</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-flagged" role="tabpanel" aria-labelledby="nav-flagged-tab">
          @yield('tab1')
        </div>
        <div class="tab-pane fade" id="nav-banned" role="tabpanel" aria-labelledby="nav-banned-tab">
          @yield('tab2')
        </div>
      </div>
    </div>
  </body>
</html>
