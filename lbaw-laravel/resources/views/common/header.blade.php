<nav class="navbar navbar-expand-xl navbar-light fixed-top bg-white">
  <!-- logo -->
  <a class="navbar-brand" href="#">
    <img src="resources/images/logo.png" width="auto" height="64px" alt="">
  </a>
  <!-- toggle button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- links and search bar -->
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <!-- search form -->

    <div class="container">
      <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
          <div class="input-group">
            <div class="input-group-btn search-panel">
              <button type="button" id="catSelectButton" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span id="catSelect"><span class="glyphicon glyphicon-align-justify"></span> All</span>  <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Computers</a></li>
                <li><a href="#its_equal"> <span class="glyphicon glyphicon-music text-warning"></span> Laptops</a></li>
                <li><a href="#greather_than"> <span class="glyphicon glyphicon-user text-success"></span> Mobile</a></li>
                <li><a href="#less_than"><span class="glyphicon glyphicon-book text-primary"></span> Components </a></li>
                <li class="divider"></li>
                <li><a href="#all"> <span class="glyphicon glyphicon-picture text-info"></span> Storage</a></li>
                <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Periferals</a></li>
                <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Photo</a></li>
                <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Video</a></li>
                <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Network</a></li>
                <li><a href="#contains"> <span class="glyphicon glyphicon-envelope text-danger"></span> Software</a></li>
              </ul>
            </div>
            <input type="hidden" name="search_param" value="all" id="search_param">
            <input type="text" class="form-control" name="x" placeholder="Search...">
            <button id="searchBtn" class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>

    <!-- links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="login.html">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.html">Register</a>
      </li>
      <li class="nav-item mobileNav">
        <a class="nav-link" href="#">Cat1</a>
      </li>
      <li class="nav-item mobileNav">
        <a class="nav-link" href="#">cat2</a>
      </li>
      <li class="nav-item mobileNav">
        <a class="nav-link" href="#">cat3</a>
      </li>
    </ul>
  </div>
</nav>

<div class="wrapper row">
  <!-- Sidebar -->
  <div id="sidebar-wrapper" class="col-2">
    <ul class="sidebar-nav" id="sidebar">
      <li><a><span class="sub_icon"><i class="fas fa-desktop fa-lg"></i></span>Computers</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-laptop fa-lg"></i></span>Laptops</a></li>
      <li><a><span class="sub_icon" id="mobile"><i class="fas fa-mobile-alt fa-lg"></i></span>Mobile</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Components</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-hdd fa-lg"></i></span>Storage</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-keyboard fa-lg"></i></span>Periferals</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Photo</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-camera-retro fa-lg"></i></span>Video</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-rss fa-lg"></i></span>Network</a></li>
      <li><a><span class="sub_icon"><i class="far fa-window-maximize fa-lg"></i></span>Software</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-cogs fa-lg"></i></span>Configurator</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-cogs fa-lg"></i></span>Configurator</a></li>
      <li><a><span class="sub_icon"><i class="fas fa-cogs fa-lg"></i></span>Configurator</a></li>
      <li><a><span class="sub_icon"><i class="far fa-window-maximize fa-lg"></i></span>Software</a></li>
    </ul>
  </div>

  <div id="content-wrapper" class="col-10">
