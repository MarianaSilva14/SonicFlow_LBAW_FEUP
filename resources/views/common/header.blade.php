<nav class="navbar navbar-expand-xl navbar-light fixed-top bg-white">
  <!-- logo -->
  <a class="navbar-brand" href="homepage">
    <img src="{{asset('images/logo.png')}}" width="auto" height="64px" alt="">
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
              <li><a href="#contains">All</a></li>
              <li><a href="#contains">Computers</a></li>
              <li><a href="#contains">Laptops</a></li>
              <li><a href="#contains">Mobile</a></li>
              <li><a href="#contains">Components</a></li>
              <li><a href="#contains">Storage</a></li>
              <li><a href="#contains">Periferals</a></li>
              <li><a href="#contains">Photo</a></li>
              <li><a href="#contains">Video</a></li>
              <li><a href="#contains">Network</a></li>
              <li><a href="#contains">Software</a></li>
            </ul>
          </div>
          <input type="hidden" name="search_param" value="all" id="search_param">
          <input type="text" class="form-control" name="x" placeholder="Search...">
          <button id="searchBtn" class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>

    <!-- links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="shoppingCart.html"><i class="fas fa-shopping-cart fa-lg"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link login" href="login.html">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link register" href="register.html">Register</a>
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
  <!-- Sidebar -->
  <div id="sidebar-wrapper" class="col-2">
    <ul class="sidebar-nav" id="sidebar">
      <li><a  id="configurator" href="configurator"><span class="sub_icon"><i class="fas fa-cogs fa-lg"></i></span>Configurator</a></li>
      <li><a href="productsListpage.html?cat=Computers"><span class="sub_icon"><i class="fas fa-desktop fa-lg"></i></span>Computers</a></li>
      <li><a href="productsListpage.html?cat=Laptops"><span class="sub_icon"><i class="fas fa-laptop fa-lg"></i></span>Laptops</a></li>
      <li><a href="productsListpage.html?cat=Mobile"><span class="sub_icon" id="mobile"><i class="fas fa-mobile-alt fa-lg"></i></span>Mobile</a></li>
      <li><a href="productsListpage.html?cat=Components"><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Components</a></li>
      <li><a href="productsListpage.html?cat=Storage"><span class="sub_icon"><i class="fas fa-hdd fa-lg"></i></span>Storage</a></li>
      <li><a href="productsListpage.html?cat=Periferals"><span class="sub_icon"><i class="fas fa-keyboard fa-lg"></i></span>Periferals</a></li>
      <li><a href="productsListpage.html?cat=Photo"><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Photo</a></li>
      <li><a href="productsListpage.html?cat=Video"><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Video</a></li>
      <li><a href="productsListpage.html?cat=Network"><span class="sub_icon"><i class="fas fa-rss fa-lg"></i></span>Network</a></li>
      <li><a href="productsListpage.html?cat=Software"><span class="sub_icon"><i class="far fa-window-maximize fa-lg"></i></span>Software</a></li>
      <li><a href="productsListpage.html?cat=Software"><span class="sub_icon"><i class="far fa-window-maximize fa-lg"></i></span>Software</a></li>
    </ul>
  </div>

  <div id="content-wrapper" class="col-10">
