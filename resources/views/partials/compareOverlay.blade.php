<div class="compareOverlay">
  <i id="compareOverlayClose" class="fas fa-times close"></i>
  <div class="form-group row mx-0">
    @foreach($compareProds as $prod)
    <div class="col-sm-2 @if($loop->first)offset-1 @endif thumbnails">
      <span class="compareItemRemove" data-sku="{{$prod->sku}}"><i class="fas fa-times"></i></span>
      <!-- <img src="https://static.fnac-static.com/multimedia/Images/PT/NR/fa/44/14/1328378/1505-1.jpg" alt="100x100" class="img-fluid"> -->
      @if( $prod->picture == null)
      <img src="https://cdn0.iconfinder.com/data/icons/business-mix/512/cargo-512.png" alt="Image for {{ $prod->title }}" class="img-fluid">
      @else
      <img src="{{ Storage::url($prod->picture) }}" alt="Image for {{ $prod->title }}" class="img-fluid">
      @endif
      <p> {{$prod->title}} </p>
    </div>
    @endforeach
    <div class="col-sm-2 my-auto">
      <a href="{{route('comparator')}}" class="btn btn-primary">Compare Now!</a>
    </div>
  </div>
</div>
