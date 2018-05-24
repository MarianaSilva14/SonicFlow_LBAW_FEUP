<div class="carousel-item @if($first) active @endif">
  @if( $image == null)
    <img class="d-block w-100" src="https://cdn0.iconfinder.com/data/icons/business-mix/512/cargo-512.png" alt="Product Image">
  @else
    <img class="d-block w-100" src="{{Storage::url($image)}}" alt="Product Image">
  @endif
</div>
