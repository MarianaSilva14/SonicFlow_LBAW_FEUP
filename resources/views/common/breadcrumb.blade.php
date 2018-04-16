<nav class="breadcrumb">
  @if ( $currPage != 'Homepage')
    <a class="breadcrumb-item" href="{{url('homepage')}}">Homepage</a>
    <span class="breadcrumb-item active">{{$currPage}}</span>
  @endif
</nav>
