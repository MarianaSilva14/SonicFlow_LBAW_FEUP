<nav class="navbar navbar-expand-xl navbar-light fixed-top bg-white">
  <!-- logo -->
  <a class="navbar-brand" href="{{route('homepage')}}">
    <img src="{{asset('images/logo.png')}}" height="64" alt="Logo">
  </a>
  <!-- toggle button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- links and search bar -->
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <!-- search form -->
    <div class="row searchForm">
      <div class="col-xs-8 col-xs-offset-2">
        <div class="input-group">
          <div class="input-group-btn search-panel">
            <button type="button" id="catSelectButton" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <span id="catSelect">All</span>  <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="">All</a></li>
              @foreach($categories as $category)
                <li><a href="#{{$category->id}}">{{$category->name}}</a></li>
              @endforeach
            </ul>
          </div>
          <input type="hidden" name="search_param" value="" id="search_param">
          <input type="text" class="form-control" name="x" placeholder="Search...">
          <button id="searchBtn" class="btn btn-outline-success headerSearchBtn" type="submit"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>

    <!-- links -->
    <ul class="navbar-nav ml-auto">
      @if(Auth::check() && !Auth::user()->isCustomer())
        <li class="nav-item">
          <a class="nav-link selectedView" href="{{route('homepage')}}">Visitor Mode</a>
        </li>
        <li class="nav-item">
            @if(Auth::user()->isAdmin())
              <a class="nav-link" href="{{url('administration')}}">
              Administrator Mode
            @elseif(Auth::user()->isModerator())
              <a class="nav-link" href="{{url('moderation')}}">
              Moderator Mode
            @else
              <a class="nav-link" href="#">
              Congratulations to You!
            @endif
          </a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link shoppingCart" href="{{route('shoppingCart')}}"><i class="fas fa-shopping-cart fa-lg"></i></a>
        </li>
      @endif
      <li class="nav-item">
        @if (Auth::check())
          <a class="nav-link profile" href="{{route('profile', ['id' => Auth::user()->username])}}">
            @if( Auth::user()->picture == "")
              <img id="profile_picture" alt="Profile Image" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" class="img-fluid">
            @else
              <img id="profile_picture" alt="Profile Image" src="{{ \Illuminate\Support\Facades\Storage::url(Auth::User()->getPicture()) }}" class="img-fluid">
            @endif
            {{Auth::user()->getName()}}
          </a>
        @else
          <a class="nav-link login" href="{{route('login')}}">Login</a>
        @endif
      </li>
      <li class="nav-item">
        @if (Auth::check())
          <a class="nav-link logout" href="{{route('logout')}}">Logout</a>
        @else
          <a class="nav-link register" href="{{route('register')}}">Register</a>
        @endif
      </li>
      <li class="nav-item">
        <a class="nav-link mobileNav" href="{{route('configurator')}}"><span class="sub_icon"><i class="fas fa-cogs fa-lg"></i></span>Configurator</a>
      </li>

      <!-- SEPARATOR -->
          <li>
              <hr class="mobileNav w-100 my-1">
          </li>

      @foreach($categories as $category)
        <li class="nav-item">
          <a class="nav-link mobileNav" href="{{route('products')}}?categoryID={{$category->id}}"><span class="sub_icon"><i class="{{$category->icon}} fa-lg"></i></span>{{$category->name}}</a>
        </li>
      @endforeach
    </ul>

  </div>
</nav>

<div class="wrapper row">
  <!-- Sidebar -->
  <div id="sidebar-wrapper" class="col-2">
    <ul class="sidebar-nav" id="sidebar">
      <li><a  id="configurator" href="{{route('configurator')}}"><span class="sub_icon"><i class="fas fa-cogs fa-lg"></i></span>Configurator</a></li>
      @foreach($categories as $category)
        <li><a href="{{route('products')}}?categoryID={{$category->id}}"><span class="sub_icon"><i class="{{$category->icon}} fa-lg"></i></span>{{$category->name}}</a></li>
      @endforeach
    </ul>
  </div>

  <div id="content-wrapper" class="col-10">
