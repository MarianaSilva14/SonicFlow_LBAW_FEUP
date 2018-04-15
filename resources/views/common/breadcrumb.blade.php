<nav class="breadcrumb">
  @if ( $currPage != 'Homepage')
  <a class="breadcrumb-item" href="{{url('homepage')}}">Homepage</a>
  @endif

  <span class="breadcrumb-item active">{{$currPage}}</span>

</nav>
